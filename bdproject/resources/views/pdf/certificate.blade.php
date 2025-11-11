<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificat de Adoptie</title>
    <style>


        body {
            font-family: 'KGPrimaryPenmanship', 'Comic Sans MS', cursive, sans-serif;
            background-image: url("{{ public_path('images/fundal-certificat.png') }}");
            background-size: cover;
            background-position: center;
            padding: 80px 40px;
            text-align: center;
        }

        h1 {
            font-family: 'KGPrimaryPenmanship', 'Comic Sans MS', cursive, sans-serif;
            font-size: 48px;
            color: #000;
            margin-bottom: 20px;
        }

        p {
            font-size: 22px;
            margin: 20px 0;
            color: #222;
        }

        strong {
            color: #000;
        }

        .cat-photo {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #5eb489;
            margin-top: 30px;
        }

        .signature {
            margin-top: 50px;
            font-size: 18px;
        }

        .signature-line {
            display: inline-block;
            border-top: 1px solid #000;
            width: 180px;
            margin: 0 20px;
        }

        .footer-text {
            font-size: 14px;
            margin-top: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            color: #333;
        }

        .logo {
            margin-top: 30px;
            width: 140px;
        }
    </style>
</head>
<body>

<h1 style="font-family: 'KGPrimaryPenmanship', 'Comic Sans MS', cursive, sans-serif;">Certificat de Adoptie</h1>

<p>Se certifică faptul că <strong>{{ $user->name }}</strong></p>
<p>a adoptat cu drag pisica <strong>{{ $post->title }}</strong></p>
<p>și i-a oferit un cămin pentru totdeauna 🐾</p>

<img class="cat-photo" src="{{ public_path('storage/cover_images/' . $post->cover_image) }}" alt="Pisică">

<div class="signature">
    <div class="signature-line">Semnătură</div>
    <div class="signature-line">Data: {{ now()->format('d.m.Y') }}</div>
</div>

<p class="footer-text">
    Prin semnarea acestui certificat, adoptatorul promite să ofere o viata plină de dragoste,
    siguranta și recompense delicioase pentru pisica adoptată.
</p>

<img class="logo" src="{{ public_path('images/Whisker.png') }}" alt="Whisker Rescue">

</body>
</html>
