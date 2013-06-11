<?php


/**
 * Description of Pakales
 *
 * @author isai
 */
class Pakales extends Controller {
    
    private $_name = 'pakales';
    private $_uploadsPatrocinadores = '';
    private $_uploadsUbicacion = '';
    
    public function __construct() {
        parent::__construct();
        Param::setMenu('catalogos');
        Param::setSubMenu('pakales');
        Param::setTitle('Pakales');
        $this->_uploadsPatrocinadores = PATH_UPLOADS.'images/patrocinadores/';
        $this->_uploadsUbicacion = PATH_UPLOADS.'images/ubicaciones/';
        $strAction = parent::getAction();
        if (method_exists($this, $strAction)) {
            $this->$strAction();
        } else {
            $this->index();
        }
    }
    
    public function index()
    {
       Param::setTitle('Pakales');
       Param::navigate(array('Home' => 'index.php','Pakales' => go('pakales')), 'icon-database');
       

       $pakalesDB = new Model('pakales', 'pakal_id');
       $records = $pakalesDB->toArray($pakalesDB->get());
       
       $aData = array(
           'registros' => $records,
           '_name'      => $this->_name
       ); 
        
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('pakales/index',$aData);
        
        parent::getLoad()->loadView('containers/footer');
        
    }
    
    public function nuevo(){
        
        Param::navigate(array('Home' => 'index.php','Pakales' => go('pakales'),'Nuevo' => go('pakales','nuevo')), 'icon-database');
        Param::setTitle('Agregar nuevo Pakal');
        
        $aData = array('_name'  => $this->_name,'action' => go('pakales','agregar'));

        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('pakales/agregar',$aData);
        
        parent::getLoad()->loadView('containers/footer');

    }
    
    public function agregar(){
        $camposObligatorios = array('titulo_es','sys_status','artista_nombre');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['titulo_es'] = parent::getPost('registro.titulo_es', Filter::STRING, TRUE);
        $dataUpdate['artista_nombre'] = parent::getPost('registro.artista_nombre', Filter::STRING, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['sys_created_at'] = date('Y-m-d H:i:s');
        $dataUpdate['patrocinador_logo'] = $this->uploadsImages('patrocinador_imagen', $this->_uploadsPatrocinadores);
        $dataUpdate['ubicacion_foto'] = $this->uploadsImages('ubicacion_foto', $this->_uploadsUbicacion);
        $model = new Model('pakales', 'pakal_id');
        if ( parent::getStatusForm() ){
           if ( $model->set($dataUpdate) ){
                Util::redirect(go('pakales','index','&add=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $_GET['add'] = 'false';
                dump($dataUpdate);
                $this->nuevo();
            } 
        } else {
            Param::setFormError(parent::getFormErrorString());
            $_GET['add'] = 'false';
            $this->nuevo();
        } 
    }
    
    public function edit($intId = 0){
        if($intId == 0){
            $arrParamURL = Param::getParamURL();
            $intId = $arrParamURL[0];
        }
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $modelDB = new Model($this->_name, 'pakal_id');
        $record = $modelDB->getById($intId);

        $arrConf = array(
            'action' => go('pakales','save'),
            'title'  => 'Editar Pakal',
            'registro' => $record
        );
        Param::setTitle(' Pakales | Editar');
        
        Param::navigate(array('home' => HOME,'Pakales' => go('pakales'),'Editar' => ''), 'icon-cogs');
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('pakales/agregar',$arrConf);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function save(){
        $intId = parent::getPost('registro.pakal_id',Filter::ID,true);
        $camposObligatorios = array('titulo_es','sys_status','artista_nombre');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['titulo_es'] = parent::getPost('registro.titulo_es', Filter::STRING, TRUE);
        $dataUpdate['artista_nombre'] = parent::getPost('registro.artista_nombre', Filter::STRING, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['sys_updated_at'] = date('Y-m-d H:i:s');
        
        $model = new Model('pakales', 'pakal_id');
        /* si se subio una nueva foto agregarla y borrar las que habia para el logo del patrocinador */
        $nuevaImagen = $this->uploadsImages('patrocinador_imagen', $this->_uploadsPatrocinadores);
        if( $nuevaImagen && !empty($nuevaImagen) ){
            $dataUpdate['patrocinador_logo'] = $nuevaImagen;
            $pakal = $model->getById($intId);
            if( file_exists(PATH_UPLOADS.'images/patrocinadores/'.$pakal['patrocinador_logo']) ){
                unlink(PATH_UPLOADS.'images/patrocinadores/'.$pakal['patrocinador_logo']);
            }
            if( file_exists(PATH_UPLOADS.'images/patrocinadores/thumb_admin_'.$pakal['patrocinador_logo']) ){
                unlink(PATH_UPLOADS.'images/patrocinadores/thumb_admin_'.$pakal['patrocinador_logo']);
            }
        }
        /* si se subio una nueva foto agregarla y borrar las que habia para la foto de la ubicacion */
        $nuevaImagen2 = $this->uploadsImages('ubicacion_foto', $this->_uploadsUbicacion);
        if( $nuevaImagen2 && !empty($nuevaImagen2) ){
            $dataUpdate['ubicacion_foto'] = $nuevaImagen2;
            $pakal = $model->getById($intId);
            if( file_exists(PATH_UPLOADS.'images/ubicaciones/'.$pakal['patrocinador_logo']) ){
                unlink(PATH_UPLOADS.'images/ubicaciones/'.$pakal['patrocinador_logo']);
            }
            if( file_exists(PATH_UPLOADS.'images/ubicaciones/thumb_admin_'.$pakal['patrocinador_logo']) ){
                unlink(PATH_UPLOADS.'images/ubicaciones/thumb_admin_'.$pakal['patrocinador_logo']);
            }
        }
        
        if ( parent::getStatusForm() ){
           if ( $model->update($dataUpdate, $intId) ){
                Util::redirect(go('pakales','index','&update=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $_GET['update'] = 'false';
                $this->edit($intId);
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
        $model = new Model('pakales', 'pakal_id');
        if ( $model->delete($intId) ){
            Util::redirect(go('pakales','index','&delete=true'));
        } else {
            Util::redirect(go('pakales','index','&delete=false'));
        }
    }
    
    /**
     * @name uploadsImages
     * @description Sube las imagenes que se encuentren en el formulario al servidor
     */
    private function uploadsImages2($nombreCampo,$path){
        parent::getLoad()->load('lib.ServerImage');
        $serverImage = new ServerImage();
        $nombreImagen = '';
        
        try{
            $nombreImagen = $serverImage->upload('registro',$nombreCampo,$path);
           }catch(Exception $e){
               if($e->getCode() == 2 ){
                   return '';
               }
           }
           return $nombreImagen;
    }
    
    public function change()
    {
        $error = true;
        $arrParamURL = Param::getParamURL();
        $intId = $arrParamURL[0];
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $model = new Model('pakales', 'pakal_id');
        $record = $model->getById($intId);
        $data = array();
        if ( $record['sys_status'] == 'ACTIVO' ){
            $data = array('sys_status' => 'INACTIVO');
        } else {
            $data = array('sys_status' => 'ACTIVO');
        }
        if ($model->update($data, $intId)){
               $error = false;
           }else {
               Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
           } 
           
        if ( !$error ){
            Util::redirect(go($this->_name,'index','&update=true'));
        } else {
            $_GET['update']= false;
            $this->index();
        }
    }
    
    public function test(){
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('pakales/test');
    }
    
}

