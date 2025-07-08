<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Formulaire Badge</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
  body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', Tahoma, sans-serif;
  }

  .form-container {
    max-width: 700px;
    margin: auto;
    background-color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
  }

  h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #2c3e50;
  }

  .form-label {
    font-weight: 600;
    color: #34495e;
  }

  .form-control {
    border-radius: 10px;
    padding: 10px 15px;
  }

  .btn-primary {
    background-color: #2c3e50;
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #1a252f;
  }
  
  .btn-secondary {
    background-color: #2c3e50;
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }

  .btn-secondary:hover {
    background-color: #1a252f;
  }

  #preview {
    max-width: 200px;
    margin-top: 10px;
    border-radius: 10px;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
  }

  #qrcode {
    margin-top: 20px;
    text-align: center;
  }
</style>                        

</head>
<body>
  <div class="container mt-5">
    <h1>Formulaire de Badge</h1>
    <form id="badgeForm">
      @csrf
      <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" required />
      </div>
      <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" required />
      </div>
      <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="tel" class="form-control" id="telephone" name="telephone" pattern="[0-9]{8,15}" required />
        <div class="form-text">Entrez un numéro valide (8 à 15 chiffres).</div>
      </div>
      <div class="mb-3">
        <label for="fonction" class="form-label">Fonction</label>
        <input type="text" class="form-control" id="fonction" name="fonction" />
      </div>
      <div class="mb-3">
        <label for="organisation" class="form-label">Organisation</label>
        <input type="text" class="form-control" id="organisation" name="organisation" />
      </div>
      <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" />
        @if ($badge && $badge->photo)
        <img id="preview" src="{{ asset('storage/' . $badge->photo) }}" alt="Aperçu de la photo" style="max-width: 200px; margin-top: 10px; border-radius: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.2); "/>
        @else 
        <img id="preview" src="#" alt="Aperçu de la photo" style="display:none; max-width: 200px; margin-top: 10px; border-radius: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.2);" />
        @endif
      </div>
      <div class="mb-3">
        <label for="date_badge" class="form-label">Date du badge</label>
        <input type="date" class="form-control" id="date_badge" name="date_badge" />
      </div>
      <div class="mb-3">
        <label class="form-label">QR Code</label>
        <div id="qrcode"></div>
      </div>
      <div class="d-flex justify-content-between">
        <button type="reset" class="btn btn-secondary">Annuler</button>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
    </form>
  </div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

<script>
  // 1. Script pour l'aperçu de la photo
  document.getElementById('photo').addEventListener('change', function(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      }
      reader.readAsDataURL(file);
    }
  });

  // 2. Script principal pour soumission, validation et QR code
  document.getElementById('badgeForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const telInput = document.getElementById('telephone');
    const telValue = telInput.value.trim();
    const digitsOnly = telValue.replace(/\D/g, '');

    if (digitsOnly.length < 8 || digitsOnly.length > 15) {
      alert("Le numéro doit contenir entre 8 et 15 chiffres.");
      return false;
    }

    const qrcodeDiv = document.getElementById('qrcode');
    qrcodeDiv.innerHTML = "";

    const nom = document.getElementById('nom').value.trim();
    const prenom = document.getElementById('prenom').value.trim();
    const organisation = document.getElementById('organisation').value.trim();
    const fonction = document.getElementById('fonction').value.trim();
    const date_badge = document.getElementById('date_badge').value;

    const dataToEncode = Nom: ${nom}, Prénom: ${prenom}, Téléphone: ${telValue};

    new QRCode(qrcodeDiv, {
      text: dataToEncode,
      width: 128,
      height: 128,
    });

    const formData = {
      nom: nom,
      prenom: prenom,
      telephone: telValue,
      organisation: organisation,
      fonction: fonction,
      date_badge: date_badge
    };

    fetch('/api/badges', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: realformData
    })
    .then(response => {
      if (!response.ok) throw new Error('Erreur réseau');
      return response.json();
    })
    .then(data => {
      alert('Badge enregistré avec succès !');
      console.log('Succès :', data);
    })
    .catch(error => {
      alert("Erreur lors de l'enregistrement.");
      console.error('Erreur :', error);
    });

  });
</script> 
</body>
</html>