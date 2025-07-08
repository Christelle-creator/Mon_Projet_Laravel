<?php

namespace App\Http\Controllers;

use Exception;
use Reflection;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    //Méthode pour retourner tous les badges
    public function index()
    {
        $badges = Badge::all();
        return view('index', compact('badges'));
    }

    //Méthode pour créer un nouveau badge
    public function store(Request $request)
    {
        //Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'qr_code' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'organisation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_badge' => 'nullable|date',
        ]);
        
        //Contenu à mettre dans le QR code(personnalisable)
        $data = $request->nom .' ' . $request->prenom;

        //Générer le QR code au format PNG et l'encoder en base 64
        $qrCode = QrCode::format('png')->size(200)->generate($data);
        $qrCodeBase64 = base64_encode($qrCode);

        //Création du badge
        $badge = Badge::create([
        $badge -> nom = $request->nom,
        $badge -> prenom = $request->prenom,
        $badge -> telephone = $request->telephone,
        $badge -> fonction = $request->fonction,
        $badge -> organisation = $request->organisation,
        $badge -> photo = $request->photo,
        $badge -> date_badge = $request->date_badge,
        $badge -> qr_code = $qrQCodeBase64,
        ]);

        return response()->json($badge, 201);
    }

    public function create() {
        return view('create');
    }



// Afficher un badge (vue détail)
public function show($id)
{
    $badge = Badge::findOrFail($id);
    return view('show', compact('badge')); 
}

// Retourner le formulaire d'édition avec les données du badge
public function edit($id)
{
    $badge = Badge::findOrFail($id);
    return view('edit', compact('badge'));
}

// Mettre à jour un badge
public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'nullable|string|max:20',
        'fonction' => 'nullable|string|max:255',
        'organisation' => 'nullable|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'date_badge' => 'nullable|date',
    ]);

    $badge = Badge::findOrFail($id);

    if ($request->hasFile('photo')) {
        $filePath = $request->file('photo')->store('photos', 'public');
        $badge->photo = $filePath;
    }

    // Mettre à jour les autres champs
    $badge->nom = $request->nom;
    $badge->prenom = $request->prenom;
    $badge->telephone = $request->telephone;
    $badge->fonction = $request->fonction;
    $badge->organisation = $request->organisation;
    $badge->date_badge = $request->date_badge;

    // Regénérer QR code si nécessaire
    $data = $request->nom .' ' . $request->prenom;
    $qrCode = QrCode::format('png')->size(200)->generate($data);
    $badge->qr_code = base64_encode($qrCode);

    $badge->save();

    return redirect()->route('badges.show', $badge->id)->with('success', 'Badge mis à jour avec succès');
}

// Supprimer un badge
public function destroy($id)
{
    $badge = Badge::findOrFail($id);
    $badge->delete();

    return redirect()->route('badges.index')->with('success', 'Badge supprimé avec succès');
}

}    
