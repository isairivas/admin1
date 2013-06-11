<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author isai
 */
class Login extends Controller {
     private $Model;
     private $Proyect;
     private $Loader;

     public function __construct()
    {
        parent::__construct();
        $this->Proyect = Proyect::getInstance();
        $strAction = parent::getAction();
        $this->Loader = Loader::getInstance();
        $this->Model = $this->Loader->loadModel('Usuario');
        if (method_exists($this, $strAction)) {
            $this->$strAction();
            //parent::getLoad()->loadView('footer');
        } else {
            Util::redirect(Proyect::getURLHome() . $Proyect->getClassActual() . '/index');
        }
        
    }
    public function index()
    {
        
        //$_SESSION['lw.rys.login.key'] = rand(1,9999999);
        Param::setTitle('Login | Entrar');
        Param::setCss('login');
        if ( isset($_GET['invalid']) ){
            Param::setFormError('El usuario o el password o ambos son incorrectos');
        } 
        parent::getLoad()->setTemplate('templates/mooncake/');
        
        $this->Loader->loadView('containers/login');
       
    }

    public function authenticate()
    { 
        
        if ( true ){
            $strUsuario = parent::getPost('login.usuario',Filter::USER,true); 
            $strPassword = parent::getPost('login.password',Filter::PASSWORD,true);
            if ( parent::getStatusForm() ){
                if ( (bool)$arrUser = $this->Model->getUserWhitPassword($strUsuario,$strPassword) ){

                    $_SESSION['isai'] .= '<br/>ha entrado a loguearse';
                    $_SESSION['user'] = $arrUser;
                    Util::redirect('index.php');
                    
                } else {
                    Util::redirect(_link('login','index','&invalid=false'));
                }
            } else {
                Util::redirect(_link('login','index','&invalid=false'));
            }
        } else {
		echo 'error aqiu';
            $this->out();
        }
        unset($_SESSION['lw.rys.login.key'] );
    }
    
    public static function out()
    {
        foreach($_SESSION as $key => $item ){
            unset($_SESSION[$key]);
        }
        Util::redirect(Proyect::getURLHome());
    }

}
