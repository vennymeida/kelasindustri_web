<!DOCTYPE html>
<html>
<head>
    <title>Undangan Rekomendasi Jalur Dalam</title>
</head>
<body>
    <h1>Hi, {{ $details['name'] }}</h1>
    <p>You are invited for an Undangan Rekomendasi Jalur Dalam on {{ $details['date'] }}.</p>
    <p>Details:</p>
    <ul>
        <li>Lowongan : {{ $details['nama_loker'] }}</li>
        <li>Location: {{ $details['location'] }}</li>
        <li>Note: {{ $details['catatan'] }}</li>
    </ul>
    <p>Thank you for applying and we look forward to meeting you.</p>
    <p>If you have any questions</p>
    <p>Please contact us at {{ $details['perusahaan'] }}</p>
</body>
</html>
