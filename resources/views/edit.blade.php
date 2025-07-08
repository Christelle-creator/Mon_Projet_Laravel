<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Modifier Badge</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, sans-serif; }
    .form-container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
    h1 { text-align: center; margin-bottom: 30px; color: #2c3e50; }
    .btn-primary, .btn-danger { border-radius: 10px; padding: 12px; font-weight: bold; }
    .btn-primary { background-color: #2c3e50; border: none; }
    .btn-primary:hover { background-color: #1a252f; }
    .btn-danger { background-color: #c0392b; border: none; }
    .btn-danger:hover { background-color: #922b21; }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Modifier le badge</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
      </div>
    @endif

    <!-- Formulaire de modification -->
    <form action="{{ route('badges.update', $badge->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label for="nom" class="form-label">Nom</label>
      <input type="text" id="nom" name="nom" value="{{ old('nom', $badge->nom) }}" class="form-control" required>

      <label for="prenom" class="form-label mt-3">Prénom</label>
      <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $badge->prenom) }}" class="form-control" required>

      <label for="telephone" class="form-label mt-3">Téléphone</label>
      <input type="tel" id="telephone" name="telephone" value="{{ old('telephone', $badge->telephone) }}" class="form-control" pattern="[0-9]{8,15}" required>

      <label for="fonction" class="form-label mt-3">Fonction</label>
      <input type="text" id="fonction" name="fonction" value="{{ old('fonction', $badge->fonction) }}" class="form-control">

      <label for="organisation" class="form-label mt-3">Organisation</label>
      <input type="text" id="organisation" name="organisation" value="{{ old('organisation', $badge->organisation) }}" class="form-control">

      <label for="photo" class="form-label mt-3">Photo</label>
      <input type="file" id="photo" name="photo" accept="image/*" class="form-control">
      @if ($badge->photo)
        <img src="{{ asset('storage/' . $badge->photo) }}" alt="Photo actuelle" style="max-width: 200px; margin-top: 10px; border-radius: 10px;">
      @endif

      <label for="date_badge" class="form-label mt-3">Date du badge</label>
      <input type="date" id="date_badge" name="date_badge" value="{{ old('date_badge', $badge->date_badge) }}" class="form-control">

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-primary">Modifier</button>
      </div>
    </form>

    <!-- Formulaire suppression -->
    <form action="{{ route('badges.destroy', $badge->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce badge ?');" class="mt-3">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger w-100">Supprimer le badge</button>
    </form>
  </div>
</body>
</html>