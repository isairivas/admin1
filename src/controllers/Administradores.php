<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administradores
 *
 * @author isai
 */
class Administradores extends Controller {
     private $Usuario;
     private $_name = 'sys_administradores';
     
     public function __construct()
    {
        parent::__construct();
        Param::setMenu('sistema');
        Param::setSubMenu('administradores');
        $strAction = parent::getAction();
        $this->Usuario = parent::getLoad()->loadModel('Usuario');
        if (method_exists($this, $strAction)) {
            $this->$strAction();
        } else {
            Util::redirect(Proyect::getURLHome() . $Proyect->getClassActual() . '/index');
        }
    }

    public function index()
    {
       Param::setTitle('Administradores');
       Param::navigate(array('home' => '','Administradores' => go('administradores')), 'icon-cogs');
       

       $objList = new ListView('Usuarios','usuarios');
       $objList->showColumn(null, array('nombre','usuario','apellido_paterno','apellido_materno','email'));
       $objList->setFields($this->Usuario->getFields());
       $objList->setRegistros($this->Usuario->get());
       $objList->createColumns();

       $usuarios = $this->Usuario->get('administrador_id');
       $registros = array();
       foreach($usuarios as $u){
          switch($u['permisos']){
              case 1: $u['permisos'] = 'Lector'; break;
              case 2: $u['permisos'] = 'Agregar / Editar'; break;
              case 3: $u['permisos'] = 'Eliminar'; break;
              case 4: $u['permisos'] = 'Administrador'; break;
          }
          $registros[] = $u;
       }
        
        
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('administradores/index',array('usuarios' => $registros));
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function add(){

        $arrRegistro = array(
            'nombre' => parent::getPost('registro.nombre',Filter::NAME,true),
            'usuario' => parent::getPost('registro.usuario',Filter::USER,true),
            'apellidos' => parent::getPost('registro.apellidos',Filter::NAME,false),
            'password'  => parent::getPost('registro.password',Filter::PASSWORD,true),
            'email'    => parent::getPost('registro.email',Filter::EMAIL,true),
            'permisos'    => parent::getPost('registro.permisos',Filter::STRING,true),
            'sys_status'    => parent::getPost('registro.status',Filter::STRING,true),
            'sys_created_at' => date('Y-m-d H:i:s')
        );
        if ( parent::getStatusForm() ){
            if ( $this->Usuario->set($arrRegistro) ){
                Util::redirect(go('administradores','index','&add=true'));
            } else {
                Param::setFormError('Error al insertar usuario');
                $_GET['add'] = 'false';
                $this->nuevo();
            }
        } else {
            $strMessages = '';
            foreach(parent::getFormError() as $campo => $strError ){
                $strMessages .= "{$campo}:{$strError} <br/>";
            }
            Param::setFormError($strMessages);
            $_GET['add'] = 'false';
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
            Util::redirect(go('administradores','index','&delete=true'));
        } else {
            Util::redirect(go('administradores','index','&delete=false'));
        }
    }
    function nuevo()
    {
        $arrConf = array(
            'action' => go('administradores','add'),
            'title'  => 'Nuevo Administrador'
        );
        Param::setTitle('Nuevo Administrador');
        
        
        Param::navigate(array('Home' => '','Administradores' => go('administradores'),'Nuevo' => go('administradores','nuevo')), 'icon-cogs');
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('administradores/agregar',$arrConf);
        
        parent::getLoad()->loadView('containers/footer');
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
           // Login::out();
        }
        $arrConf = array(
            'action' => go('administradores','save'),
            'title'  => 'Editar Administrador',
            'usuario' => $arrUsuario
        );
        Param::setTitle(' Administradores | Editar');
        
        Param::navigate(array('Home' => 'index.php','Administradores' => go('administradores'),'Edit' => ''), 'icon-cogs');
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('administradores/agregar',$arrConf);
        
        parent::getLoad()->loadView('containers/footer');

    }

    public function save()
    {
         $intId = parent::getPost('registro.administrador_id',Filter::ID,true);
         $arrRegistro = array(
            'nombre' => parent::getPost('registro.nombre',Filter::NAME,true),
            'usuario' => parent::getPost('registro.usuario',Filter::USER,true),
            'apellidos' => parent::getPost('registro.apellidos',Filter::NAME,false),
            'email'    => parent::getPost('registro.email',Filter::EMAIL,true),
             'notas'   => parent::getPost('registro.notas',Filter::STRING,false),
            'permisos'    => parent::getPost('registro.permisos',Filter::STRING,true),
            'sys_status'    => parent::getPost('registro.status',Filter::STRING,true),
            'sys_updated_at' => date('Y-m-d H:i:s')
        );
         if ( (bool) $strPassword = parent::getPost('usuario.password',Filter::PASSWORD,false) ){
             if (!empty($strPassword )){
                 $arrRegistro['password'] = $strPassword;
             }
         }
        if ( parent::getStatusForm() ){
            if ( $this->Usuario->update($arrRegistro,$intId) ){
                Util::redirect(go('administradores','index','&update=true'));
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
            $_GET['update'] = 'false';
            $this->edit($intId);
        }
    }
}


