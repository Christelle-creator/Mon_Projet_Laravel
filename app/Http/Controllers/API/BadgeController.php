<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    // Affiche le formulaire de création
    public function create()
    {
        return view('badge_form');
    }

    // Sauvegarde un nouveau badge depuis le formulaire
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'fonction' => 'nullable|string|max:255',
            'organisation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048', // gestion fichier image
            'date_badge' => 'nullable|date',
        ]);

        // Gérer l'upload de la photo
        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photos'), $photoName);
        }

        // Contenu QR code
        $data = $request->nom . ' ' . $request->prenom;
        // Générer le QR code en base64 (si tu veux, sinon ignore cette partie)
        // $qrCode = QrCode::format('png')->size(200)->generate($data);
        // $qrCodeBase64 = base64_encode($qrCode);

        // Création du badge
        $badge = Badge::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'fonction' => $request->fonction,
            'organisation' => $request->organisation,
            'photo' => $photoName,
            'date_badge' => $request->date_badge,
            // 'qr_code' => $qrCodeBase64,
        ]);

        // Redirection vers la page du badge créé
        return redirect()->route('badges.show', ['id' => $badge->id]);
    }

    // Affiche un badge spécifique
    public function show($id)
    {
        $badge = Badge::findOrFail($id);
        return view('badge', compact('badge'));
    }
}
