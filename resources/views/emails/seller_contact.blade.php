
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Contact</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
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
            margin-left: 20px;
        }
        .content h2 {
            font-size: 24px;
            margin-top: 0;

        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .subtotal {
            font-weight: bold;
        }
        .footer {
            text-align: right;
            margin-top: 40px;
        }
        .footer h3 {
            font-size: 19px;
            color: #333;
        }
        .footer p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }
        .content h3 {
            font-size: 19px;
            margin-top: 20px;
            margin-left: 50px;
        }

        .content p.detail {
            font-size: 16px;
            line-height: 1.6;
            margin-left: 70px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('images/logos/MailHeader_AFM.png')) }}" alt="Asian Food Museum Logo">
        </div>
        <div class="content">
            <p>{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <p>Dear {{ $data['sellername'] }},</h3>
            <p class="detail"><strong>Subject:</strong> {{ $data['title'] }}</p>
            <p class="detail"><strong>Message Details:</strong> {{ $data['content'] }}</p>
            <!-- Embedded Image -->
            <p class="detail"><img src="{{ $message->embed($imagePath) }}" alt="Embedded Image"></p>

        </div>
        <div class="footer">
            <h3 style="text-align: right">Best regards,</h3>
            <p>{{ $data['adminemail'] }}</p>
        </div>
    </div>
</body>
</html>
