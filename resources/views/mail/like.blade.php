<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4a90e2;
            color: #fff;
            padding: 10px 20px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f4f4f9;
            padding: 10px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Someone Liked Your Post!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $post->user->name }},</p>
            <p>We wanted to let you know that <strong>{{$user->name}}</strong> liked your post titled "{{ $post->content }}".</p>
            <p>Keep up the great work and continue sharing your thoughts with the community!</p>
            <p>Best regards,<br>Your Application Team</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Your Application. All rights reserved.
        </div>
    </div>
</body>
</html>

