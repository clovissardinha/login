<?php
namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        // Automaticamente protegido
        $user = $this->getLoggedUser();
        
        return view('admin/index', ['usuario' => $user]);
    }

    public function users()
    {
        // Automaticamente protegido
        $user = $this->getLoggedUser();
        
        return view('admin/users', ['usuario' => $user]);
    }
}
