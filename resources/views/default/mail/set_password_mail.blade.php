<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Set Your Password</title>
    <style>
        /* Optional: Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        a.button {
            background-color: #3490dc;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Set Your Password</h1>
        <p>You are receiving this email because we created an account for you. Please set your password to complete your registration.</p>
        <p>Click the button below to set your password:</p>
        <a href="{{ $url }}" class="button">
            Set Password
        </a>
        <p>If you did not create an account, no further action is required.</p>
        <p>Thank you for using our application!</p>
    </div>
</body>
</html>
