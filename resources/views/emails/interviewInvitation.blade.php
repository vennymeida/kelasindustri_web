<!DOCTYPE html>
<html>
<head>
    <title>Interview Invitation</title>
</head>
<body>
    <h1>Hi, {{ $details['name'] }}</h1>
    <p>You are invited for an interview on {{ $details['date'] }}.</p>
    <p>Details:</p>
    <ul>
        <li>Location: {{ $details['location'] }}</li>
        <li>Note: {{ $details['catatan'] }}</li>
    </ul>
    <p>Thank you for applying and we look forward to meeting you.</p>
</body>
</html>
