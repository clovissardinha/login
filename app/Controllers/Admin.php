<?php
namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        // Automaticamente protegido
        $user = $this->getLoggedUser();
        $data = [
            'usuario' => $user,
            'titulo' => 'Dashboard'
        ];
       return view('_common/header',$data)
            . view('_common/lateral')
            . view('admin/index',$data)
            . view('_common/footer');
    }

    public function users()
    {
        // Automaticamente protegido
        $user = $this->getLoggedUser();
        
        return view('admin/users', ['usuario' => $user]);
    }
}
