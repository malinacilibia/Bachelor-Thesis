<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificat de Adopție</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0fdf5;
            color: #333;
            padding: 30px;
        }

        .container {
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            max-width: 650px;
            margin: auto;
            box-shadow: 0 0 12px rgba(0,0,0,0.08);
            border-top: 6px solid #5eb489;
        }

        .title {
            color: #5eb489;
            font-size: 26px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .button {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 28px;
            background-color: #5eb489;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            font-size: 15px;
        }

        .footer {
            margin-top: 40px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <p class="title">Felicitări, {{ $user->name }}!</p>

    <p>În urma vizitei tale la centrul nostru și a semnării documentelor de adopție, ai devenit oficial adoptatorul pisicii <strong>{{ $post->title }}</strong>. 🐾</p>

    <p>Îți mulțumim din suflet că ai ales să oferi o a doua șansă unui suflet blănos. Găsirea unui cămin iubitor pentru pisicile noastre este motivul pentru care existăm.</p>

    <p>Certificatul de adopție este atașat acestui email în format PDF – un simbol al noului vostru început împreună. </p>

    <p>Nu uita să împărtășești povestea voastră în secțiunea <strong>„Poveștile mele”</strong> de pe site – ne-ar bucura enorm să vedem cum evoluează viața pisicii tale în noua familie!</p>

    <a class="button" href="{{ url('/my-stories') }}">Scrie-ți povestea</a>

    <div class="footer">
        Cu drag,<br>
        Echipa WhiskerRescue
    </div>
</div>
</body>
</html>
