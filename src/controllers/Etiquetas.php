<?php


/**
 * Description of Etiquetas
 *
 * @author isai
 */
class Etiquetas extends Controller {
    
    private $_name = 'etiquetas';
    private $_table ='etiquetas';
    private $_uploads;
    private $_title = 'Etiquetas';
    
    function __construct() {
        parent::__construct();
        Param::setMenu('lenguaje');
        Param::setSubMenu('etiquetas');
        Param::setTitle('Etiquetas');
        $strAction = parent::getAction();
        if (method_exists($this, $strAction)) {
            $this->$strAction();
        } else {
            $this->index();
        }
    }
    
    public function index()
    {
       Param::navigate(array('Home' => 'index.php',$this->_title => go($this->_name)), 'icon-database');
       $filtroCategoria = isset($_GET['categoria'])&&is_numeric($_GET['categoria'])?$_GET['categoria']:'-1';
       $modelDB = new Model($this->_table);
       $records = array();
       if($filtroCategoria != -1){
           $records = $modelDB->toArray($modelDB->getByColumn('categoria_id', $filtroCategoria));
       } else {
           $records = $modelDB->toArray($modelDB->get());
       }
       
       $categoriasDB = new Model('etiquetas_categorias');
       $categorias = $categoriasDB->toArray($categoriasDB->get());
       foreach($records as $key => $value){
           foreach ($categorias as $cat){
               if($cat['id'] == $value['categoria_id'] ){
                   $records[$key]['nombre_categoria'] = $cat['nombre'];
               }
           }
       }
       $aData = array(
           'registros' => $records,
           '_name'      => $this->_name,
           'categorias' => $categorias,
           'filtroCategoria' => $filtroCategoria
       ); 
        
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView($this->_name.'/index',$aData);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function nuevo(){
        
        Param::navigate(array('Home' => 'index.php',$this->_name => go($this->_name),'Nuevo' => go($this->_name,'nuevo')), 'icon-database');
        Param::setTitle('Agregar nueva etiqueta');
        $categoriasDB = new Model('etiquetas_categorias');
        $categorias = $categoriasDB->toArray($categoriasDB->get());
        $aData = array('_name'  => $this->_name,'action' => go($this->_name,'agregar'),'categorias' => $categorias);
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView($this->_name.'/agregar',$aData);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function agregar(){
        $camposObligatorios = array('clave','sys_status','categoria_id');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['clave'] = parent::getPost('registro.clave', Filter::STRING, TRUE);
        $dataUpdate['categoria_id'] = parent::getPost('registro.categoria_id', Filter::INT, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['sys_created_at'] = date('Y-m-d H:i:s');
        $model = new Model($this->_table);
        if ( parent::getStatusForm() ){
           if ( $model->set($dataUpdate) ){
                Util::redirect(go($this->_name,'index','&add=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $_GET['add'] = 'false';
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
        $modelDB = new Model($this->_table,'id');
        $record = $modelDB->getById($intId);
        $categoriasDB = new Model('etiquetas_categorias');
        $categorias = $categoriasDB->toArray($categoriasDB->get());
        $arrConf = array(
            'action' => go($this->_name,'save'),
            'title'  => 'Editar',
            'registro' => $record,
            'categorias' => $categorias
        );
        Param::setTitle('Editar');
        
        Param::navigate(array('home' => HOME,'Etiquetas' => go($this->_name),'Editar' => ''), 'icon-cogs');
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView($this->_name.'/agregar',$arrConf);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function save(){
        $intId = parent::getPost('registro.id',Filter::ID,true);
        $camposObligatorios = array('clave','sys_status','categoria_id');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['clave'] = parent::getPost('registro.clave', Filter::STRING, TRUE);
        $dataUpdate['categoria_id'] = parent::getPost('registro.categoria_id', Filter::INT, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['sys_updated_at'] = date('Y-m-d H:i:s');
        $model = new Model($this->_table, 'id');
        
        if ( parent::getStatusForm() ){
           if ( $model->update($dataUpdate, $intId) ){
                Util::redirect(go($this->_name,'index','&update=true'));
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
        $model = new Model($this->_table, 'id');
        $record = $model->getById($intId);
        if( file_exists($this->_uploads.$record['imagen']) ){
            unlink($this->_uploads.$record['imagen']);
        }
        if( file_exists($this->_uploads.'thumb_admin_'.$record['imagen']) ){
            unlink($this->_uploads.'thumb_admin_'.$record['imagen']);
        }
        
        if ( $model->delete($intId) ){
            Util::redirect(go($this->_name,'index','&delete=true'));
        } else {
            Util::redirect(go($this->_name,'index','&delete=false'));
        }
    }
   
}


