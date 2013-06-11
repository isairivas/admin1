<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotFound
 *
 * @author isai
 */
class NotFound  extends Controller {
    //put your code here
    public function  __construct() {
        parent::__construct();
        $strAction = parent::getAction();
        if (  method_exists($this,$strAction)  ){
            parent::getLoad()->loadView('head');
            $this->$strAction();
            parent::getLoad()->loadView('footer');
        } else {
           Util::redirect( HOME.'notFound/index');
        }
    }

    public function index(){
        echo 'clase no encontrada';
    }
}

