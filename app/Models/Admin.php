<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;
class Admin extends Model
{
    
    protected $firestore;
    protected $tableName = 'admin'; 

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function login($username, $password) 
    {
        $adminUser = $this->getAdminAccountByUsername($username);

        if ($adminUser !== null && isset($adminUser['password']) && $adminUser['password'] === $password) {
            return true;
        } else {
            return false;
        }
    }

    
    public function getAdminAccountByUsername($username)
{
    $adminCollection = $this->firestore->database()->collection('admin');
    
    $adminQuery = $adminCollection->where('username', '=', $username);

    $adminDocuments = $adminQuery->documents();

    $adminDocument = null;

    foreach ($adminDocuments as $document) {
        $adminDocument = $document;
        break;
    }

    if ($adminDocument !== null && $adminDocument->exists()) {
        return $adminDocument->data();
    }

    return null;
}


    
}
