
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AWS Payment Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .email-container {
            background-color: white;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header img {
            width: 100px;
        }
        .email-body {
            color: #333;
        }
        .email-body p {
            line-height: 1.6;
        }
        .email-body a {
            color: #0073bb;
            text-decoration: none;
        }
        .email-body a:hover {
            text-decoration: underline;
        }
        .email-footer {
            margin-top: 20px;
            text-align: center;
        }
        .email-footer button {
            background-color: #0073bb;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .email-footer button:hover {
            background-color: #005f99;
        }
    </style>
</head>
<body>
{{--https://i.ibb.co/V3nGp98/aruu-logo2.png--}}
<div class="email-container">
    <div class="email-header">
        <img src="https://i.ibb.co/RcQcStF/aruu-logo1.png" alt="AWS">
    </div>
    <div class="email-body">
        <p>{{$content}}</p>
    </div>
</div>
</body>
</html>
