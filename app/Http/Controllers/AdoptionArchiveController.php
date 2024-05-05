<?php

namespace App\Http\Controllers;

use App\Models\AdoptionArchive;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class AdoptionArchiveController extends Controller
{
    protected $firestore;
    protected $adoptionArchiveModel;

    public function __construct(Firestore $firestore, AdoptionArchive $adoptionArchiveModel)
    {
        $this->firestore = $firestore;
        $this->adoptionArchiveModel = $adoptionArchiveModel;
    }

    public function getAll()
    {
        $adoptionArchive = $this->adoptionArchiveModel->getAll();

        if (!$adoptionArchive) {
            return response()->json(['message' => 'Adoption Archive not found'], 404);
        }

        // return response()->json($adoptionArchive);
        error_log(json_encode($adoptionArchive));
        return view('archives', ['archives' => $adoptionArchive]);

    }

}
