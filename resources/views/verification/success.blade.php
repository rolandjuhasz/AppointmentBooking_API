<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verified - AppointMe</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            text-align: center;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 36px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #45a049;
        }

        .icon {
            font-size: 50px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <i class="fa fa-check-circle"></i>
        </div>
        <h1>Success!</h1>
        <p>Your email has been successfully verified.</p>
        <a href="http://localhost:5173/login">Go to Login</a>
        <div class="footer">
            <p>&copy; 2025 AppointMe - All rights reserved</p>
        </div>
    </div>
</body>
</html>
