<!DOCTYPE html>
<html>
<head>
    <title>Renewal Notification</title>
</head>
<body>
    <h1>Hello {{ $client->name }},</h1>
    <p>Mr/Mrs {{ $client->name }}, Your Service Date will be Expire {{ $invoiceSummary->expiry_date }}. Please Contact With Service Provider to Renew Your Service.</p>
    <p>Invoice Summary:</p>
    <ul>
        <li>Invoice ID: {{ $invoiceSummary->inv_id }}</li>
        <li>Renewal Fee: {{ $invoiceSummary->service_fee }}</li>
        <li>Renewal Type: {{ $invoiceSummary->renewType }}</li>
        <!-- Add more details as needed -->
    </ul>
    <p>Best Regards,<br>Tizara Business Society</p>
</body>
</html>
