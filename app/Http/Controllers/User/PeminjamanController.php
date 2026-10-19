<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Barang;
use App\Models\BmnBarang;
use App\Models\Catatan;
use App\Models\GuideBook;
use App\Models\Peminjaman;
use App\Models\Peruntukan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DetailPeminjaman;
use App\Models\DetailPengembalian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PeminjamanNotification;

class PeminjamanController extends Controller
{
	public function index(Request $request)
	{
		$file = GuideBook::where('status', 'used')
			->latest()
			->first();

		$peruntukanData = Peruntukan::all();
		$borrowedItems = session()->get('borrowed_items', []);

		// Query Riwayat Peminjaman
		$user = Auth::user();
		$riwayatQuery = Peminjaman::with([
			'peruntukan',
			'detailPeminjaman.barang.bmnBarang.perawatanAktif',
			'detailPeminjaman.barang.bmnBarang.laporanKerusakan',
			'detailPeminjaman.barang.bmnBarang.perawatanInventaris',
			'pengembalian.detailPengembalian.barang'
		]);

		// Hak Akses / Kepemilikan: Role 'user' hanya dapat melihat riwayat miliknya
		if ($user && $user->role === 'user') {
			$riwayatQuery->where('peminjam', $user->nama_lengkap);
		}

		// Pencarian riwayat
		if ($request->filled('search_riwayat')) {
			$search = trim($request->search_riwayat);
			$riwayatQuery->where(function ($q) use ($search) {
				$q->where('kode_peminjaman', 'like', "%{$search}%")
				  ->orWhere('nomor_surat', 'like', "%{$search}%")
				  ->orWhere('nomor_peminjaman', 'like', "%{$search}%")
				  ->orWhereHas('detailPeminjaman.barang', function ($bQ) use ($search) {
					  $bQ->where('nama_barang', 'like', "%{$search}%")
						 ->orWhere('kode_barang', 'like', "%{$search}%")
						 ->orWhere('nomor_seri', 'like', "%{$search}%")
						 ->orWhere('merk', 'like', "%{$search}%");
				  });
			});
		}

		// Filter status riwayat
		if ($request->filled('status_riwayat')) {
			$statusFilter = $request->status_riwayat;
			if ($statusFilter === 'Masih Dipinjam') {
				// Belum ada pengembalian
				$riwayatQuery->whereDoesntHave('pengembalian');
			} elseif ($statusFilter === 'Dikembalikan Sebagian') {
				// Ada pengembalian namun transaksi belum berstatus selesai
				$riwayatQuery->whereHas('pengembalian')
					->where('status', '!=', 'Selesai');
			} elseif ($statusFilter === 'Selesai') {
				// Seluruh barang telah dikembalikan
				$riwayatQuery->where('status', 'Selesai');
			}
		}

		// Filter peruntukan jika dipilih
		if ($request->filled('peruntukan_riwayat')) {
			$riwayatQuery->where('peruntukan_id', $request->peruntukan_riwayat);
		}

		$riwayatPeminjaman = $riwayatQuery->orderBy('tanggal_peminjaman', 'desc')
			->orderBy('created_at', 'desc')
			->paginate(10)
			->withQueryString();

		// Hitung ringkasan status untuk tab badge & metrik
		$baseCountQuery = Peminjaman::query();
		if ($user && $user->role === 'user') {
			$baseCountQuery->where('peminjam', $user->nama_lengkap);
		}
		$totalRiwayatCount = (clone $baseCountQuery)->count();
		$aktifCount = (clone $baseCountQuery)->where('status', '!=', 'Selesai')->whereDoesntHave('pengembalian')->count();
		$sebagianCount = (clone $baseCountQuery)->where('status', '!=', 'Selesai')->whereHas('pengembalian')->count();
		$selesaiCount = (clone $baseCountQuery)->where('status', 'Selesai')->count();

		return view('user.peminjaman.index', compact(
			'borrowedItems',
			'peruntukanData',
			'file',
			'riwayatPeminjaman',
			'totalRiwayatCount',
			'aktifCount',
			'sebagianCount',
			'selesaiCount'
		));
	}

	public function searchBarang(Request $request)
	{
		$query = trim($request->get('q', ''));

		if (strlen($query) < 1) {
			return response()->json([
				'success' => true,
				'data' => []
			]);
		}

		// Ambil data dari BmnBarang (Data Master Barang)
		$items = BmnBarang::with(['perawatan', 'laporanKerusakan'])
			->whereDoesntHave('perawatanInventaris', function ($q) {
				$q->where('jenis_perawatan', 'penghapusan');
			})
			->where(function ($q) use ($query) {
				$q->where('nama_barang', 'like', "%{$query}%")
				  ->orWhere('kode_barang', 'like', "%{$query}%")
				  ->orWhere('nomor_seri', 'like', "%{$query}%")
				  ->orWhere('merk', 'like', "%{$query}%")
				  ->orWhere('ruangan', 'like', "%{$query}%");
			})
			->limit(20)
			->get();

		// Ambil data mirror di tabel barang (jika barang sudah pernah dimirror/dipinjam sebelumnya)
		$mirroredBarangs = Barang::whereIn('kode_barang', $items->pluck('kode_barang'))->get()->keyBy('kode_barang');

		$borrowedItems = session()->get('borrowed_items', []);
		$borrowedUuids = collect($borrowedItems)->pluck('uuid')->filter()->toArray();
		$borrowedCodes = collect($borrowedItems)->pluck('kode_barang')->filter()->toArray();

		$results = $items->map(function ($item) use ($mirroredBarangs, $borrowedUuids, $borrowedCodes) {
			$mirrored = $mirroredBarangs->get($item->kode_barang);
			$hasActiveMaintenance = $item->perawatan->where('status', '!=', 'selesai')->isNotEmpty()
				|| ($item->laporanKerusakan && $item->laporanKerusakan->whereIn('status', ['pending', 'disetujui'])->isNotEmpty());

			// Validasi kondisi kelayakan barang dari Master BMN
			$isDamaged = in_array($item->kondisi, ['Kurang Baik', 'Rusak']);

			// Hitung transaksi peminjaman aktif yang saat ini masih meminjam barang ini
			$activeLoansCount = DetailPeminjaman::where('kode_barang', $item->kode_barang)
				->whereHas('peminjaman', function ($q) {
					$q->where('status', 'Proses');
				})
				->count();

			$maxLimit = ($mirrored && !is_null($mirrored->limit))
				? $mirrored->limit
				: max(1, (int) ($item->jumlah ?: 1));

			$sisaLimit = max(0, $maxLimit - $activeLoansCount);

			$isAvailable = !$isDamaged
				&& !$hasActiveMaintenance
				&& ($sisaLimit > 0);

			$status = $isAvailable ? 'tersedia' : 'tidak-tersedia';

			// Tentukan alasan ketersediaan barang secara spesifik
			$reasonType = null;
			$unavailableReason = null;

			// Cek apakah ada proses pengembalian yang belum selesai
			$incompleteReturnExists = DetailPengembalian::where('kode_barang', $item->kode_barang)
				->whereHas('pengembalian', function ($q) {
					$q->where('status', '!=', 'Lengkap');
				})
				->exists();

			if ($isDamaged) {
				$reasonType = 'damaged';
				$unavailableReason = 'Barang tidak dapat dipinjam karena kondisinya tidak layak digunakan.';
			} elseif ($hasActiveMaintenance) {
				$reasonType = 'maintenance';
				$unavailableReason = 'Barang tidak dapat dipinjam karena sedang dalam proses perawatan.';
			} elseif ($incompleteReturnExists) {
				$reasonType = 'return_pending';
				$unavailableReason = 'Barang belum tersedia karena proses pengembalian belum selesai.';
			} elseif ($activeLoansCount > 0 && $sisaLimit <= 0) {
				$reasonType = 'all_borrowed';
				$unavailableReason = 'Stok tersedia 0 unit karena seluruh barang sedang dipinjam. Silakan coba kembali setelah barang dikembalikan.';
			} elseif ($sisaLimit <= 0 || $maxLimit <= 0) {
				$reasonType = 'out_of_stock';
				$unavailableReason = 'Tidak ada stok yang tersedia untuk dipinjam saat ini.';
			}

			// Sinkronkan data di tabel barang jika ada ketidakkonsistenan historis
			if ($mirrored && !$isDamaged && !$hasActiveMaintenance) {
				if ($mirrored->sisa_limit !== $sisaLimit || $mirrored->status !== $status) {
					$mirrored->update([
						'sisa_limit' => $sisaLimit,
						'status' => $status,
					]);
				}
			}

			$isAlreadySelected = in_array($item->uuid, $borrowedUuids)
				|| in_array($item->kode_barang, $borrowedCodes)
				|| ($mirrored && in_array($mirrored->uuid, $borrowedUuids));

			return [
				'uuid' => $item->uuid,
				'kode_barang' => $item->kode_barang,
				'nama_barang' => $item->nama_barang,
				'merk' => $item->merk ?? '-',
				'nomor_seri' => $item->nomor_seri ?? '-',
				'ruangan' => $item->ruangan ?? '-',
				'status' => $status,
				'sisa_limit' => $sisaLimit,
				'is_available' => $isAvailable,
				'is_already_selected' => $isAlreadySelected,
				'reason_type' => $reasonType,
				'unavailable_reason' => $unavailableReason,
			];
		});

		return response()->json([
			'success' => true,
			'data' => $results
		]);
	}

	public function addItem(Request $request)
	{
		$request->validate([
			'uuid' => 'required|string|max:100',
		]);

		$identifier = $request->uuid;

		// 1. Prioritaskan pencarian di BmnBarang (Data Master Barang)
		$bmnItem = BmnBarang::with('perawatan')
			->whereDoesntHave('perawatanInventaris', function ($q) {
				$q->where('jenis_perawatan', 'penghapusan');
			})
			->where(function ($q) use ($identifier) {
				$q->where('uuid', $identifier)->orWhere('kode_barang', $identifier);
			})
			->first();

		if ($bmnItem) {
			// Validasi perawatan aktif
			$hasActiveMaintenance = $bmnItem->perawatan->where('status', '!=', 'selesai')->isNotEmpty();
			if ($hasActiveMaintenance) {
				return response()->json([
					'success' => false,
					'message' => 'Barang "' . $bmnItem->nama_barang . '" sedang dalam perawatan dan tidak dapat dipinjam.',
				], 400);
			}

			// Validasi kondisi
			if (in_array($bmnItem->kondisi, ['Kurang Baik', 'Rusak'])) {
				return response()->json([
					'success' => false,
					'message' => 'Barang "' . $bmnItem->nama_barang . '" dalam kondisi ' . $bmnItem->kondisi . ' dan tidak dapat dipinjam.',
				], 400);
			}

			// Safe Mapping: Jamin ketersediaan record di tabel barang agar Foreign Key aman
			$initialLimit = max(1, (int) ($bmnItem->jumlah ?: 1));
			$barang = Barang::firstOrCreate(
				['kode_barang' => $bmnItem->kode_barang],
				[
					'uuid' => $bmnItem->uuid ?: (string) Str::uuid(),
					'nama_barang' => $bmnItem->nama_barang,
					'merk' => $bmnItem->merk ?? 'Belum Ditetapkan',
					'nomor_seri' => $bmnItem->nomor_seri ?? ('NS-' . strtoupper(Str::random(6))),
					'jumlah' => $initialLimit,
					'limit' => $initialLimit,
					'sisa_limit' => $initialLimit,
					'status' => 'tersedia',
					'jenis_barang_id' => 1,
					'studio' => 'studio1',
					'asal_pengadaan' => $bmnItem->asal_pengadaan,
					'catatan' => $bmnItem->catatan,
					'qr_code' => 'QR-' . $bmnItem->kode_barang,
				]
			);

			// Selalu sinkronkan nama, merk, dan no seri dengan Master BMN
			if ($barang->nama_barang !== $bmnItem->nama_barang) {
				$barang->update([
					'nama_barang' => $bmnItem->nama_barang,
					'merk' => $bmnItem->merk ?? $barang->merk,
					'nomor_seri' => $bmnItem->nomor_seri ?? $barang->nomor_seri,
				]);
			}
		} else {
			// Fallback jika item dicari langsung dari tabel barang
			$barang = Barang::where('uuid', $identifier)
				->orWhere('kode_barang', $identifier)
				->first();
		}

		if (!$barang) {
			return response()->json([
				'success' => false,
				'message' => 'Barang tidak ditemukan.',
			], 404);
		}

		$borrowedItems = session()->get('borrowed_items', []);

		// Cek apakah item sudah ada di session
		$alreadyInSession = collect($borrowedItems)->contains(function ($it) use ($barang) {
			return (isset($it['uuid']) && $it['uuid'] === $barang->uuid) ||
				   (isset($it['kode_barang']) && $it['kode_barang'] === $barang->kode_barang);
		});

		if ($alreadyInSession) {
			return response()->json([
				'success' => false,
				'message' => 'Barang sudah ada di daftar peminjaman.',
			], 400);
		}

		// Validasi peminjaman aktif & ketersediaan limit riil
		$activeLoansCount = DetailPeminjaman::where('kode_barang', $barang->kode_barang)
			->whereHas('peminjaman', function ($q) {
				$q->where('status', 'Proses');
			})
			->count();

		$maxLimit = $barang->limit ?? ($bmnItem ? max(1, (int) $bmnItem->jumlah) : 1);
		$realAvailableStock = max(0, $maxLimit - $activeLoansCount);

		$isDamaged = ($bmnItem && in_array($bmnItem->kondisi, ['Kurang Baik', 'Rusak']));
		$hasActiveMaintenance = false;
		if ($bmnItem) {
			$hasActiveMaintenance = $bmnItem->perawatan()->where('status', '!=', 'selesai')->exists()
				|| \App\Models\LaporanKerusakan::where('barang_id', $bmnItem->id)->whereIn('status', ['pending', 'disetujui'])->exists();
		}

		if ($isDamaged) {
			$barang->update([
				'status' => 'tidak-tersedia',
				'sisa_limit' => $realAvailableStock,
			]);

			return response()->json([
				'success' => false,
				'message' => 'Barang "' . $barang->nama_barang . '" tidak dapat dipinjam karena kondisinya tidak layak digunakan.',
			], 400);
		}

		if ($hasActiveMaintenance) {
			return response()->json([
				'success' => false,
				'message' => 'Barang "' . $barang->nama_barang . '" tidak dapat dipinjam karena sedang dalam proses perawatan.',
			], 400);
		}

		if ($realAvailableStock <= 0) {
			$barang->update([
				'status' => 'tidak-tersedia',
				'sisa_limit' => $realAvailableStock,
			]);

			$message = ($activeLoansCount > 0)
				? 'Stok tersedia 0 unit karena seluruh barang sedang dipinjam. Silakan coba kembali setelah barang dikembalikan.'
				: 'Tidak ada stok yang tersedia untuk dipinjam saat ini.';

			return response()->json([
				'success' => false,
				'message' => $message,
			], 400);
		}

		// Pastikan status & sisa limit tersinkron jika barang layak dan tidak ada peminjaman aktif yang menahan
		if ($barang->status !== 'tersedia' || $barang->sisa_limit !== $realAvailableStock) {
			$barang->update([
				'status' => 'tersedia',
				'sisa_limit' => $realAvailableStock,
			]);
		}

		$itemData = [
			'uuid' => $barang->uuid,
			'kode_barang' => $barang->kode_barang,
			'name' => $barang->nama_barang,
			'merk' => $barang->merk ?? '-',
			'serial_number' => $barang->nomor_seri ?? '-',
			'timestamp' => now()->timestamp,
		];

		$borrowedItems[] = $itemData;
		session()->put('borrowed_items', $borrowedItems);

		return response()->json([
			'success' => true,
			'message' => 'Barang berhasil ditambahkan.',
			'item' => $itemData,
		], 200);
	}

	public function store(Request $request)
	{
		$request->validate([
			'nomor_surat' => 'required',
			'peruntukan_id' => 'required',
			'tanggal_penggunaan' => 'required',
			'tanggal_kembali' => 'required',
		]);

		$borrowedItems = array_filter(session()->get('borrowed_items', []), function ($item) {
			return is_array($item) && !empty($item['uuid']) && !empty($item['kode_barang']);
		});

		Log::info('Received request data:', $request->all());

		if (empty($borrowedItems)) {
			return response()->json([
				'success' => false,
				'message' => 'Tidak ada barang yang dipilih untuk dipinjam.'
			], 400);
		}

		// Validasi ulang status dan sisa limit setiap barang di session sebelum membuat transaksi
		foreach ($borrowedItems as $item) {
			$dbItem = Barang::where('uuid', $item['uuid'])
				->orWhere('kode_barang', $item['kode_barang'])
				->first();

			if (!$dbItem) {
				return response()->json([
					'success' => false,
					'message' => 'Barang "' . ($item['name'] ?? $item['kode_barang']) . '" tidak ditemukan di database.'
				], 400);
			}

			$activeLoansCount = DetailPeminjaman::where('kode_barang', $dbItem->kode_barang)
				->whereHas('peminjaman', function ($q) {
					$q->where('status', 'Proses');
				})
				->count();

			$bmnItem = BmnBarang::where('kode_barang', $dbItem->kode_barang)->first();
			$maxLimit = $dbItem->limit ?? ($bmnItem ? max(1, (int) $bmnItem->jumlah) : 1);
			$realAvailableStock = max(0, $maxLimit - $activeLoansCount);
			$isDamaged = ($bmnItem && in_array($bmnItem->kondisi, ['Kurang Baik', 'Rusak']));
			$hasActiveMaintenance = false;
			if ($bmnItem) {
				$hasActiveMaintenance = $bmnItem->perawatan()->where('status', '!=', 'selesai')->exists()
					|| \App\Models\LaporanKerusakan::where('barang_id', $bmnItem->id)->whereIn('status', ['pending', 'disetujui'])->exists();
			}

			if ($realAvailableStock <= 0 || $isDamaged || $hasActiveMaintenance) {
				return response()->json([
					'success' => false,
					'message' => 'Barang "' . $dbItem->nama_barang . '" sudah tidak dapat dipinjam.'
				], 400);
			}
		}

		$kd_peminjaman = "PMB-" . time();
		$qrCodeFilename = time() . '_qr.svg';

		try {
			$qrCode = QrCode::format('svg')->size(200)->generate($kd_peminjaman);
			Storage::disk('public')->put('uploads/qr_codes_peminjaman/' . $qrCodeFilename, $qrCode);

			DB::beginTransaction();

			$borrowing = Peminjaman::create([
				'uuid' => Str::uuid(),
				'kode_peminjaman' => $kd_peminjaman,
				'nomor_surat' => $request->nomor_surat,
				'nomor_peminjaman' => 'PMJ-' . date('Ym') . '-' .
					str_pad(Peminjaman::whereYear('tanggal_peminjaman', date('Y'))
						->whereMonth('tanggal_peminjaman', date('m'))->count() + 1, 2, '0', STR_PAD_LEFT),
				'peruntukan_id' => $request->peruntukan_id,
				'tanggal_penggunaan' => $request->tanggal_penggunaan,
				'tanggal_peminjaman' => now(),
				'tanggal_kembali' => $request->tanggal_kembali,
				'qr_code' => $qrCodeFilename,
				'peminjam' => Auth::user()->nama_lengkap,
				'status' => 'Proses'
			]);

			// Simpan detail barang
			foreach ($borrowedItems as $item) {
				DetailPeminjaman::create([
					'uuid' => Str::uuid(),
					'kode_peminjaman' => $borrowing->kode_peminjaman,
					'kode_barang' => $item['kode_barang'],
				]);

				$updatedItem = Barang::where('uuid', $item['uuid'])
					->orWhere('kode_barang', $item['kode_barang'])
					->first();

				if ($updatedItem && !is_null($updatedItem->sisa_limit)) {
					$newLimit = max(0, $updatedItem->sisa_limit - 1);
					$updatedItem->update(['sisa_limit' => $newLimit]);

					if ($newLimit == 0) {
						$updatedItem->update(['status' => 'tidak-tersedia']);
					}
				}
			}

			// Clear session
			session()->forget('borrowed_items');
			DB::commit();
			session()->put('kodePeminjaman', $borrowing->kode_peminjaman);

			// =============================
			//   EMAIL DIPINDAHKAN KE METHOD BARU
			// =============================

			return response()->json([
				'success' => true,
				'message' => 'Borrowing saved successfully'
			], 200);

		} catch (\Exception $e) {
			DB::rollback();

			// Bersihkan file QR yang baru digenerate jika pembuatan peminjaman gagal (hindari file yatim)
			if (isset($qrCodeFilename) && Storage::disk('public')->exists('uploads/qr_codes_peminjaman/' . $qrCodeFilename)) {
				Storage::disk('public')->delete('uploads/qr_codes_peminjaman/' . $qrCodeFilename);
			}

			Log::error('Terjadi kesalahan saat menyimpan peminjaman.', [
				'error' => $e->getMessage(),
				'user_id' => Auth::user()->id,
			]);

			return response()->json([
				'success' => false,
				'message' => 'Error saving borrowing: ' . $e->getMessage()
			], 500);
		}
	}

	public function removeItem($uuid)
	{
		$borrowedItems = session()->get('borrowed_items', []);

		$borrowedItems = array_filter($borrowedItems, function ($item) use ($uuid) {
			return $item['uuid'] !== $uuid && ($item['kode_barang'] ?? '') !== $uuid;
		});
		session()->put('borrowed_items', array_values($borrowedItems));
		return response()->json(['success' => true, 'message' => 'Item berhasil dihapus']);
	}

	public function report()
	{
		if (!session()->has('kodePeminjaman')) {
			return redirect()->route('user.option');
		}
		$kodePeminjaman = session()->get('kodePeminjaman');
		$detailpeminjaman = DetailPeminjaman::where('kode_peminjaman', $kodePeminjaman)->get();
		$peminjaman = Peminjaman::where('kode_peminjaman', $kodePeminjaman)->first();
		$barang = [];
		foreach ($detailpeminjaman as $detail) {
			// Ambil data barang berdasarkan kode_barang
			$dataBarang = Barang::where('kode_barang', $detail->kode_barang)->first();

			if ($dataBarang) {
				$barang[] = [
					'nama_barang' => $dataBarang->nama_barang,
					'merk' => $dataBarang->merk,
					'nomor_seri' => $dataBarang->nomor_seri,
					'status' => $dataBarang->status,
				];
			}
		}

		return view('user.laporan.peminjaman.index', compact('detailpeminjaman', 'peminjaman', 'barang'));
	}

	public function sendEmail($kodePeminjaman)
    {
        try {
            $peminjaman = Peminjaman::where('kode_peminjaman', $kodePeminjaman)->firstOrFail();
            $detailpeminjaman = DetailPeminjaman::where('kode_peminjaman', $kodePeminjaman)->get();

            // Ambil data barang
            $barang = [];
            foreach ($detailpeminjaman as $detail) {
                $dataBarang = Barang::where('kode_barang', $detail->kode_barang)->first();
                if ($dataBarang) {
                    $barang[] = [
                        'nama_barang' => $dataBarang->nama_barang,
                        'merk' => $dataBarang->merk,
                        'nomor_seri' => $dataBarang->nomor_seri,
                        'status' => $dataBarang->status,
                    ];
                }
            }

            $catatan = Catatan::get();

            // PERBAIKAN: Filter user untuk menghindari nilai NULL jika superadmin tidak ada
            $recipients = array_filter([
                User::where('role', 'superadmin')->first(),
                Auth::user()
            ]);

            if (empty($recipients)) {
                return redirect()->back()->with('error', 'Tidak ada penerima email yang valid.');
            }

            // Kirim email ke penerima yang valid
            Notification::send($recipients, new PeminjamanNotification($peminjaman, $barang, $catatan));

            return redirect()->back()->with('success', 'Email berhasil dikirim!');

        } catch (\Exception $e) {
            Log::error('Gagal mengirim email: ' . $e->getMessage());
            // Kembalikan error yang lebih user friendly tanpa merusak halaman (Internal Server Error)
            return redirect()->back()->with('error', 'Gagal mengirim email. Periksa koneksi internet atau konfigurasi SMTP.');
        }
    }


	public function printReport(Request $request)
	{
		$kodePeminjaman = $request->query('kode_peminjaman') ?? session()->get('kodePeminjaman');

		if (!$kodePeminjaman) {
			return redirect()->route('user.option');
		}

		// Ambil data peminjaman
		$peminjaman = Peminjaman::where('kode_peminjaman', $kodePeminjaman)->first();

		if (!$peminjaman) {
			notify()->error('Data peminjaman tidak ditemukan.');
			return redirect()->back();
		}

		// Otorisasi: pengguna biasa hanya boleh mencetak dokumen miliknya sendiri
		if (Auth::check() && Auth::user()->role === 'user' && $peminjaman->peminjam !== Auth::user()->nama_lengkap) {
			abort(403, 'Anda tidak memiliki hak untuk mengunduh dokumen peminjaman ini.');
		}

		// Ambil detail peminjaman
		$detailpeminjaman = DetailPeminjaman::where('kode_peminjaman', $kodePeminjaman)->get();

		// Ambil data barang berdasarkan detail peminjaman
		$barang = [];
		foreach ($detailpeminjaman as $detail) {
			$dataBarang = Barang::where('kode_barang', $detail->kode_barang)->first();
			if ($dataBarang) {
				$barang[] = [
					'nama_barang' => $dataBarang->nama_barang,
					'merk' => $dataBarang->merk,
					'nomor_seri' => $dataBarang->nomor_seri,
					'status' => $dataBarang->status,
				];
			}
		}
		// Siapkan data untuk view
		$data = [
			'peminjaman' => $peminjaman,
			'barang' => $barang,
			'catatan' => Catatan::get()
		];

		// Generate PDF
		$pdf = Pdf::loadView('user.laporan.peminjaman.report', $data)->setPaper('a4', 'landscape');
		return $pdf->stream('laporan-peminjaman-' . time() . '.pdf');
	}

	/**
	 * Export Riwayat Peminjaman ke format PDF.
	 * Mendukung:
	 * 1. Unduh 1 transaksi peminjaman (jika terdapat parameter kode_peminjaman)
	 * 2. Unduh semua riwayat peminjaman (mengikuti filter aktif tanpa batasan pagination)
	 */
	public function exportRiwayatPdf(Request $request)
	{
		$user = Auth::user();
		$kodePeminjaman = $request->query('kode_peminjaman');

		if (!empty($kodePeminjaman)) {
			// ==========================================
			// OPSI A: Unduh Satu Riwayat Transaksi
			// ==========================================
			$peminjaman = Peminjaman::with([
				'peruntukan',
				'detailPeminjaman.barang',
				'pengembalian.detailPengembalian.barang'
			])->where('kode_peminjaman', $kodePeminjaman)->first();

			if (!$peminjaman) {
				abort(404, 'Data riwayat peminjaman tidak ditemukan.');
			}

			// Otorisasi: Pengguna biasa hanya boleh mengunduh riwayat miliknya
			if ($user && $user->role === 'user' && $peminjaman->peminjam !== $user->nama_lengkap) {
				abort(403, 'Anda tidak memiliki hak untuk mengunduh dokumen riwayat peminjaman ini.');
			}

			$riwayatList = collect([$peminjaman]);
			$isSingle = true;
			$peminjamUser = User::with('jabatan')->where('nama_lengkap', $peminjaman->peminjam)->first();
			$title = 'Riwayat Peminjaman Barang - ' . $peminjaman->kode_peminjaman;
			$filename = 'riwayat-peminjaman-' . Str::slug($peminjaman->kode_peminjaman) . '.pdf';
		} else {
			// ==========================================
			// OPSI B: Unduh Seluruh Riwayat Peminjaman
			// ==========================================
			$riwayatQuery = Peminjaman::with([
				'peruntukan',
				'detailPeminjaman.barang',
				'pengembalian.detailPengembalian.barang'
			]);

			// Otorisasi: Pengguna biasa hanya melihat riwayat miliknya
			if ($user && $user->role === 'user') {
				$riwayatQuery->where('peminjam', $user->nama_lengkap);
			}

			// Terapkan filter pencarian riwayat
			if ($request->filled('search_riwayat')) {
				$search = trim($request->search_riwayat);
				$riwayatQuery->where(function ($q) use ($search) {
					$q->where('kode_peminjaman', 'like', "%{$search}%")
					  ->orWhere('nomor_surat', 'like', "%{$search}%")
					  ->orWhere('nomor_peminjaman', 'like', "%{$search}%")
					  ->orWhereHas('detailPeminjaman.barang', function ($bQ) use ($search) {
						  $bQ->where('nama_barang', 'like', "%{$search}%")
							 ->orWhere('kode_barang', 'like', "%{$search}%")
							 ->orWhere('nomor_seri', 'like', "%{$search}%")
							 ->orWhere('merk', 'like', "%{$search}%");
					  });
				});
			}

			// Terapkan filter status transaksi
			if ($request->filled('status_riwayat')) {
				$statusFilter = $request->status_riwayat;
				if ($statusFilter === 'Masih Dipinjam') {
					$riwayatQuery->whereDoesntHave('pengembalian');
				} elseif ($statusFilter === 'Dikembalikan Sebagian') {
					$riwayatQuery->whereHas('pengembalian')
						->where('status', '!=', 'Selesai');
				} elseif ($statusFilter === 'Selesai') {
					$riwayatQuery->where('status', 'Selesai');
				}
			}

			// Terapkan filter peruntukan
			if ($request->filled('peruntukan_riwayat')) {
				$riwayatQuery->where('peruntukan_id', $request->peruntukan_riwayat);
			}

			$riwayatList = $riwayatQuery->orderBy('tanggal_peminjaman', 'desc')
				->orderBy('created_at', 'desc')
				->get();

			$isSingle = false;
			$peminjamUser = $user ? User::with('jabatan')->find($user->id) : null;
			$title = 'Laporan Seluruh Riwayat Peminjaman Barang';
			$filename = 'semua-riwayat-peminjaman-' . now()->format('YmdHis') . '.pdf';
		}

		$data = [
			'riwayatList' => $riwayatList,
			'isSingle' => $isSingle,
			'user' => $user,
			'peminjamUser' => $peminjamUser,
			'title' => $title,
			'filters' => [
				'search' => $request->query('search_riwayat'),
				'status' => $request->query('status_riwayat'),
				'peruntukan' => $request->filled('peruntukan_riwayat')
					? Peruntukan::find($request->query('peruntukan_riwayat'))?->peruntukan
					: null,
			],
			'printDate' => now(),
		];

		$pdf = Pdf::loadView('user.laporan.peminjaman.riwayat_pdf', $data)
			->setPaper('a4', 'portrait');

		return $pdf->stream($filename);
	}
}