<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Liste des Badges</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h1>Liste des badges</h1>

    <a href="{{ route('badges.create') }}" class="btn btn-success mb-3">Créer un nouveau badge</a>

    @if($badges->count() > 0)
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Fonction</th>
            <th>Organisation</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($badges as $badge)
          <tr>
            <td>{{ $badge->nom }}</td>
            <td>{{ $badge->prenom }}</td>
            <td>{{ $badge->telephone }}</td>
            <td>{{ $badge->fonction }}</td>
            <td>{{ $badge->organisation }}</td>
            <td>{{ $badge->date_badge }}</td>
            <td>
              <a href="{{ route('badges.show', $badge->id) }}" class="btn btn-info btn-sm">Voir</a>
              <a href="{{ route('badges.edit', $badge->id) }}" class="btn btn-warning btn-sm">Modifier</a>
              <form action="{{ route('badges.destroy', $badge->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmer la suppression ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p>Aucun badge trouvé.</p>
    @endif
  </div>
</body>
</html>