<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pakal
 *
 * @author isai
 */
class Pakal extends Model {
    function __construct() {
        parent::__construct('pakales','pakal_id');
    }
    
    function getAll(){
        $strOrderBy = 'p.pakal_id';
        $strOrderMode = 'ASC';
        $strQuery = " SELECT * FROM pakales p "
                   
                  ."ORDER BY {$strOrderBy} {$strOrderMode} ";
        
        $db = DataBase::getInstance();
        $objResult = $db->query($strQuery);
        $resultado = parent::toArray($objResult);
        foreach($resultado as $key => $item){
            $resultado[$key]['imagenes'] = $this->getImagenes($item['pakal_id']);
        }
        return $resultado;
    }
    
    function getImagenes($pakalId){
        parent::setNameTable('pakal_imagenes');
        return parent::toArray(parent::getByColumn('pakal_id', $pakalId));
        parent::setNameTable('pakales');
    }
    
    function getPakal($id){
         if( !is_numeric($id) ){
         return false;
         }
        $strOrderBy = 'p.pakal_id';
        $strOrderMode = 'ASC';
        $strQuery = " SELECT * FROM pakales p WHERE p.pakal_id = {$id} " 
                  ."ORDER BY {$strOrderBy} {$strOrderMode} "
                  ."";
        
        $db = DataBase::getInstance();
        $objResult = $db->query($strQuery);
        $resultado = parent::toArray($objResult);
        foreach($resultado as $key => $item){
            $resultado[$key]['imagenes'] = $this->getImagenes($item['pakal_id']);
        }
        return $resultado[0];
    }
}

