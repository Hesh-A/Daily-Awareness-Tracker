
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Tracker Reminder</title>
    <style>
        body { font-family: sans-serif; background:#f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 40px auto; background:#ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background:#4f46e5; padding: 32px 40px; text-align: center; }
        .header h1 { margin: 0; color:#ffffff; font-size: 22px; letter-spacing: .5px; }
        .body { padding: 32px 40px; color:#374151; line-height: 1.7; }
        .body p { margin: 0 0 16px; }
        .btn { display: inline-block; margin-top: 8px; padding: 12px 28px; background:#4f46e5; color:#ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 15px; }
        .footer { padding: 20px 40px; background:#f9fafb; border-top: 1px solid #e5e7eb; text-align: center; color:#9ca3af; font-size:  13px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Daily Tracker</h1>
        </div>
        <div class="body">
            <p>Hi {{ $user->name }},</p>
            <p>
                You haven't logged your stats yet today. It only takes a minute —
                record your creative hours, rate the day, and make down a quick note.
            </p>
            <p>
                <a href="{{ url('/daily-entries/create') }}" class="btn">Log Today's Entry</a>
            </p>
            <p>Keep it up!</p>
        </div>
        <div class="footer">
            You're receiving this because you have a Daily Tracker account.<br>
            <a href="{{ url('/daily-entries') }}" style="color:#6b7280;">View your entries</a>
        </div>
    </div>
</body>
</html>
