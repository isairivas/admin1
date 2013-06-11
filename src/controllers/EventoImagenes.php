<?php


/**
 * Description of EventoImagenes
 *
 * @author isai
 */
class EventoImagenes extends Controller {
    private $_name = 'evento-imagenes';
    private $_table ='eventos_imagenes';
    private $_uploads;
    private $_primary = 'evento_imagen_id';
    
    function __construct() {
        parent::__construct();
        Param::setMenu('catalogos');
        Param::setSubMenu('eventos');
        Param::setTitle('Imagenes de Evento');
        $this->_uploads = PATH_UPLOADS.'images/eventos_imagenes/';
        $strAction = parent::getAction();
        if (method_exists($this, $strAction)) {
            $this->$strAction();
        } else {
            $this->index();
        }
    }
    
    public function index()
    {
       
       $proyect = Proyect::getInstance();
       $params = $proyect->getParamsURL();
       $eventoId = isset($params[0])?$params[0]:'error';
       if(!is_numeric($eventoId)){
           Util::redirect(go('eventos'));
       }
       $eventosDB = new Model('eventos');
       $evento = $eventosDB->getById($eventoId);
       
       Param::setTitle('Imagenes del evento: '.$evento['nombre']);
       Param::navigate(array('Home' => HOME,'Eventos' => go('eventos'),'Imagenes' => go($this->_name,'view',array($eventoId)) ), 'icon-database');
       
       $modelDB = new Model($this->_table,$this->_primary);
       $records = $modelDB->toArray($modelDB->getByColumn('eventos_id',$eventoId));
       $aData = array(
           'registros' => $records,
           '_name'      => $this->_name,
           'evento_id'   => $eventoId
       ); 
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('eventos_imagenes/index',$aData);
        
        parent::getLoad()->loadView('containers/footer');
        
    }
    public function view(){
        $this->index();
    }
    
    public function nuevo($eventoId = 'error') {
        $proyect = Proyect::getInstance();
        if( $eventoId == 'error'){
            $params = $proyect->getParamsURL();
            $eventoId = isset($params[0]) ? $params[0] : 'error';
        }
        
        if (!is_numeric($eventoId)) {
            Util::redirect(go('eventos'));
        }
        $eventosDB = new Model('eventos');
       $evento = $eventosDB->getById($eventoId);
        
        
        Param::setTitle('Nueva Imagen del evento: '.$evento['nombre']);
        Param::navigate(array('Home' => HOME,'Eventos' => go('eventos'),'Imagenes' => go($this->_name,'view',array($eventoId)),'Nueva' => go($this->_name,'nuevo',array($eventoId)) ), 'icon-database');
        
        $aData = array( 
            '_name'  => $this->_name,
            'action' => go($this->_name,'agregar'),
            'eventos_id' => $eventoId,
            'uploads'  => $this->_uploads
            );
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('eventos_imagenes/agregar',$aData);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function agregar(){
        $camposObligatorios = array('titulo_es','sys_status','eventos_id');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['titulo_es'] = parent::getPost('registro.titulo_es', Filter::STRING, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['eventos_id'] = parent::getPost('registro.eventos_id', Filter::INT, TRUE);
        $dataUpdate['sys_created_at'] = date('Y-m-d H:i:s');
        $dataUpdate['imagen'] = $this->uploadsImages('imagen', $this->_uploads);
        
        $model = new Model($this->_table, $this->_primary);
        if ( parent::getStatusForm() ){
           if ( $model->set($dataUpdate) ){
                Util::redirect(go($this->_name,'view','&param1='.$dataUpdate['eventos_id'].'&add=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $this->nuevo($dataUpdate['eventos_id']);
            } 
        } else {
            Param::setFormError(parent::getFormErrorString());
            $_GET['add'] = 'false';
            $this->nuevo($dataUpdate['eventos_id']);
        }
    }
    
    public function edit($intId=0){
        if($intId == 0){
            $arrParamURL = Param::getParamURL();
            $intId = $arrParamURL[0];
        }
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $modelDB = new Model($this->_table, $this->_primary);
        $record = $modelDB->getById($intId);
        $eventoId = $record['eventos_id'];
        $eventosDB = new Model('eventos');
        $evento = $eventosDB->getById($eventoId);
        
        Param::navigate(array('Home' => HOME,'Eventos' => go('eventos'),'Imagenes' => go($this->_name,'view',array($eventoId)),'Nueva' => go($this->_name,'edit',array($intId)) ), 'icon-database');
        Param::setTitle('Editar Imagen del evento: '.$evento['nombre']);
        
        $aData = array( 
            '_name'  => $this->_name,
            'action' => go($this->_name,'save'),
            'eventos_id' => $eventoId,
            'title'  => 'Editar Imagen del evento '.$evento['nombre'],
            'registro' => $record,
            'uploads'  => $this->_uploads
        );
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('eventos_imagenes/agregar',$aData);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function save(){
        $camposObligatorios = array('titulo_es','sys_status','eventos_id',$this->_primary);
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['titulo_es'] = parent::getPost('registro.titulo_es', Filter::STRING, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['sys_updated_at'] = date('Y-m-d H:i:s');

        $eventoId = parent::getPost('registro.eventos_id', Filter::INT, TRUE);
        $intId = parent::getPost('registro.'.$this->_primary,Filter::ID,true);
        $model = new Model($this->_table, $this->_primary);
        $nuevaImagen = $this->uploadsImages('imagen', $this->_uploads);
        
        if( $nuevaImagen && !empty($nuevaImagen) ){
            $dataUpdate['imagen'] = $nuevaImagen;
            $pakal = $model->getById($intId);
            if( file_exists($this->_uploads.$pakal['imagen']) ){
                unlink($this->_uploads.$pakal['imagen']);
            }
            if( file_exists($this->_uploads.'thumb_admin_'.$pakal['imagen']) ){
                unlink($this->_uploads.'thumb_admin_'.$pakal['imagen']);
            }
        }
        if ( parent::getStatusForm() ){
           if ( $model->update($dataUpdate,$intId) ){
                Util::redirect(go($this->_name,'view','&param1='.$eventoId.'&update=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $this->edit($dataUpdate[$this->_primary]);
            } 
        } else {
            Param::setFormError(parent::getFormErrorString());
            $_GET['update'] = 'false';
            $this->edit($intId);
        }
    }
    
    public function delete()
    {
        $arrParamURL = Param::getParamURL();
        $intId = $arrParamURL[0];
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $model = new Model('eventos_imagenes', $this->_primary);
        $record = $model->getById($intId);
        if( file_exists($this->_uploads.$record['imagen']) ){
            unlink($this->_uploads.$record['imagen']);
        }
        if( file_exists($this->_uploads.'thumb_admin_'.$record['imagen']) ){
            unlink($this->_uploads.'thumb_admin_'.$record['imagen']);
        }
        if ( $model->delete($intId) ){
            Util::redirect(go($this->_name,'view','&param1='.$record['eventos_id'].'&delete=true'));
        } else {
            Util::redirect(go($this->_name,'view','&param1='.$record['eventos_id'].'&delete=false'));
        }
    }
}

