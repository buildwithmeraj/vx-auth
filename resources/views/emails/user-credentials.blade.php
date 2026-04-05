<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: #4f46e5;
            padding: 32px 40px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 22px;
            letter-spacing: 0.5px;
        }

        .header p {
            color: #c7d2fe;
            margin: 6px 0 0;
            font-size: 13px;
        }

        .body {
            padding: 32px 40px;
        }

        .body p {
            color: #374151;
            font-size: 15px;
            line-height: 1.6;
            margin: 0 0 16px;
        }

        .credentials-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 20px 24px;
            margin: 24px 0;
        }

        .credentials-box p {
            margin: 0 0 10px;
            font-size: 14px;
            color: #6b7280;
        }

        .credentials-box p:last-child {
            margin: 0;
        }

        .credentials-box strong {
            color: #111827;
            font-size: 16px;
            letter-spacing: 0.5px;
        }

        .badge {
            display: inline-block;
            background: #4f46e5;
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .notice {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 12px 16px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .notice p {
            color: #92400e;
            font-size: 13px;
            margin: 0;
        }

        .btn {
            display: inline-block;
            background: #4f46e5;
            color: #ffffff;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            margin: 8px 0;
        }

        .footer {
            background: #f9fafb;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer p {
            color: #9ca3af;
            font-size: 12px;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="header">
        <h1>Vixlo Technologies</h1>
        <p>Tech Forward, Future Ready!</p>
    </div>

    <div class="body">
        <p>Hello <strong>{{ $name }}</strong>,</p>
        <p>
            Your account has been successfully created on the Vixlo Technologies platform.
            Below are your login credentials:
        </p>

        <div class="credentials-box">
            <p>User ID &nbsp;<span class="badge">{{ $userId }}</span></p>
        </div>

        <div class="notice">
            <p>
                ⚠️ You will be required to change your password on your first login.
                Please keep your credentials safe and do not share them with anyone.
            </p>
        </div>

        <p>Click the button below to log in to your account:</p>
        <a href="{{ url('/login') }}"
           style="display:inline-block; background:#4f46e5; color:#ffffff; padding:12px 28px; border-radius:6px; text-decoration:none; font-size:14px; font-weight:bold; margin:8px 0;">
            Login to Your Account
        </a>

        <p style="margin-top: 24px;">
            If you did not register for this account, please contact us immediately at
            <a href="mailto:support@vixlo.com">support@vixlo.com</a>.
        </p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Vixlo Technologies · 36 Avenue Jean Jaurès, 93500 Pantin, Paris, France</p>
        <p style="margin-top:6px;">This is an automated message. Please do not reply directly to this email.</p>
    </div>

</div>
</body>
</html>
