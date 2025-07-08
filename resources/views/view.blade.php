<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Badge</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .badge {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 320px;
        }

        .badge img.photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .badge h2 {
            margin: 5px 0;
        }

        .badge p {
            margin: 3px 0;
        }

        .qr-code {
            margin-top: 20px;
        }

        .qr-code img {
            width: 150px;
        }
    </style>
</head>
<body>

<div class="badge">
    @if ($badge)
        <img src="{{ asset('storage/' . $badge->photo) }}" alt="Photo" class="photo">
        <h2>{{ $badge->nom }} {{ $badge->prenom }}</h2>
        <p><strong>Téléphone:</strong> {{ $badge->telephone }}</p>
        <p><strong>Fonction:</strong> {{ $badge->fonction }}</p>
        <p><strong>Organisation:</strong> {{ $badge->organisation }}</p>
        <p><strong>Date Badge:</strong> {{ $badge->date_badge }}</p>

        <div class="qr-code">
            <img src="data:image/png;base64,{{ $badge->qr_code }}" alt="QR Code">
        </div>
    @else
        <p>Aucun badge trouvé.</p>
    @endif
</div>

</body>
</html>