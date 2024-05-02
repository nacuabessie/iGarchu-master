<?php

namespace App\Http\Controllers;

use App\Models\Verification;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class VerificationController extends Controller
{
    protected $firestore;
    protected $verificationModel;

    public function __construct(Firestore $firestore, Verification $verificationModel)
    {
        $this->firestore = $firestore;
        $this->verificationModel = $verificationModel;
    }

    public function getVerificationById($userId)
    {
        $verification = $this->verificationModel->getById($userId);

        if (!$verification) {
            return response()->json(['message' => 'Verification not found'], 404);
        }

        return response()->json($verification);
    }

    
    public function getAcceptedById($userId)
    {
        $verification = $this->verificationModel->getAcceptedByUserId($userId);
        error_log(json_encode($verification));

        if (!$verification) {
            return response()->json(['message' => 'Verification not found'], 404);
        }

        return response()->json($verification);
    }

}
