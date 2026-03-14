<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Monstrous</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #222;
            background: #fafbfc;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            margin: 40px auto;
            padding: 36px 24px;
            max-width: 500px;
            border-radius: 6px;
            box-shadow: 0 2px 14px #d9d9d9;
        }
        .title {
            color: #2b3743;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .content {
            font-size: 17px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 26px;
            font-size: 15px;
            color: #929292;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Welcome to Monstrous, {{ $user->name }}!</div>
        <div class="content">
            <p>We're thrilled to have you join Monstrous. Your account has been successfully created.</p>
            <p>If you have any questions or need assistance, feel free to reach out to us anytime.</p>
            <p>Happy exploring!</p>
        </div>
        <div class="footer">
            Regards,<br>
            The Monstrous Team
        </div>
    </div>
</body>
</html>
