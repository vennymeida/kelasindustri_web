<!DOCTYPE html>
<html>
<head>
    <title>Undangan Wawancara Kerja</title>
</head>
<body>
    <img src="{{ asset('assets/img/landing-page/logo.svg') }}" alt="Logo Perusahaan" style="max-width: 200px;">
    <h1>Halo, {{ $details['name'] }}</h1>
    <p>Anda diundang untuk wawancara pada {{ $details['date'] }}.</p>
    <p>Rincian:</p>
    <ul>
        <li>Lokasi: {{ $details['location'] }}</li>
        <li>Catatan: {{ $details['catatan'] }}</li>
    </ul>
    <p>Terima kasih atas perhatiannya dan kami menantikan pertemuan dengan Anda.</p>
    <p>Email ini dikirimkan pada: {{ now()->format('d F Y H:i') }}</p>
</body>
</html>
