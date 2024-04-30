<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class UserController extends Controller
{
    protected $firestore;
    protected $userModel;

    public function __construct(Firestore $firestore, User $userModel)
    {
        $this->firestore = $firestore;
        $this->userModel = $userModel;
    }

    public function getAllUsers()
    {
        $users = $this->userModel->getAll();
        return view('users', ['users' => $users]);
    }

    
    public function getAllOrganizationRequest()
    {
        $users = $this->userModel->getAllOrganizationRequest();
        return view('organization-request', ['users' => $users]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|integer',
            'address' => 'string|nullable',
            'description' => 'string|nullable',
            'email' => 'required|email',
            'contactNo' => 'string|nullable',
            'orgName' => 'nullable',
            'cover' => 'string|nullable',
            'profile' => 'required|string',
        ]);
        $data = $request->all();
        $userId = $this->userModel->create($data);
        return response()->json(['message' => "User with ID $userId created successfully"]);
    }

    public function getUserById($userId)
    {
        $user = $this->userModel->getById($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }


    public function deleteUser($id)
    {
        $isUserDeleted = $this->userModel->deleteUser($id);

        if($isUserDeleted)
        {
            return response()->json($isUserDeleted);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function updateUser(Request $request, $userId)
    {
        $request->validate([
            'role' => 'integer',
            'username' => 'string',
            'password' => 'string',
            'firstName' => 'string',
            'lastName' => 'string',
            'orgName' => 'string|nullable',
            'address' => 'string|nullable',
            'contactNo' => 'string|nullable',
            'email' => 'email',
            'profile' => 'string',
            'cover' => 'string|nullable',
            'description' => 'string|nullable',
        ]);

        $data = $request->all();
        $isUserUpdated = $this->userModel->updateUser($userId, $data);

        if($isUserUpdated)
        {
            return response()->json(['message' => "User with ID $userId updated successfully"]);
        }

        return response()->json(['message' => "User not found"], 404);
    }


    public function acceptUser($userId)
    {
        try {
            // Assuming you have a method in your userModel to handle user acceptance
            $this->userModel->acceptUser($userId);

            return redirect()->route('requests')->with('success', 'User accepted successfully');
        } catch (\Exception $e) {
            return redirect()->route('requests')->with('error', 'Failed to reject user: ' . $e->getMessage());
        }
    }

    public function rejectUser($userId)
    {
        try {
            // Assuming you have a method in your userModel to handle user rejection
            $this->userModel->rejectUser($userId);

            return redirect()->route('requests')->with('success', 'User rejected successfully');
        } catch (\Exception $e) {
            return redirect()->route('requests')->with('error', 'Failed to reject user: ' . $e->getMessage());
        }
    }
}
