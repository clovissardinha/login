<?php

// app/Controllers/BaseController.php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];
    /**
     * Controladores que não precisam de autenticação
     * Adicione aqui os controladores/métodos que devem ser públicos
     */
    protected $publicControllers = [
        'Home',
        'Login',
        'Register'
    ];

    /**
     * Métodos específicos que não precisam de autenticação
     */
    protected $publicMethods = [
        'Home::index',
        'Home::login',
        'Login::index',
        'Login::authenticate',
        'Register::index',
        'Register::store'
    ];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        
        // Verificar autenticação
        $this->checkAuthentication();
    }

    /**
     * Verifica se o usuário está autenticado
     */
    protected function checkAuthentication()
    {
        // Pegar o nome do controlador e método atual
        $router = service('router');
        $controllerName = $router->controllerName();
        $methodName = $router->methodName();
        
        // Extrair apenas o nome da classe sem namespace
        $controllerClass = class_basename($controllerName);
        $fullMethod = $controllerClass . '::' . $methodName;

        // Verificar se é um controlador ou método público
        if (in_array($controllerClass, $this->publicControllers) || 
            in_array($fullMethod, $this->publicMethods)) {
            return;
        }

        // Verificar se o usuário está logado
        if (!$this->isLoggedIn()) {
            // Salvar a URL que o usuário tentou acessar
            $this->session->setTempdata('redirect_url', current_url(), 300);
            
            // Definir mensagem de erro
            $this->session->setFlashdata('mensagem', 'Você precisa estar logado para acessar esta página');
            
            // Redirecionar para a página de login
            redirect()->to(base_url())->send();
            exit();
        }
    }

    /**
     * Verifica se o usuário está logado
     */
    protected function isLoggedIn(): bool
    {
        return $this->session->get('logedin') === true;
    }

    /**
     * Retorna os dados do usuário logado
     */
    protected function getLoggedUser(): ?array
    {
        if ($this->isLoggedIn()) {
            return [
                'id' => $this->session->get('usuario'),
                'nome' => $this->session->get('nome'),
                'logedin' => $this->session->get('logedin')
            ];
        }
        return null;
    }

    /**
     * Faz logout do usuário
     */
    protected function doLogout()
    {
        $this->session->remove(['usuario', 'nome', 'logedin']);
        $this->session->setFlashdata('mensagem', 'Logout realizado com sucesso');
        return redirect()->to(base_url());
    }
}
