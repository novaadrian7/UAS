<?php

namespace App\Controllers;
use App\Models\UserModel;

class LoginController extends BaseController {
    public function index() {
        return view('login');
    }

    public function login() {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('username', $username)->first();

        if ($user && $password === $user['password']) {
            session()->set([
                'username' => $user['username'],
                'role' => $user['role'],
                'logged_in' => true
            ]);
            return redirect()->to('/books');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}
