<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Billing Details</title>
</head>
<body>
    <h1>Hello, {{ $billing->email }}</h1>
    <p>Here are your billing details:</p>
    <ul>
        <li><strong>Billing ID:</strong> {{ $billing->id }}</li>
        <li><strong>Total Amount:</strong>₹{{ $billing->cash }}</li>
        <li><strong>Issued On:</strong> {{ $billing->created_at->toFormattedDateString() }}</li>
    </ul>
    <p>Thank you for your purchase!</p>
</body>
</html>
