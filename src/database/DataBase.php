<?php

/**
 * Name: DataBase.php
 * description: clase con metodos y funciones para acceder a la base de datos
 *
 * author: uriel isai rodriguez rivas
 * contact: isairivas@gmail.com
 *
 * created at :12/05/2011
 * updated at : 15/05/2011
 */
class DataBase  {

    private $pdoConnection = null;
    private $bolStatusConnection = false;
    private static $objInstance ;
    
    private function  __construct()
    {
        $this->connect();
    }
    public static function getInstance()
    {
        if(  is_null(self::$objInstance) ){
            $strClassName = __CLASS__;
            self::$objInstance = new $strClassName;
        }
        return self::$objInstance;
    }
    public function  __clone() {
        throw new Exception("No se tiene permitido clonar esta clase");
    }
    public function getConnect()
    {
        if ( $this->bolStatusConnection ){
            return $this->pdoConnection;
        } else {
            if(class_exists('Param') ){
                echo ' No se ha establecido una conexion exitosa a la base de datos';
               //Param::setSystemError('No se ha establecido una conexion exitosa a la base de datos'); 
            } else {
                echo 'No se ha establecido una conexion exitosa a la base de datos';
            }
            
            return false;
        }
    }

    public function setConnect(PDO $PDO)
    {
        if (is_subclass_of($PDO, 'PDO') ){
            $this->pdoConnection = $PDO;
            $this->bolStatusConnection = true;
        }
    }

    private function connect()
    {
        $arrDB = Config::getDateDB();
        if (!is_array($arrDB) ) {
            return false;
        }
        try{
            $this->pdoConnection = new PDO("{$arrDB['sgdb']}:host={$arrDB['server']};dbname={$arrDB['name']};", $arrDB['user'], $arrDB['password']);
            $this->bolStatusConnection = true;
        } catch(PDOException $pdoe){ 
            Param::setSystemError("Error al realizar la conexion, Mensaje de error[{$pdoe->getMessage()}]");
            $this->bolStatusConnection = false;
        }
    }

    public function queryPrepared($strQueryPrepared,$arrValues)
    {
        $pdoConexion = $this->getConnect();
        $objPrepare = $pdoConexion->prepare($strQueryPrepared);
        foreach( $arrValues as $key => $value ){
            $objPrepare->bindValue(':'.$key, $value);
        }
        $objPrepare->execute();
        return $objPrepare->fetchAll();
    }
    public function getPrepared($strQueryPrepared)
    {
        $pdoConexion = $this->getConnect();
        return $pdoConexion->prepare($strQueryPrepared);
    }
    public function executePrepared($pdoPrepared)
    {
        $pdoPrepared->execute();
        return $pdoPrepared->fetchAll();
    }

    public function query($strQuery)
    {
       $pdoConexion = $this->getConnect();
       $objResultSet = $pdoConexion->query($strQuery);
       if($objResultSet){
           return $objResultSet;
       } else {
           $arrInfoError = $pdoConexion->errorInfo();
           $strError = "Error en consulta [ {$strQuery} ] Informacion del error: [{$arrInfoError[2]}] ( DataBase Line 84 ) ";
           if(class_exists('Param'))
              Param::setSystemError($strError);
           else
               echo $strError;
           return false;
       }
    }

    public function getRowsTable($strNameTable)
    {
        $strQuery = " SELECT * FROM {$strNameTable} ";
        $objResult = $this->query($strQuery);
        if ( $objResult ){
            return $objResult;
        } else {
            Param::setSystemError("Error al obtener las filas de la tabla [{$strNameTable}] ( DataBase Line 96) ");
            return false;
        }
    }

    public function exec($strQuery)
    {
        $pdoConexion = $this->getConnect();
        if ( ! $pdoConexion ){
            return false;
        }
        $objResult = $pdoConexion->exec($strQuery);
        if ( $objResult ){
            return $objResult;
        } else {
            $arrInfoError = $pdoConexion->errorInfo();
            Param::setSystemError("Error a el realizar la consulta [{$strQuery}] detalle del error [{$arrInfoError[2]}] ");
        }
    }

    public function insertRow($strTableName,$registro)
    {
        $query = " INSERT INTO {$strTableName} ( ";
        $countReg = 0;
        foreach ($registro as $key => $reg ){
            if ($countReg==0){
                $query.= " {$key} ";
            } else {
                $query.= " ,{$key} ";
            }
            $countReg++;
        }
        $query .= ' ) VALUES ( ';
        $countReg = 0;
        foreach ($registro as $key => $reg ){
            if ($countReg==0){
                $query.= " '{$reg}' ";
            } else {
                $query.= " ,'{$reg}' ";
            }
            $countReg++;
        }
        $query .= ' ); ';

        if ( $this->exec($query) ){
            return true;
        } else {
            Param::setSystemError("Error al insertar en la tabla [{$strTableName}] ");
            return false;
        }
    }

    public function updateRows($tableName,$condition,$data)
    {
        $query = " UPDATE {$tableName} SET ";
        $countReg = 0;
        foreach ($datos as $key => $dato ){
            if ($countReg==0){
                $query.= " {$key} = '{$dato}' ";
            } else {
                $query.= " , {$key} = '{$dato}' ";
            }
            $countReg++;
        }
        $query.= " WHERE 1 = 1 {$condition} ; ";
        if ( $this->exec($query) ){
            return true;
        } else {
            return false;
        }
    }
    public function updateRow($tableName,$id,$datos,$nameColumn)
    {
        $query = " UPDATE {$tableName} SET ";
        $countReg = 0;
        foreach ($datos as $key => $dato ){
            if ($countReg==0){
                $query.= " {$key} = '{$dato}' ";
            } else {
                $query.= " , {$key} = '{$dato}' ";
            }
            $countReg++;
        }
        $query.= " WHERE {$nameColumn} = {$id} ; ";
        if ( $this->exec($query) ){
            return true;
        } else {
            return false;
        }
    }

    public function deleteRow($strTableName,$intId,$column = 'id')
    {
        $strQuery = " DELETE FROM {$strTableName} WHERE {$column} = {$intId} ";
        if ( $this->exec($strQuery) ){
            return true;
        } else {
            return false;
        }
    }

    public function getNameTables()
    {
        
    }

    public function existTable($strTableName)
    {
        return true;
    }

}
