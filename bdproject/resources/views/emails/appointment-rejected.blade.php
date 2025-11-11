<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Programare Respinsă</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background: #fefcf9; padding: 30px; color: #333;">

<div style="max-width: 600px; margin: auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.07);">

    <div style="background-color: #ffe3e3; text-align: center; padding: 30px 20px; border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h1 style="margin: 0; font-size: 26px; color: #b00020;">Ne pare rău, {{ $user->name }} 💔</h1>
        <p style="font-size: 17px; margin-top: 10px; color: #6b0000;">Programarea ta din data de <strong>{{ $date }}</strong> a fost respinsă.</p>
    </div>


    </div>

    <div style="padding: 0 30px 30px;">
        <p style="font-size: 16px; line-height: 1.6;">
            Motivul respingerii: <em>{{ $reason }}</em>
        </p>
        <p style="font-size: 16px; line-height: 1.6;">
            Îți mulțumim că ai ales să faci parte din comunitatea noastră și te încurajăm să reprogramezi vizita atunci când este posibil.
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $link }}"
               style="background-color: #999999; color: white; text-decoration: none; padding: 12px 25px;
                      border-radius: 8px; font-weight: bold; display: inline-block; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                Reprogramează
            </a>
        </div>

        <p style="font-size: 16px; line-height: 1.6;">
            Sperăm să ne revedem curând și îți dorim succes în continuare! 🐾
        </p>
    </div>

    <div style="background-color: #f1f6f1; padding: 20px; text-align: center; font-size: 12px; color: #666;">
        © {{ now()->year }} WhiskerRescue • Mulțumim că susții adopțiile responsabile
    </div>
</div>

</body>
</html>
