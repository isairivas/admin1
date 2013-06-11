<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Isai
 */
class Home extends Controller {

    public function __construct() {
        
        parent::__construct();
        $Proyect = Proyect::getInstance();
        $strAction = parent::getAction();
        if (method_exists($this, $strAction)) {
            Param::setTitle('Mayan');
            
            $this->$strAction();
           
        } else {
            $this->index();
        }
    }

    public function index() {
       // $Rsa = new Rsa();
       // $id = $Rsa->decrypt($_SESSION['lw.rys.user.id'], $_SESSION['lw.rys.cid']);
        
        //parent::getLoad()->loadView('head');
        //parent::getLoad()->loadView('menu_superior');
        //parent::getLoad()->loadView('home');
        Param::setMenu('catalogos');
        Param::setSubMenu('dashboard');
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/footer');
    }

}

