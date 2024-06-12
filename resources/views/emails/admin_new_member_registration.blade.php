<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if ($user->role == 'buyer')
    <title>New Buyer Registration Successful</title>
    @elseif ($user->role == 'seller')
    <title>New Seller Registration Successful</title>
    @endif
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 100%;
            height: auto;
        }
        .content {
            margin: 20px 0;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .content h2 {
            font-size: 24px;
            margin-top: 0;
        }
        strong {
            font-size: 18px;
        }
        .footer {
            text-align: right;
            margin-top: 40px;
        }
        .footer p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('images/logos/MailHeader_AFM.png')) }}" alt="Asian Food Museum Logo">
        </div>
        <div class="content">
            @if ($user->role == 'buyer')
            <p style="text-align: center;">Buyer 
            @elseif ($user->role == 'seller')
            <p style="text-align: center;">Seller 
            @endif
            <strong>registration</strong> process has been <strong>successfully completed!</strong></p>
            <p>{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <h2>Dear {{ $admin->name }},</h2>
            <p>Here are the key details regarding registration:</p>
            <ul>
                <li><p>Type: {{ $user->role == 'buyer' ? 'Buyer' : 'Seller' }}</p></li>
                <li><p>Name: {{ $user->name }}</p></li>
                <li><p>Email: {{ $user->email }}</p></li>
            </ul>
        </div>
        <div class="footer">
            <p>Admin Team,</p>
            <p>Asian Food Museum</p>
            <p><a href="https://asian-food.site/">https://asian-food.site/</a></p>
        </div>
    </div>
</body>
</html>
