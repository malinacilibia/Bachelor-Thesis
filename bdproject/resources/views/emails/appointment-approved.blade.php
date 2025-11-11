<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Programare Confirmată</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background: #fefcf9; padding: 30px; color: #333;">

<div style="max-width: 600px; margin: auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.07);">

    <div style="background-color: #cce7c3; text-align: center; padding: 30px 20px;">
        <h1 style="margin: 0; font-size: 26px; color: #2f4f2f;">Programare Confirmată, {{ $user->name }}! 🐾</h1>
        <p style="font-size: 18px; margin-top: 10px; color: #3e3e3e;">
            Programarea ta din data de <strong>{{ $date }}</strong> a fost aprobată!
        </p>
    </div>



    <div style="padding: 30px 30px 20px;">
        <p style="font-size: 16px; line-height: 1.6;">
            Te așteptăm cu drag să o întâlnești pe pisicuța aleasă și să petreceți timp împreună!
        </p>

        <p style="font-size: 16px; line-height: 1.6; margin-top: 20px;">
            📍 Locație: Strada Pisicilor nr. 10, Cluj-Napoca, Centrul WhiskerRescue
        </p>

        <p style="font-size: 16px; line-height: 1.6;">
            Pentru întrebări sau informații suplimentare, ne poți contacta la: <strong>0744 118 481</strong>
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $link }}"
               style="background-color: #a9d6a2; color: #2f4f2f; padding: 12px 25px; border-radius: 8px;
                      text-decoration: none; font-weight: bold; display: inline-block; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                Vezi detalii programare
            </a>
        </div>

        <p style="font-size: 16px; line-height: 1.6;">
            Îți mulțumim că faci parte din familia noastră și că alegi să salvezi o viață. ❤
        </p>
    </div>

    <div style="background-color: #f1f6f1; padding: 20px; text-align: center; font-size: 12px; color: #666;">
        © {{ now()->year }} WhiskerRescue • Mulțumim că susții adopțiile responsabile
    </div>
</div>

</body>
</html>
