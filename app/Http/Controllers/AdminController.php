<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Correct import for Session facade

class AdminController extends Controller
{
    protected $adminModel;

    public function __construct(Admin $adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($this->adminModel->login($username, $password)) {
            Session::put('login', true);

            return redirect('users');
        }
        return view('login', ['message' => 'Unauthorized!']);
    }

    public function logout(Request $request)
    {
        Session::flush(); 
        return redirect()->route('login');
    }
}
