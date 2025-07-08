<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Badge de {{ $badge->nom }} {{ $badge->prénom }}</title>
</head>
<body style="font-family: sans-serif; text-align: center; padding: 40px;">

    <h1>Badge d'identification</h1>
    
    {{-- Afficher la photo du badge --}}

    @isset
        @if($badge->photo)
        <div style="margin: 20px;">
            <img src="{{ asset('storage/' . $badge->photo) }}" alt="Photo du badge" style="width: 150px; height:150px; border-radius:50%;">
        </div>
        @endif

        <p><strong>Nom :</strong> {{ $badge->nom }}</p>
        <p><strong>Prenom :</strong> {{ $badge->prenom }}</p>
        <p><strong>Telephone :</strong> {{ $badge->telephone }}</p>
        <p><strong>Fonction :</strong> {{ $badge->fonction }}</p>
        <p><strong>Organisation :</strong> {{ $badge->organisation }}</p>
        <p><strong>Date :</strong> {{ $badge->date_badge }}</p>

        {{-- QR Code --}}
        @if($badge->qr_code) 
          <div style="margin-top: 20px;">
            <h3>QR Code</h3>
            <img src="data:image/png;base64,{{ $badge->qr_code }}" alt="QR Code">
          </div>
        @endif
    @endisset

</body>
</html>