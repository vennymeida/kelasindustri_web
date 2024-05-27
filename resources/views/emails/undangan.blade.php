<!DOCTYPE html>
<html>
<head>
    <title>Undangan Recruitmen Pekerjaan</title>
</head>
<body>
    <img src="{{ asset('assets/img/landing-page/logo.svg') }}" alt="Logo Perusahaan" style="max-width: 200px;">
    <h1>Hai, {{ $details['name'] }}</h1>
    <p>Anda diundang untuk mengikuti Test Pekerjaan di {{ $details['perusahaan'] }} pada tanggal {{ $details['date'] }}.</p>
    <p>Rincian:</p>
    <ul>
        <li>Lowongan: {{ $details['nama_loker'] }}</li>
        <li>Lokasi: {{ $details['location'] }}</li>
        <li>Catatan: {{ $details['catatan'] }}</li>
    </ul>
    <p>Terima kasih telah mendaftar dan kami berharap dapat bertemu dengan Anda.</p>
    <p>Email ini dikirimkan pada: {{ now()->format('d F Y H:i') }}</p>
</body>
</html>
