<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }


        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transform: rotate(0deg);
        }


        .email-header {
            background: linear-gradient(45deg, #ff6a00, #ee0979);
            padding: 60px 40px;
            color: #fff;
            text-align: center;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            font-size: 36px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .email-header h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .email-header p {
            font-size: 20px;
            margin-bottom: 30px;
        }


        .email-body {
            padding: 40px 30px;
            text-align: center;
            color: #333;
            font-size: 18px;
            line-height: 1.6;
        }

        .email-body p {
            margin-bottom: 25px;
        }


        .btn-verify {
            background: linear-gradient(45deg, #ff7e5f, #feb47b);
            padding: 20px 40px;
            border-radius: 50px;
            font-size: 18px;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            transition: all 0.4s ease;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
            border: none;
            text-transform: uppercase;
        }

        .btn-verify:hover {
            transform: scale(1.1);
            box-shadow: 0 18px 38px rgba(0, 0, 0, 0.18);
        }


        .email-footer {
            background-color: #f8f8f8;
            padding: 20px;
            color: #888;
            text-align: center;
            font-size: 14px;
            font-weight: 300;
        }

        .email-footer a {
            color: #feb47b;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }


        @keyframes slideIn {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .email-container {
            animation: slideIn 0.6s ease-out;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <h1>Email Verification</h1>
            <p>You're almost there, {{ $user->name }}!</p>
        </div>

        <div class="email-body">
            <p>Thank you for signing up! To complete your registration, please click the button below to verify your email address:</p>

            <a href="{{ $verificationUrl }}" class="btn-verify">Verify Your Email</a>

            <p>If you didn’t sign up, no action is needed. Just ignore this email!</p>
        </div>

        <div class="email-footer">
            <p>© 2025 Appoint Me. All Rights Reserved.</p>
            <p><a href="#">Unsubscribe</a> | <a href="#">Privacy Policy</a></p>
        </div>
    </div>

</body>
</html>
