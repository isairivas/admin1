<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author isai
 */
class Usuarios extends Controller {

     private $Usuario;
     
     public function __construct()
    {
        parent::__construct();
        $strAction = parent::getAction();
        $this->Usuario = parent::getLoad()->loadModel('Usuario');
        if (method_exists($this, $strAction)) {
            $this->$strAction();
            parent::getLoad()->loadView('footer');
        } else {
            Util::redirect(Proyect::getURLHome() . $Proyect->getClassActual() . '/index');
        }
    }

    public function index()
    {
       Param::setTitle('Goiti | Usuarios');

       $objList = new ListView('Usuarios','usuarios');
       $objList->showColumn(null, array('nombre','usuario','apellido_paterno','apellido_materno','email'));
       $objList->setFields($this->Usuario->getFields());
       $objList->setRegistros($this->Usuario->get());
       $objList->createColumns();

       parent::getLoad()->loadView('head');
       parent::getLoad()->loadView('menu_superior');
       View::renderList($objList);
    }
    
    public function add(){

        $arrRegistro = array(
            'nombre' => parent::getPost('usuario.nombre',Filter::NAME,true),
            'usuario' => parent::getPost('usuario.usuario',Filter::USER,true),
            'apellido_paterno' => parent::getPost('usuario.apellido_paterno',Filter::NAME,true),
            'apellido_materno' => parent::getPost('usuario.apellido_materno',Filter::NAME,false),
            'password'  => parent::getPost('usuario.password',Filter::PASSWORD,true),
            'email'    => parent::getPost('usuario.email',Filter::EMAIL,true),
            'status'    => 'A'
        );
        if ( parent::getStatusForm() ){
            if ( $this->Usuario->set($arrRegistro) ){
                Util::redirect(Proyect::getURLHome().'usuarios/index/?add=true');
            } else {
                Param::setFormError('Error al insertar usuario');
                $this->nuevo();
            }
        } else {
            $strMessages = '';
            foreach(parent::getFormError() as $campo => $strError ){
                $strMessages .= "{$campo}:{$strError} <br/>";
            }
            Param::setFormError($strMessages);
            $this->nuevo();
        }
    }

    public function delete()
    {
        $arrParamURL = Param::getParamURL();
        $intId = $arrParamURL[0];
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }

        if ( $this->Usuario->delete($intId) ){
            Util::redirect(Proyect::getURLHome().'usuarios/index/?delete=true');
        } else {
            Util::redirect(Proyect::getURLHome().'usuarios/index/?delete=false');
        }
    }
    function nuevo()
    {
        $arrConf = array(
            'action' => Proyect::getURLHome().'usuarios/add',
            'title'  => 'Nuevo Usuario'
        );
        Param::setTitle('Nuevo usuario');
        parent::getLoad()->loadView('head');
        parent::getLoad()->loadView('menu_superior');
        parent::getLoad()->loadView('usuarios_form',$arrConf);
    }
    public function edit($intId = 0)
    {
        if($intId == 0){
            $arrParamURL = Param::getParamURL();
            $intId = $arrParamURL[0];
        }
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $arrUsuario = $this->Usuario->getById($intId);
        if ( !$arrUsuario ){
            Login::out();
        }
        $arrConf = array(
            'action' => Proyect::getURLHome().'usuarios/save',
            'title'  => 'Editar Usuario',
            'usuario' => $arrUsuario
        );
        Param::setTitle('Goiti | Editar Usuario ');
        parent::getLoad()->loadView('head');
        parent::getLoad()->loadView('menu_superior');
        parent::getLoad()->loadView('usuarios_form',$arrConf);
    }

    public function save()
    {
         $intId = parent::getPost('usuario.id',Filter::ID,true);
         $arrRegistro = array(
            'nombre' => parent::getPost('usuario.nombre',Filter::NAME,true),
            'usuario' => parent::getPost('usuario.usuario',Filter::USER,true),
            'apellido_paterno' => parent::getPost('usuario.apellido_paterno',Filter::NAME,true),
            'apellido_materno' => parent::getPost('usuario.apellido_materno',Filter::NAME,false),
            'email'    => parent::getPost('usuario.email',Filter::EMAIL,true),
            'status'    => 'A'
        );
         if ( (bool) $strPassword = parent::getPost('usuario.password',Filter::PASSWORD,false) ){
             if (!empty($strPassword )){
                 $arrRegistro['password'] = $strPassword;
             }
         }
        if ( parent::getStatusForm() ){
            if ( $this->Usuario->update($arrRegistro,$intId) ){
                Util::redirect(Proyect::getURLHome().'usuarios/index/?update=true');
            } else {
                Param::setFormError('Error al actualizar usuario');
                $this->edit($intId);
            }
        } else {
            $strMessages = '';
            foreach(parent::getFormError() as $campo => $strError ){
                $strMessages .= "{$campo}:{$strError} <br/>";
            }
            Param::setFormError($strMessages);
            $this->edit($intId);
        }
    }
}

