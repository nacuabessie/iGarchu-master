<?php

namespace App\Models;

use Kreait\Firebase\Database;
use Kreait\Firebase\Contract\Firestore;

class Donation
{
    protected $firestore;
    protected $tableName = 'donations'; 

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function getAll()
    {
        $documents = $this->firestore->database()->collection($this->tableName)->documents();
        $firebaseDonations = [];

        foreach ($documents as $document) {
            if ($document->exists()) {
                $firebaseDonations[] = $document->data();
            }
        }

        return $firebaseDonations;
    }

    public function getById($donationId)
    {
        $donationRef = $this->firestore->database()->collection($this->tableName)->document($donationId);
        $donationDocument = $donationRef->snapshot();

        if ($donationDocument->exists()) {
            return $donationDocument->data();
        }

        return null;
    }

    public function create(array $data)
    {
        $newDonation = $this->firestore->database()->collection($this->tableName)->newDocument();
        $newDonation->set($data);

        return $newDonation->id();
    }

    public function updateDonation($donationId, array $data)
    {
        $donationRef = $this->firestore->database()->collection($this->tableName)->document($donationId);
        $donationRef->update($data);

        return true;
    }

    public function updateDonationStatus($donationId, $status)
    {
        $donationRef = $this->firestore->database()->collection($this->tableName)->document($donationId);

        
        // Update the donations's status in Firestore
        $donationRef->update([
            ['path' => 'isActive', 'value' => $status],
        ]);
    }

    public function deleteDonation($donationId)
    {
        $donationRef = $this->firestore->database()->collection($this->tableName)->document($donationId);
        $donationRef->delete();

        return true;
    }
}
