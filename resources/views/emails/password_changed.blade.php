<!-- resources/views/emails/password_changed.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Password Changed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Changed</h1>
        </div>
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            <p>We wanted to let you know that your password has been successfully changed.</p>
            <p>If you did not make this change or if you believe an unauthorized person has accessed your account, 
                please contact our support team immediately.</p>
            <p>Thank you for keeping your account secure.</p>
            <p>Best regards,</p>
            <p>Asian Food Museum</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Asian Food Museum. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
