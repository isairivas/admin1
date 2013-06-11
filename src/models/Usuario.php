<?php

/**
 * Description of Usuario
 *
 * @author isai
 * create: 16/05/2011
 */
class Usuario extends Model {

    private $Proyect;
    private $objDataBase;
    private $_db_name = 'sys_administradores';

    public function  __construct()
    {
        parent::__construct($this->_db_name,'administrador_id');
        $this->Proyect = Proyect::getInstance();
        $this->objDataBase = DataBase::getInstance();
    }

    public function getUserWhitPassword($strUsuario,$strPassword)
    {
        $strQuery = ' SELECT * FROM '.$this->_db_name.' WHERE usuario = :usuario && password = :password LIMIT 0,1';
        $arrValues = array('usuario' => $strUsuario,'password' => $strPassword);

        $objResult = $this->objDataBase->queryPrepared($strQuery,$arrValues);
        if ( count($objResult) > 0 ){
            return $objResult[0];
        } else {
            return false;
        }
    }
}

