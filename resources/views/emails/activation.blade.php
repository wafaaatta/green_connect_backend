<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activate Your Account</title>
    <style>
        /* Tailwind CSS inline styles for email clients */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
        .email-body h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #4CAF50;
        }
        .email-footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #888;
        }
        .activation-code {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #333;
            border-radius: 5px;
        }
        
        .btn-activate:hover {
            text-decoration: underline
        }
    </style>
</head>
<body>
    <table role="presentation" cellpadding="0" cellspacing="0" class="email-container">
        <tr>
            <td class="email-header">
                Activate Your Account
            </td>
        </tr>
        <tr>
            <td class="email-body">
                <h2>Hi {{ $user->name }},</h2>
                <p>Welcome! We’re excited to have you get started. First, you need to confirm your account. Use the activation link to activate your account and get started.</p>


                <p>If you prefer, you can also activate your account by clicking the link below:</p>

                <a href="{{ $activationLink }}" class="btn-activate" >
                    {{ $activationLink }}
                </a>

                <p>If you didn’t create an account, you can safely ignore this email.</p>

                <p>Thanks,<br>The {{ config('app.name') }} Team</p>
            </td>
        </tr>
        <tr>
            <td class="email-footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
