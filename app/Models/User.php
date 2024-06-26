<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;

class User extends Model
{
    protected $firestore;

    protected $fillable = ['id', 'role', 'username', 'password', 'firstName', 'lastName', 'orgName', 'address', 'contactNo', 'email', 'profile', 'cover', 'description'];

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function getAll()
    {
        $documents = $this->firestore->database()->collection('users')->documents();
        $firebaseUsers = [];

        

        foreach ($documents as $document) {
            if ($document->exists()) {
                $firebaseUsers[] = $document->data();
                echo "<script>console.log(" . json_encode($document->data()) . ");</script>";
            }
        }
        return $firebaseUsers;
    }

    public function getAllOrganizationRequest()
    {
        $documents = $this->firestore->database()->collection('users')->documents();
        $firebaseUsers = [];
    
        foreach ($documents as $document) {
            if ($document->exists()) {
                $userData = $document->data();

                echo "<script>console.log(" . json_encode($document->data()) . ");</script>";
    
                if (isset($userData['verificationStatus']) && $userData['role'] == 2 && ($userData['verificationStatus'] == "PENDING" || $userData['verificationStatus'] == "pending")) {
                    $firebaseUsers[] = $userData;
                }
            }
        }
    
        return $firebaseUsers;
    }

    public function getById($userId)
    {
        $userRef = $this->firestore->database()->collection('users')->document($userId);
        $userDocument = $userRef->snapshot();

        if ($userDocument->exists()) {
            return $userDocument->data();
        }

        return null;
    }

    public function create(array $data)
    {
        $newUser = $this->firestore->database()->collection('users')->newDocument();
        $newUser->set($data);
        return $newUser->id();
    }

    public function updateUser($userId, array $data)
    {
        $userRef = $this->firestore->database()->collection('users')->document($userId);
        $userRef->update($data);

        return true;
    }

    protected function updateUserStatus($userId, $status)
    {
        $userRef = $this->firestore->database()->collection('users')->document($userId);

        
        // Update the user's status in Firestore
        $userRef->update([
            ['path' => 'verificationStatus', 'value' => $status],
        ]);
    }

    public function acceptUser($userId)
    {
        $this->updateUserStatus($userId, 'successful');
    }

    public function rejectUser($userId)
    {

        $this->updateUserStatus($userId, 'denied');
    }

    public function deleteUser($userId)
    {
        $userRef = $this->firestore->database()->collection('users')->document($userId);
        $userRef->delete();

        return true;
    }
}
