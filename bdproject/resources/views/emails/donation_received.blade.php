<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Donație Înregistrată</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background: #fefcf9; padding: 30px; color: #333;">

<div style="max-width: 600px; margin: auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.07);">

    <div style="background-color: #cce7c3; text-align: center; padding: 30px 20px;">
        <h1 style="margin: 0; font-size: 26px; color: #2f4f2f;">Mulțumim din suflet, {{ $donation->user->name }}! 🐾</h1>
        <p style="font-size: 18px; margin-top: 10px; color: #3e3e3e;">
            Donația ta a fost înregistrată cu succes!
        </p>
    </div>



    <div style="padding: 30px 30px 20px;">
        <p style="font-size: 16px; line-height: 1.6;">
            Suntem profund recunoscători pentru donația generoasă de <strong>{{ $donation->amount }} RON</strong> pe care ai făcut-o!
        </p>
        <p style="font-size: 16px; line-height: 1.6;">
            Datorită sprijinului tău, mai multe pisicuțe vor avea un adăpost, hrană și îngrijire medicală.
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/donate') }}"
               style="background-color: #a9d6a2; color: #2f4f2f; padding: 12px 25px; border-radius: 8px;
                      text-decoration: none; font-weight: bold; display: inline-block; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                Donează din nou
            </a>
        </div>

        <p style="font-size: 16px; line-height: 1.6;">
            Îți mulțumim din suflet că faci lumea mai frumoasă și mai blândă! Ești minunat!
        </p>
    </div>

    <div style="background-color: #f1f6f1; padding: 20px; text-align: center; font-size: 12px; color: #666;">
        © {{ now()->year }} WhiskerRescue • Mulțumim că susții pisicile în nevoie
    </div>
</div>

</body>
</html>
