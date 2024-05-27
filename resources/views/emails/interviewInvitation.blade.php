<!DOCTYPE html>
<html>
<head>
    <title>Undangan Wawancara Kerja</title>
</head>
<body>
    <h1>Halo, {{ $details['name'] }}</h1>
    <p>Anda diundang untuk mengikuti Test Pekerjaan di {{ $details['perusahaan'] }} pada tanggal {{ date('d F Y', strtotime($details['date'])) }}.</p>
    <p>Rincian:</p>
    <ul>
        <li>Lowongan: {{ $details['nama_loker'] }}</li>
        <li>Lokasi: {{ $details['location'] }}</li>
        <li>Catatan: {{ $details['catatan'] }}</li>
    </ul>
    <p>Terima kasih atas perhatiannya dan kami menantikan pertemuan dengan Anda.</p>
    <p>Email ini dikirimkan pada: {{ now()->format('d F Y H:i') }}</p>
</body>
</html>
