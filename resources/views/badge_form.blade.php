<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Badge</title>
</head>
<body>
    <h1>Créer un nouveau badge</h1>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('badges.store')}}" method="POST" enctype="multipart/form-data">

        <label>Nom:</label><br>
        <input type="text" name="nom" required><br><br>

        <label>Prénom:</label><br>
        <input type="text" name="prenom" required><br><br>

        <label>Téléphone:</label><br>
        <input type="text" name="telephone" required><br><br>

        <label>Fonction:</label><br>
        <input type="text" name="fonction" required><br><br>

        <label>Organisation:</label><br>
        <input type="text" name="organisation" required><br><br>

        <label>Date de création:</label><br>
        <input type="date" name="date_creation" required><br><br>

        <label>Photo:</label><br>
        <input type="file" name="photo" accept="image/*"><br><br>

        <button type="submit">Créer le badge</button>
    </form>
</body>
</html>