<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; }
        .qr-item {
            width: 100%;
            text-align: center;
            padding-top: 50px;
            padding-bottom: 50px;
            border-bottom: 1px dashed #ccc;
            page-break-inside: avoid;
        }
        .room-name {
            font-size: 28px;
            font-weight: bold;
            margin-top: 20px;
            text-transform: uppercase;
        }
        .label-text { font-size: 14px; color: #555; margin-bottom: 10px; }
    </style>
</head>
<body>
    @foreach($ruangans as $r)
        @php
            $scanUrl   = route('user.inventaris.rak', $r->uuid);
            $qrDataUri = \App\Helpers\QrCodeHelper::generatePngDataUri($scanUrl, 250, 3);
        @endphp
        <div class="qr-item">
            <div class="label-text">QR CODE INVENTARIS RUANGAN</div>
            <img src="{{ $qrDataUri }}" width="220" height="220" alt="QR {{ $r->nama_ruangan }}">
            <div class="room-name">{{ $r->nama_ruangan }}</div>
        </div>
    @endforeach
</body>
</html>