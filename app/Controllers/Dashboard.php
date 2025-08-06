<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Este método agora é automaticamente protegido
        $user = $this->getLoggedUser();
        
        $data = [
            'usuario' => $user,
            'titulo' => 'Dashboard'
        ];
        return view('_common/header',$data)
            . view('_common/lateral')
            . view('dashboard',$data)
            . view('_common/footer');
    }
}
