<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your One-Time Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px auto;
        }
        .header {
            background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            font-size: 28px;
            margin: 0;
            letter-spacing: 1px;
        }
        .content {
            padding: 40px 30px;
            color: #333333;
            line-height: 1.6;
        }
        .content p {
            font-size: 16px;
            margin-bottom: 25px;
        }
        .otp-box {
            background-color: #f8f9fa;
            border: 2px dashed #FF6B6B;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 42px;
            font-weight: 800;
            color: #FF6B6B;
            letter-spacing: 8px;
            margin: 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #888888;
        }
        .footer p {
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #FF6B6B;
            color: #ffffff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        @media only screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Food Express</h1>
        </div>
        <div class="content">
            <h2>Verify Your Account</h2>
            <p>Hello, {{ $name }}!</p>
            <p>To complete your login, please use the following One-Time Password (OTP). This code will expire in 10 minutes.</p>
            
            <div class="otp-box">
                <p class="otp-code">{{ $otp }}</p>
            </div>
            
            <p>If you did not request this code, please ignore this email or contact our support team if you have concerns.</p>
            <p>Happy Ordering!<br>The Food Express Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Food Express App. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
