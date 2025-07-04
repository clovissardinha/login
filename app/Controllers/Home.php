<?php
namespace App\Controllers;
class Home extends BaseController
{
    protected $administrador;

    public function __construct()
    {
        // Carregar o model do administrador
        $this->administrador = model('AdministradorModel'); // Ajuste o nome do seu model
    }

    public function index()
    {
        // Página de login - método público
        return view('login'); // Sua view de login
    }

    public function login()
    {
        helper(['form']);
        
        if ($post = $this->request->getPost()) {
            // Validação dos dados
            $validation = $this->validate([
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ]);

            if (!$validation) {
                $this->session->setFlashdata('mensagem', 'Dados inválidos');
                $this->session->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            // Buscar usuário
            $usuario = $this->administrador->login($post['email']);

            if (!$usuario) {
                $this->session->setFlashdata('mensagem', 'Email ou senha incorretos');
                return redirect()->back()->withInput();
            }

            // Verificar senha
            if (password_verify($post['password'], $usuario['password'])) {
                // Criar sessão
                $sessionData = [
                    'usuario' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'logedin' => true
                ];
                
                $this->session->set($sessionData);
                
                // Verificar se existe URL de redirecionamento
                $redirectUrl = $this->session->getTempdata('redirect_url');
                if ($redirectUrl) {
                    return redirect()->to($redirectUrl);
                }
                
                // Redirecionar para dashboard
                return redirect()->to('Dashboard');
            } else {
                $this->session->setFlashdata('mensagem', 'Email ou senha incorretos');
                return redirect()->back()->withInput();
            }
        }

        // Se não há dados POST, redirecionar para página inicial
        return redirect()->to(base_url());
    }

    public function logout()
    {
        return $this->doLogout();
    }
}
