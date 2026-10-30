<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Barang;
use App\Models\GuideBook;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailPeminjaman;
use App\Models\DetailPengembalian;
use App\Models\BmnBarang;
use App\Models\LaporanKerusakan;
use App\Models\PerawatanInventaris;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PengembalianController extends Controller
{
	public function index()
	{
		// jika tidak memasukkan kode peminjaman terlebih dahulu maka ada alert error 
		if (!session()->has('kodePeminjaman')) {
			notify()->error('Anda belum memasukkan kode peminjaman');
			return redirect()->back();
		}

		$file = GuideBook::where('status', 'used')
			->latest()
			->first();

		$kodePeminjaman = session('kodePeminjaman');
		$detailpeminjaman = DetailPeminjaman::where('kode_peminjaman', $kodePeminjaman)->get();
		$peminjaman = Peminjaman::where('kode_peminjaman', $kodePeminjaman)->first();

		if (!$peminjaman) {
			notify()->error('Data peminjaman tidak ditemukan');
			return redirect()->route('user.option');
		}

		$pengembalianSudahAda = Pengembalian::where('kode_peminjaman', $peminjaman->kode_peminjaman)->exists();
		if ($peminjaman->status === 'Selesai' || $pengembalianSudahAda) {
			session()->forget('kodePeminjaman');
			notify()->error('Pengembalian barang sudah selesai');
			return redirect()->route('user.option');
		}

		$sessionKey = 'scanned_pengembalian_' . (Auth::id() ?? 'user') . '_' . $kodePeminjaman;
		$scannedItems = session()->get($sessionKey, []);

		$barang = [];
		foreach ($detailpeminjaman as $detail) {
			// Ambil data barang berdasarkan kode_barang
			$dataBarang = Barang::where('kode_barang', $detail->kode_barang)->first();

			if ($dataBarang) {
				$isScanned = in_array($dataBarang->kode_barang, $scannedItems);
				$barang[] = [
					'uuid' => $dataBarang->uuid,
					'nama_barang' => $dataBarang->nama_barang,
					'merk' => $dataBarang->merk,
					'kode_barang' => $dataBarang->kode_barang,
					'nomor_seri' => $dataBarang->nomor_seri,
					'status' => $dataBarang->status,
					'isChecked' => $isScanned,
				];
			}
		}
		$dataPeminjaman = [
			'nomor_peminjaman' => $peminjaman->nomor_surat,
			'tanggal_peminjaman' => $peminjaman->tanggal_peminjaman,
			'tanggal_kembali' => $peminjaman->tanggal_kembali,
			'peruntukan' => $peminjaman->peruntukan->uuid ?? null,
		];
		session()->put('dataPeminjaman', $dataPeminjaman);
		session()->put('BarangData', $barang);

		$scannedCount = count(array_filter($barang, fn($item) => $item['isChecked']));
		$totalBarang = count($barang);

		return view('user.pengembalian.index', compact('peminjaman', 'barang', 'file', 'scannedCount', 'totalBarang', 'scannedItems'));
	}

	public function checkPeminjaman(Request $request)
	{
		$request->validate([
			'code' => 'required|string'
		]);

		$code = trim($request->code);

		// Cari kode peminjaman di database
		$peminjaman = Peminjaman::where('kode_peminjaman', $code)->first();

		if (!$peminjaman) {
			return response()->json([
				'success' => false,
				'message' => 'Kode tidak ditemukan.'
			], 404);
		}

		$pengembalian = Pengembalian::where('kode_peminjaman', $peminjaman->kode_peminjaman)->latest()->first();

		if ($peminjaman->status === 'Selesai' || $pengembalian) {
			return response()->json([
				'success' => false,
				'already_returned' => true,
				'message' => 'Pengembalian barang sudah selesai',
				'data' => [
					'kode_peminjaman' => $peminjaman->kode_peminjaman,
					'kode_pengembalian' => $pengembalian ? $pengembalian->kode_pengembalian : null,
					'report_url' => route('user.pengembalian.report', ['kode_peminjaman' => $peminjaman->kode_peminjaman]),
					'pdf_url' => route('user.pengembalian.pdf', ['kode_peminjaman' => $peminjaman->kode_peminjaman]),
				]
			], 400);
		}

		// Jika ada kode peminjaman baru yang berbeda, reset data scan sesi sebelumnya
		$prevKode = session('kodePeminjaman');
		if ($prevKode && $prevKode !== $peminjaman->kode_peminjaman) {
			$oldSessionKey = 'scanned_pengembalian_' . (Auth::id() ?? 'user') . '_' . $prevKode;
			session()->forget($oldSessionKey);
		}

		session()->put('kodePeminjaman', $peminjaman->kode_peminjaman);

		return response()->json([
			'success' => true,
			'message' => 'Silakan lakukan pengembalian.',
		], 200);
	}

    public function store(Request $request)
    {
        $kodePeminjaman = session('kodePeminjaman');
        if (!$kodePeminjaman) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sesi peminjaman tidak ditemukan atau telah berakhir.'
            ], 403);
        }

        $peminjaman = Peminjaman::where('kode_peminjaman', $kodePeminjaman)->first();
        if (!$peminjaman) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data peminjaman aktif tidak ditemukan di sistem.'
            ], 404);
        }

        $pengembalianExists = Pengembalian::where('kode_peminjaman', $kodePeminjaman)->exists();
        if ($peminjaman->status === 'Selesai' || $pengembalianExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pengembalian barang sudah selesai'
            ], 400);
        }

        // 1. Ambil daftar barang dari database peminjaman aktif
        $detailPeminjamanList = DetailPeminjaman::where('kode_peminjaman', $kodePeminjaman)->get();
        $expectedItemCodes = $detailPeminjamanList->pluck('kode_barang')->all();
        $totalExpected = count($expectedItemCodes);

        if ($totalExpected === 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada barang yang terdaftar dalam peminjaman aktif ini.'
            ], 400);
        }

        // 2. Ambil bukti validasi scan server-side yang terikat pada pengguna dan peminjaman aktif
        $sessionKey = 'scanned_pengembalian_' . (Auth::id() ?? 'user') . '_' . $kodePeminjaman;
        $scannedItems = session()->get($sessionKey, []);

        // 3. Validasi input request secara ketat
        $valData = $request->all();
        if (!is_array($valData) || count($valData) !== $totalExpected) {
            return response()->json([
                'status' => 'error',
                'message' => 'Seluruh barang dalam peminjaman aktif wajib dipindai dan disertakan. Diterima ' . (is_array($valData) ? count($valData) : 0) . ' dari ' . $totalExpected . ' barang.'
            ], 422);
        }

        $requestItemCodes = [];
        foreach ($valData as $item) {
            if (!isset($item['item_code']) || !isset($item['condition']) || !isset($item['isChecked'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Format data pengembalian tidak valid.'
                ], 422);
            }

            $code = $item['item_code'];
            $condition = strtolower($item['condition']);
            $isChecked = filter_var($item['isChecked'], FILTER_VALIDATE_BOOLEAN);

            // Kondisi hanya boleh 'baik' atau 'rusak'
            if (!in_array($condition, ['baik', 'rusak'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Kondisi barang {$code} harus bernilai 'baik' atau 'rusak'."
                ], 422);
            }

            if (!$isChecked) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Barang {$code} belum divalidasi melalui pemindaian."
                ], 422);
            }

            // Pastikan kode barang benar-benar terkait dengan peminjaman tersebut
            if (!in_array($code, $expectedItemCodes)) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Barang {$code} tidak terdaftar dalam peminjaman aktif ini."
                ], 422);
            }

            // Pastikan seluruh barang sudah tercatat sebagai hasil validasi scan pada proses pengembalian ini
            if (!in_array($code, $scannedItems)) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Barang {$code} belum tercatat hasil scan di server. Silakan lakukan pemindaian kamera."
                ], 422);
            }

            // Pastikan setiap barang wajib tercantum tepat satu kali
            if (in_array($code, $requestItemCodes)) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Barang {$code} terduplikasi dalam request."
                ], 422);
            }

            $requestItemCodes[] = $code;
        }

        // Pastikan tidak ada barang yang kurang, lebih, atau asing
        $diffExpected = array_diff($expectedItemCodes, $requestItemCodes);
        $diffRequest = array_diff($requestItemCodes, $expectedItemCodes);
        if (!empty($diffExpected) || !empty($diffRequest)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Daftar barang pengembalian tidak cocok dengan rincian peminjaman aktif di database.'
            ], 422);
        }

        // 4. Lakukan mutasi dalam transaksi database dengan rollback jika terjadi kegagalan
        DB::beginTransaction();

        try {
            // Simpan record Pengembalian dengan status 'Lengkap'
            $pengembalian = Pengembalian::create([
                'uuid' => (string) Str::uuid(),
                'kode_pengembalian' => 'PG-' . time(),
                'kode_peminjaman' => $kodePeminjaman,
                'tanggal_kembali' => now(),
                'status' => 'Lengkap',
                'peminjam' => Auth::user()->nama_lengkap ?? $peminjaman->peminjam ?? 'Peminjam',
            ]);

            foreach ($valData as $item) {
                $code = $item['item_code'];
                $condition = strtolower($item['condition']);

                // Simpan DetailPengembalian
                DetailPengembalian::create([
                    'uuid' => (string) Str::uuid(),
                    'kode_pengembalian' => $pengembalian->kode_pengembalian,
                    'kode_barang' => $code,
                    'status' => $condition,
                    'deskripsi' => 'Barang Telah Dikembalikan',
                ]);

                // Update status dan sisa_limit di tabel Barang & BmnBarang
                $barang = Barang::where('kode_barang', $code)->first();
                $bmnItem = BmnBarang::where('kode_barang', $code)->first();

                if ($barang) {
                    $maxLimit = $barang->limit ?? ($bmnItem ? max(1, (int) $bmnItem->jumlah) : 1);

                    if ($condition === 'rusak') {
                        // Barang dikembalikan dalam kondisi rusak -> tidak dapat dipinjam kembali
                        $barang->update([
                            'status' => 'tidak-tersedia',
                        ]);

                        if ($bmnItem) {
                            $bmnItem->update(['kondisi' => 'Rusak']);

                            // Cegah duplikasi laporan kerusakan jika sudah ada yang pending/disetujui atau dalam perawatan aktif
                            $activeReportExists = LaporanKerusakan::where('barang_id', $bmnItem->id)
                                ->whereIn('status', ['pending', 'disetujui'])
                                ->exists();
                            $activeMaintenanceExists = PerawatanInventaris::where('barang_id', $bmnItem->id)
                                ->whereIn('status', ['pending', 'proses', 'diperbaiki'])
                                ->exists();

                            if (!$activeReportExists && !$activeMaintenanceExists) {
                                LaporanKerusakan::create([
                                    'uuid' => (string) Str::uuid(),
                                    'barang_id' => $bmnItem->id,
                                    'user_id' => Auth::id(),
                                    'jenis_kerusakan' => 'Kerusakan Pasca Penggunaan',
                                    'deskripsi' => 'Barang dikembalikan dalam kondisi rusak pada pengembalian ' . $pengembalian->kode_pengembalian . ' (Peminjaman: ' . $kodePeminjaman . ').',
                                    'foto' => null,
                                    'status' => 'disetujui',
                                ]);
                            }
                        }
                    } elseif ($condition === 'hilang') {
                        // Barang hilang / belum dikembalikan -> tidak tersedia
                        $barang->update([
                            'status' => 'tidak-tersedia',
                        ]);
                    } else {
                        // Barang dikembalikan dalam kondisi baik -> pulihkan stok ketersediaan
                        // Hitung transaksi peminjaman aktif lainnya (status 'Proses') yang masih menahan barang ini
                        $otherActiveLoansCount = DetailPeminjaman::where('kode_barang', $code)
                            ->where('kode_peminjaman', '!=', $kodePeminjaman)
                            ->whereHas('peminjaman', function ($q) {
                                $q->where('status', 'Proses');
                            })
                            ->count();

                        $restoredLimit = max(0, $maxLimit - $otherActiveLoansCount);
                        $statusBarang = ($restoredLimit > 0) ? 'tersedia' : 'tidak-tersedia';

                        $barang->update([
                            'status' => $statusBarang,
                            'sisa_limit' => $restoredLimit,
                        ]);

                        if ($bmnItem && in_array($bmnItem->kondisi, ['Rusak', 'Kurang Baik'])) {
                            $bmnItem->update(['kondisi' => 'Baik']);
                        }
                    }
                }
            }

            // Update status Peminjaman menjadi 'Selesai' HANYA jika seluruh pengembalian berhasil diproses
            $peminjaman->status = 'Selesai';
            $peminjaman->save();

            // Bersihkan bukti scan di session setelah transaksi berhasil
            session()->forget($sessionKey);
            session()->put('kodePengembalian', $pengembalian->kode_pengembalian);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data pengembalian berhasil disimpan.',
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan pengembalian:', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data pengembalian: ' . $e->getMessage(),
            ], 500);
        }
    }

	public function validateItem(Request $request)
	{
		$request->validate([
			'itemCode' => 'required|string'
		]);

		$itemCode = trim($request->itemCode);
		$kodePeminjaman = session('kodePeminjaman');

		if (!$kodePeminjaman) {
			return response()->json([
				'success' => false,
				'message' => 'Sesi peminjaman tidak ditemukan atau telah berakhir.'
			], 403);
		}

		$peminjaman = Peminjaman::where('kode_peminjaman', $kodePeminjaman)->first();
		if (!$peminjaman || $peminjaman->status === 'Selesai') {
			return response()->json([
				'success' => false,
				'message' => 'Peminjaman tidak aktif atau sudah selesai.'
			], 400);
		}

		// Ambil daftar barang dari database peminjaman aktif
		$detailPeminjaman = DetailPeminjaman::where('kode_peminjaman', $kodePeminjaman)->get();
		$validItemCodes = $detailPeminjaman->pluck('kode_barang')->all();

		// Normalisasi khusus jika hasil scan memuat prefix 'QR-' dari generator/label lama
		if (!in_array($itemCode, $validItemCodes) && str_starts_with($itemCode, 'QR-')) {
			$strippedCode = substr($itemCode, 3);
			if (in_array($strippedCode, $validItemCodes)) {
				$itemCode = $strippedCode;
			}
		}

		// Tolak QR yang bukan milik peminjaman aktif
		if (!in_array($itemCode, $validItemCodes)) {
			return response()->json([
				'success' => false,
				'message' => 'QR barang tidak terdaftar dalam peminjaman aktif ini.'
			], 404);
		}

		$sessionKey = 'scanned_pengembalian_' . (Auth::id() ?? 'user') . '_' . $kodePeminjaman;
		$scannedItems = session()->get($sessionKey, []);

		// Cegah barang yang sama dihitung dua kali
		if (in_array($itemCode, $scannedItems)) {
			return response()->json([
				'success' => false,
				'already_scanned' => true,
				'message' => 'Barang ini sudah dipindai sebelumnya.'
			], 409);
		}

		// Catat bukti validasi scan di session server
		$scannedItems[] = $itemCode;
		session()->put($sessionKey, $scannedItems);

		$barang = Barang::where('kode_barang', $itemCode)->first();

		return response()->json([
			'success' => true,
			'message' => 'Barang berhasil dipindai dan divalidasi.',
			'data' => [
				'kode_barang' => $itemCode,
				'nama_barang' => $barang ? $barang->nama_barang : '',
				'scanned_count' => count($scannedItems),
				'total_items' => count($validItemCodes)
			]
		], 200);
	}

	public function report(Request $request)
	{
		if (!Auth::check() || !in_array(Auth::user()->role, ['user', 'admin', 'superadmin'])) {
			if ($request->expectsJson()) {
				return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
			}
			return redirect()->route('login');
		}

		$kodePengembalian = $request->query('kode_pengembalian');
		$kodePeminjaman = $request->query('kode_peminjaman') ?? $request->query('code');

		$pengembalian = null;

		// 1. Jika kode_pengembalian dan kode_peminjaman diberikan, utamakan pasangan yang cocok
		if ($kodePengembalian && $kodePeminjaman) {
			$pengembalian = Pengembalian::where('kode_pengembalian', $kodePengembalian)
				->where('kode_peminjaman', $kodePeminjaman)
				->first();
		}

		// 2. Jika kode_peminjaman diberikan (misal dari daftar riwayat peminjaman), cari pengembalian untuk transaksi peminjaman tersebut
		if (!$pengembalian && $kodePeminjaman) {
			$pengembalian = Pengembalian::where('kode_peminjaman', $kodePeminjaman)->latest()->first();
		}

		// 3. Jika hanya kode_pengembalian yang diberikan
		if (!$pengembalian && $kodePengembalian) {
			$pengembalian = Pengembalian::where('kode_pengembalian', $kodePengembalian)->first();
		}

		// 4. Sebagai fallback terakhir jika tidak ada query URL sama sekali, gunakan kodePengembalian dari session
		if (!$pengembalian && !$kodePeminjaman && session()->has('kodePengembalian')) {
			$sessionKode = session()->get('kodePengembalian');
			$pengembalian = Pengembalian::where('kode_pengembalian', $sessionKode)->first();
		}

		if (!$pengembalian) {
			notify()->error('Bukti pengembalian tidak ditemukan.');
			return redirect()->route('user.option');
		}

		// Simpan kodePengembalian di session agar fitur PDF & update_desc tetap sinkron
		session()->put('kodePengembalian', $pengembalian->kode_pengembalian);

		$kodePengembalian = $pengembalian->kode_pengembalian;
		$detailPengembalian = DetailPengembalian::where('kode_pengembalian', $kodePengembalian)->get();
		$barangKembali = [];
		$barangHilang = [];

		foreach ($detailPengembalian as $detail) {
			if ($detail->status != 'hilang') {
				$dataBarangKembali = Barang::where('kode_barang', $detail->kode_barang)->first();

				if ($dataBarangKembali) {
					$barangKembali[] = [
						'uuid' => $detail->uuid,
						'kode_barang' => $dataBarangKembali->kode_barang,
						'nama_barang' => $dataBarangKembali->nama_barang,
						'merk' => $dataBarangKembali->merk,
						'nomor_seri' => $dataBarangKembali->nomor_seri,
						'kondisi' => $detail->status,
						'deskripsi' => $detail->deskripsi,
					];
				}
			}

			if ($detail->status == 'hilang') {
				$dataBarangHilang = Barang::where('kode_barang', $detail->kode_barang)->first();

				if ($dataBarangHilang) {
					$barangHilang[] = [
						'uuid' => $detail->uuid,
						'kode_barang' => $dataBarangHilang->kode_barang,
						'nama_barang' => $dataBarangHilang->nama_barang,
						'merk' => $dataBarangHilang->merk,
						'nomor_seri' => $dataBarangHilang->nomor_seri,
						'deskripsi' => (!empty($detail->deskripsi) && $detail->deskripsi !== 'Barang Telah Dikembalikan') ? $detail->deskripsi : 'Hilang',
					];
				}
			}
		}

		// Identifikasi barang yang masih berstatus dipinjam / belum dikembalikan dari transaksi peminjaman terkait
		$peminjaman = $pengembalian->peminjaman ?? Peminjaman::where('kode_peminjaman', $pengembalian->kode_peminjaman)->first();
		if ($peminjaman) {
			$pengembalian->setRelation('peminjaman', $peminjaman);
			$detailPeminjamanList = DetailPeminjaman::where('kode_peminjaman', $peminjaman->kode_peminjaman)->get();

			$allReturnedCodesForLoan = DetailPengembalian::whereHas('pengembalian', function ($q) use ($pengembalian) {
				$q->where('kode_peminjaman', $pengembalian->kode_peminjaman);
			})->where('status', '!=', 'hilang')->pluck('kode_barang')->all();

			$existingHilangCodes = array_column($barangHilang, 'kode_barang');

			foreach ($detailPeminjamanList as $itemPinjam) {
				$code = $itemPinjam->kode_barang;
				if (!in_array($code, $allReturnedCodesForLoan) && !in_array($code, $existingHilangCodes)) {
					$dataBarang = $itemPinjam->barang ?? Barang::where('kode_barang', $code)->first();
					if ($dataBarang) {
						$barangHilang[] = [
							'uuid' => $itemPinjam->uuid,
							'kode_barang' => $dataBarang->kode_barang,
							'nama_barang' => $dataBarang->nama_barang,
							'merk' => $dataBarang->merk,
							'nomor_seri' => $dataBarang->nomor_seri,
							'deskripsi' => 'Masih Dipinjam',
							'is_unreturned' => true,
						];
						$existingHilangCodes[] = $code;
					}
				}
			}
		}

		return view('user.laporan.pengembalian.index', compact('detailPengembalian', 'pengembalian', 'barangKembali', 'barangHilang'));
	}

	public function desc_update(Request $request)
	{
		$validateData = $request->validate([
			'barang' => 'required|array', // Harus berupa array
			'barang.*.uuid' => 'required|string|exists:detail_pengembalian,uuid', // UUID harus ada di tabel `detail_pengembalian`
			'barang.*.description' => 'required|string|max:255', // Deskripsi wajib diisi dan maksimal 255 karakter
		]);

		$barangData = $request->input('barang', []); // Ambil data barang dari request
		$updatedRecords = 0; // Hitung jumlah record yang diperbarui

		// Log::info('Data yang diterima untuk pembaruan deskripsi barang:', ['barang' => $barangData]);

		foreach ($barangData as $barang) {
			$detailPengembalian = DetailPengembalian::where('uuid', $barang['uuid'])->first();

			if ($detailPengembalian) {
				$detailPengembalian->deskripsi = $barang['description'];
				$detailPengembalian->save();
				$updatedRecords++;

				// Sinkronkan deskripsi ke laporan kerusakan terkait jika ada
				$bmnItem = BmnBarang::where('kode_barang', $detailPengembalian->kode_barang)->first();
				if ($bmnItem) {
					$laporan = LaporanKerusakan::where('barang_id', $bmnItem->id)
						->where('status', 'disetujui')
						->latest()
						->first();
					if ($laporan) {
						$laporan->update([
							'deskripsi' => 'Pengembalian (' . $detailPengembalian->kode_pengembalian . '): ' . $barang['description']
						]);
					}
				}
			}
		}

		Log::info('Jumlah data yang berhasil diperbarui:', ['updated_records' => $updatedRecords]);
		return response()->json([
			'message' => 'Deskripsi barang berhasil diperbarui',
			'updated_records' => $updatedRecords,
		]);
	}

	public function printReport(Request $request)
	{
		if (!Auth::check() || !in_array(Auth::user()->role, ['user', 'admin', 'superadmin'])) {
			if ($request->expectsJson()) {
				return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
			}
			return redirect()->route('login');
		}

		$kodePengembalian = $request->query('kode_pengembalian');
		$kodePeminjaman = $request->query('kode_peminjaman') ?? $request->query('code');

		$pengembalian = null;

		// 1. Jika kode_pengembalian dan kode_peminjaman diberikan, utamakan pasangan yang cocok
		if ($kodePengembalian && $kodePeminjaman) {
			$pengembalian = Pengembalian::where('kode_pengembalian', $kodePengembalian)
				->where('kode_peminjaman', $kodePeminjaman)
				->first();
		}

		// 2. Jika kode_peminjaman diberikan (misal dari cetak riwayat peminjaman), cari pengembalian untuk transaksi peminjaman tersebut
		if (!$pengembalian && $kodePeminjaman) {
			$pengembalian = Pengembalian::where('kode_peminjaman', $kodePeminjaman)->latest()->first();
		}

		// 3. Jika hanya kode_pengembalian yang diberikan
		if (!$pengembalian && $kodePengembalian) {
			$pengembalian = Pengembalian::where('kode_pengembalian', $kodePengembalian)->first();
		}

		// 4. Sebagai fallback terakhir jika tidak ada query URL sama sekali, gunakan kodePengembalian dari session
		if (!$pengembalian && !$kodePeminjaman && session()->has('kodePengembalian')) {
			$sessionKode = session()->get('kodePengembalian');
			$pengembalian = Pengembalian::where('kode_pengembalian', $sessionKode)->first();
		}

		if (!$pengembalian) {
			return redirect()->route('user.option');
		}

		$kodePengembalian = $pengembalian->kode_pengembalian;
		$detailPengembalian = DetailPengembalian::where('kode_pengembalian', $kodePengembalian)->get();
		$barangKembali = [];
		$barangHilang = [];

		foreach ($detailPengembalian as $detail) {
			if ($detail->status != 'hilang') {
				$dataBarangKembali = Barang::where('kode_barang', $detail->kode_barang)->first();

				if ($dataBarangKembali) {
					$barangKembali[] = [
						'kode_barang' => $dataBarangKembali->kode_barang,
						'nama_barang' => $dataBarangKembali->nama_barang,
						'merk' => $dataBarangKembali->merk,
						'nomor_seri' => $dataBarangKembali->nomor_seri,
						'kondisi' => $detail->status,
						'deskripsi' => $detail->deskripsi,
					];
				}
			}

			if ($detail->status == 'hilang') {
				$dataBarangHilang = Barang::where('kode_barang', $detail->kode_barang)->first();

				if ($dataBarangHilang) {
					$barangHilang[] = [
						'uuid' => $detail->uuid,
						'kode_barang' => $dataBarangHilang->kode_barang,
						'nama_barang' => $dataBarangHilang->nama_barang,
						'merk' => $dataBarangHilang->merk,
						'nomor_seri' => $dataBarangHilang->nomor_seri,
						'deskripsi' => $detail->deskripsi,
					];
				}
			}
		}

		// Identifikasi barang yang masih berstatus dipinjam / belum dikembalikan dari transaksi peminjaman terkait
		$peminjaman = $pengembalian->peminjaman ?? Peminjaman::where('kode_peminjaman', $pengembalian->kode_peminjaman)->first();
		if ($peminjaman) {
			$pengembalian->setRelation('peminjaman', $peminjaman);
			$detailPeminjamanList = DetailPeminjaman::where('kode_peminjaman', $peminjaman->kode_peminjaman)->get();

			$allReturnedCodesForLoan = DetailPengembalian::whereHas('pengembalian', function ($q) use ($pengembalian) {
				$q->where('kode_peminjaman', $pengembalian->kode_peminjaman);
			})->where('status', '!=', 'hilang')->pluck('kode_barang')->all();

			$existingHilangCodes = array_column($barangHilang, 'kode_barang');

			foreach ($detailPeminjamanList as $itemPinjam) {
				$code = $itemPinjam->kode_barang;
				if (!in_array($code, $allReturnedCodesForLoan) && !in_array($code, $existingHilangCodes)) {
					$dataBarang = $itemPinjam->barang ?? Barang::where('kode_barang', $code)->first();
					if ($dataBarang) {
						$barangHilang[] = [
							'uuid' => $itemPinjam->uuid,
							'kode_barang' => $dataBarang->kode_barang,
							'nama_barang' => $dataBarang->nama_barang,
							'merk' => $dataBarang->merk,
							'nomor_seri' => $dataBarang->nomor_seri,
							'deskripsi' => 'Masih Dipinjam',
						];
						$existingHilangCodes[] = $code;
					}
				}
			}
		}

		$data = [
			'detailPengembalian' => $detailPengembalian,
			'pengembalian' => $pengembalian,
			'barangKembali' => $barangKembali,
			'barangHilang' => $barangHilang,
		];

		// Generate PDF menggunakan DomPDF
		$pdf = Pdf::loadView('user.laporan.pengembalian.report', $data)->setPaper('a3', 'landscape');

		// Return stream PDF ke browser
		return $pdf->stream('laporan-pengembalian-' . time() . '.pdf');
	}
}