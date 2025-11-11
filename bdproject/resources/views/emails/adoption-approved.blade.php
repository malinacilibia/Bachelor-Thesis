<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adopție aprobată</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background: #fefcf9; padding: 30px; color: #333;">

<div style="max-width: 600px; margin: auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.07);">

    <div style="background-color: #cce7c3; text-align: center; padding: 30px 20px;">
        <h1 style="margin: 0; font-size: 26px; color: #2f4f2f;">Felicitări, {{ $user->name }}! 🐾</h1>
        <p style="font-size: 18px; margin-top: 10px; color: #3e3e3e;">Cererea ta de adopție a fost aprobată!</p>
    </div>





    <div style="padding: 30px 30px 20px;">
        <p style="font-size: 16px; line-height: 1.6;">
            Suntem încântați să îți spunem că cererea ta pentru pisica <strong>{{ $catName }}</strong> a fost <span style="color: #2e7d32; font-weight: bold;">aprobată</span>!
        </p>
        <p style="font-size: 16px; line-height: 1.6;">
            Ne bucurăm să îți oferim șansa să aduci iubire și căldură unei vieți care are nevoie de tine.
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/home') }}"
               style="background-color: #efb1b1; color: #4a2f2f; padding: 12px 25px; border-radius: 8px;
                      text-decoration: none; font-weight: bold; display: inline-block; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                Vezi detalii programare
            </a>
        </div>

        <p style="font-size: 16px; line-height: 1.6;">
            Îți mulțumim că ai ales să oferi o a doua șansă. Ești un adevărat erou pentru animale! 🐾
        </p>
    </div>

    <div style="background-color: #f1f6f1; padding: 20px; text-align: center; font-size: 12px; color: #666;">
        © {{ now()->year }} WhiskerRescue • Mulțumim că susții adopțiile responsabile
    </div>
</div>

</body>
</html>
