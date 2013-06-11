<?php

/**
 * Description of Model
 *
 * @author isai
 * created: 16/05/2011
 */
class Model {

    private $strNameTable;
    private $objDataBase;
    private $arrFields;
    public $_primary;

    public function  __construct($strNameTable,$primary = 'id') {

        $this->arrFields = array();
        $this->objDataBase = DataBase::getInstance();
        $this->setNameTable($strNameTable);
        $this->_primary = $primary;
    }

    public function setNameTable($strNameTable) {
        if( $this->objDataBase->existTable($strNameTable) ) {
            $this->strNameTable = $strNameTable;
            $this->extractFields();
            return true;
        } else {
            return false;
        }

    }

    public function get($strOrderBy=null,$strOrderMode='ASC') {
        if(is_null($strOrderBy)){
            $strOrderBy = $this->_primary;
        }
        if ( $strOrderMode != 'ASC' && $strOrderMode != 'DESC' ) {
            Param::setFormError('El Modo de ordenamiento es invalido');
            return false;
        }

        $strQuery = " SELECT * FROM {$this->strNameTable} ORDER BY {$strOrderBy} {$strOrderMode} ";
        $objResult = $this->objDataBase->query($strQuery);
        if ( $objResult ) {
            return $objResult;
        } else {
            Param::setFormError('Error a el obtener los registros de el modelo');
            return array();
        }
    }
    
    public function getByColumn($column,$value,$strOrderBy=null,$strOrderMode='ASC'){
        if(is_null($strOrderBy)){
            $strOrderBy = $this->_primary;
        }
        if ( $strOrderMode != 'ASC' && $strOrderMode != 'DESC' ) {
            Param::setFormError('El Modo de ordenamiento es invalido');
            return false;
        }
        $strQuery = " SELECT * FROM {$this->strNameTable} WHERE {$column} = '{$value}' ORDER BY {$strOrderBy} {$strOrderMode} ";
        $objResult = $this->objDataBase->query($strQuery);
        if ( $objResult ) {
            return $objResult;
        } else {
            Param::setFormError('Error a el obtener los registros de el modelo');
            return array();
        }
    }
    
    public function getByStatus($status='activo',$strOrderBy='id',$strOrderMode='ASC') {
        if ( $strOrderMode != 'ASC' && $strOrderMode != 'DESC' ) {
            Param::setFormError('El Modo de ordenamiento es invalido');
            return false;
        }

        $strQuery = " SELECT * FROM {$this->strNameTable} WHERE status = '{$status}' ORDER BY {$strOrderBy} {$strOrderMode} ";
        $objResult = $this->objDataBase->query($strQuery);
        if ( $objResult ) {
            return $objResult;
        } else {
            Param::setFormError('Error a el obtener los registros de el modelo');
            return array();
        }
    }

    public function set($arrRegister) {
        if ( $this->objDataBase->insertRow($this->strNameTable,$arrRegister) ) {
            return true;
        } else {
            return false;
        }  
    }
    public function update($arrRegister,$intId) {
        $this->objDataBase->updateRow($this->strNameTable,$intId,$arrRegister,$this->_primary);
        return true;
    }

    public function getById($intId) {

        if(!filter_var($intId,FILTER_VALIDATE_INT) ) {
            Param::setSystemError('intId no es entero');
            return false;
        }

        $strQuery = "SELECT * FROM {$this->strNameTable} WHERE {$this->_primary} = :id LIMIT 0,1; " ;
        $arrValues = array('id' => $intId );
        $arrResult = $this->objDataBase->queryPrepared($strQuery,$arrValues);
        return $arrResult[0];
    }

    public function delete($intId) {
        if(!filter_var($intId,FILTER_VALIDATE_INT) ) {
            Param::setSystemError('intId no es entero');
            return false;
        }
        if($this->objDataBase->deleteRow($this->strNameTable,$intId,$this->_primary)) {
            return true;
        } else {
            return false;
        }
    }

    private function extractFields()
    {
        $strQuery = "SHOW COLUMNS FROM {$this->strNameTable} ";
        $arrResult = $this->objDataBase->query($strQuery);

        $arrColumns = array();

        foreach($arrResult as $arrColumn){
            
            $field = new Field($arrColumn[0], $arrColumn[1]);
            
            if( $arrColumn[2] == 'YES' ){
                $field->setRequired(false);
            } else {
                $field->setRequired(true);
            }

            if ( $arrColumn[3] == 'PRI' ){
                $field->convertPrimaryKey();
            }

            $this->arrFields[] = $field;
            unset($field);

        }

    }

    public function getFields()
    {
        return $this->arrFields;
    }
    
    public function toArray($pdoObjects){
        $results = array();
        foreach($pdoObjects as $item){
            $results[] = $item;
        }
        return $results;
    }
    
    public function getAdapter(){
        return $this->objDataBase;
    }
}

