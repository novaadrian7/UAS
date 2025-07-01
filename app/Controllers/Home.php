<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('select_role');
    }

    public function choose($role)
    {
    if (in_array($role, ['librarian', 'member'])) {
        session()->set('role', $role);
        return redirect()->to('/books');
    }

    return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
