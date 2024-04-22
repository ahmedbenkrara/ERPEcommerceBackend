<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            box-sizing: border-box;
        }

        h1 {
            color: #333333;
        }

        p {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $maildata['subject'] }}</h1>
        
        <p><strong>Name:</strong> {{ $maildata['fullname'] }}</p>
        <p><strong>Email:</strong> {{ $maildata['from'] }}</p>
        
        <p><strong>Message:</strong></p>
        <p>{{ $maildata['message'] }}</p>
    </div>
</body>
</html>