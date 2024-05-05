<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;

class AdoptionArchive extends Model
{
    protected $firestore;

    protected $fillable = ['id', 'orgId', 'pet', 'user'];

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function getAll()
    {
        $userRef = $this->firestore->database()->collection('adoptionarchive')->documents();
        $userDocuments = [];

        foreach ($userRef as $document) {
            if ($document -> exists()) {
                $userDocuments[] = $document->data();
            }
        }

        return $userDocuments;
    }

}
