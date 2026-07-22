<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Daily Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f5f7fa; padding: 40px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px;">
        
        <h2 style="color: #333; text-align: center;">Your Daily Reminder 📅</h2>

        <p style="font-size: 16px; color: #555;">
            Hi {{ $user->name }},
        </p>

        <p style="font-size: 16px; color: #555;">
            This is a reminder for you to enter your entry for today. You are on a streak keep it up!!!!
        </p>


        <div style="margin: 30px 0; text-align: center;">
            <a href="{{ url('/') }}" 
               style="background: #4a90e2; color: white; padding: 12px 20px; border-radius: 6px; text-decoration: none; font-size: 16px;">
               View Your Dashboard
            </a>
        </div>

        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

        <p style="font-size: 12px; color: #aaa; text-align: center;">
            © {{ date('Y') }} Daily Tracker — All rights reserved.
        </p>

    </div>
</body>
</html>
