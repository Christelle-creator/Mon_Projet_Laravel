<?php

namespace App\Http\Controllers\API;

//use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    //Méthode pour retourner tous les badges
    public function index()
    {
        $badges = Badge::all();
        return response()->json($badges);
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
            'photo' => 'nullable|string|max:255',
            'date_badge' => 'nullable|date',
        ]);

        //Contenu à mettre dans le QR code(personnalisable)
        $data = $request->nom .' ' . $request->prenom;

        //Générer le QR code au format PNG et l'encoder en base 64
        $qrCode = QrCode::format('png')->size(200)->generate($data);
        $qrQCodeBase64 = base64_encode($qrCode);

        //Création du badge
        $badge = Badge::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'fonction' => $request->fonction,
            'organisation' => $request->organisation,
            'photo' => $request->photo,
            'date_badge' => $request->date_badge,
            'qr_code' => $qrQCodeBase64,
        ]);

        return response()->json($badge, 201);
    }

    public function create() {
        return 'Formulaire chargé!';
    }
}    
