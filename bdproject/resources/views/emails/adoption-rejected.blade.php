<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adopție respinsă</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background: #fefcf9; padding: 30px; color: #333;">

<div style="max-width: 600px; margin: auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.07);">

    <div style="background-color: #ffe3e3; text-align: center; padding: 30px 20px; border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h1 style="margin: 0; font-size: 26px; color: #b00020;">Ne pare rău, {{ $user->name }} 💔</h1>
        <p style="font-size: 17px; margin-top: 10px; color: #6b0000;">Cererea ta de adopție a fost respinsă.</p>
    </div>


    </div>

    <div style="padding: 0 30px 30px;">
        <p style="font-size: 16px; line-height: 1.6;">
            Îți mulțumim că ai aplicat pentru a adopta pisica <strong>{{ $catName }}</strong>.
        </p>
        <p style="font-size: 16px; line-height: 1.6;">
            Deși cererea ta nu a fost aprobată de această dată, apreciem intenția ta frumoasă și dorința de a oferi o casă unei pisici.
        </p>
        <p style="font-size: 16px; line-height: 1.6;">
            Te încurajăm să explorezi alte opțiuni de adopție disponibile pe platforma noastră.
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/posts') }}"
               style="background-color: #d32f2f; color: white; text-decoration: none; padding: 12px 25px;
                      border-radius: 8px; font-weight: bold; display: inline-block; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                Vezi alte pisici
            </a>
        </div>

        <p style="font-size: 16px; line-height: 1.6;">
            Îți dorim mult succes în continuare și sperăm să găsești un companion blănos cât mai curând!
        </p>
    </div>

    <div style="background-color: #f1f6f1; padding: 20px; text-align: center; font-size: 12px; color: #666;">
        © {{ now()->year }} WhiskerRescue • Mulțumim că susții adopțiile responsabile
    </div>
</div>

</body>
</html>
