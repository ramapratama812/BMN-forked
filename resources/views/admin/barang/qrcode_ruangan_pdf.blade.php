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
        svg { width: 220px; height: 220px; }
    </style>
</head>
<body>
    @foreach($ruangans as $r)
        @php
            $renderer = new \BaconQrCode\Renderer\ImageRenderer(
                new \BaconQrCode\Renderer\RendererStyle\RendererStyle(220, 2),
                new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
            );
            $writer  = new \BaconQrCode\Writer($renderer);
            $scanUrl = route('user.inventaris.rak', $r->uuid);
            $svgData = $writer->writeString($scanUrl);
            // Hapus deklarasi XML agar aman sebagai inline SVG di HTML/DomPDF
            $svgInline = preg_replace('/<\?xml[^>]*\?>/', '', $svgData);
        @endphp
        <div class="qr-item">
            <div class="label-text">QR CODE INVENTARIS RUANGAN</div>
            {!! $svgInline !!}
            <div class="room-name">{{ $r->nama_ruangan }}</div>
        </div>
    @endforeach
</body>
</html>