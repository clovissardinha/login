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
 // função para recuperar senha 
    public function lembraSenha()
    {
        helper('form');
        echo view('_common/header'),
        view('lembraSenha'),
        view('_common/footer');
    }
    /**
     * envia um e-mail com a nova senha
     */
    public function recuperaSenha()
    {
        $email = \Config\Services::email();
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $session = \Config\Services::session();
        if ($post = $request->getPost()) {
            //dd($post);
            $val = $this->validate(
                [
                    'email' => 'required|valid_email',
                ]
            );
            //Se não passar na validação retorna para a página anterio (back) com os erros.
            if (!$val) {
                helper('[old]');
                session()->setFlashdata('mensagem', 'preencha o campo email');

                return redirect()->back()->withInput();
            }
            if ($emailUser = $this->administrador->login($post['email'])) {
                $senha = rand(100000, 990000);
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                $user = [
                    'id' => $emailUser['id'],
                    'password' => $senhaHash,
                ];;
                if ($this->administrador->save($user)) {
                    $msg = view('mensagemSenha', [
                        'senha' => $senha,
                        'nome' => $emailUser['nome'],
                    ]);
                    //dd($msg);
                    $email->setFrom('atendimento@larpegumercindo.com.br');
                    $email->setTo($emailUser['email']);
                    $email->setBCC('clovis.sardinha@gmail.com');
                    $email->setSubject("Recuperação de senha do Lar Padre Gumercindo");
                    $email->setMessage($msg);
                    if ($email->send()) {
                        session()->setFlashdata('mensagem', 'Mensagem enviada com sucesso!');
                        return redirect()->to(base_url());
                    }
                } else {
                    session()->setFlashdata('mensagem', 'dados incorretos');
                    return redirect()->to(base_url());
                }
            }
        } else {
            return redirect()->back()->with('mensagem', 'email não encontrado. Solicite cadastramento');
        }
    }
    public function logout()
    {
        return $this->doLogout();
    }
}
