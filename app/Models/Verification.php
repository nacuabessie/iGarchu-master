<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;

class Verification extends Model
{
    protected $firestore;

    protected $fillable = ['id', 'image', 'orgId'];

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function getById($userId)
    {
        $userRef = $this->firestore->database()->collection('verification')->where('orgId', '=', $userId)->where('active', '=', true)->limit(1)->documents();
        $userDocuments = [];

        foreach ($userRef as $document) {
            if ($document -> exists()) {
                $userDocuments[] = $document->data();
            }
        }

        return count($userDocuments) > 0 ? $userDocuments[0] : null;
    }

}
