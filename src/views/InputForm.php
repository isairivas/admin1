<?php

/**
 * Description of InputForm
 *
 * @author isai
 * 17/06/2011
 */
 /*
 */
class InputForm {

    const TYPE_TEXT = 1;
    const TYPE_TEXTAREA = 2;
    const TYPE_DATE = 3;
    const TYPE_DROPDOWN = 4;
    const  TYPE_HIDDEN = 5;
    const TYPE_FILE = 6;
    const TYPE_IMAGE = 7;
    
    private $intId;
    private $strLabel;
    private $strType;
    private $strName;
    private $strValue;
    private $strClassName;
    private $arrProperties;
    private $arrOptions;
    
    function __construct(Field $field=null) {
        $this->arrOptions = array();
        if ( !is_null($field) && is_object($field) ) {
            $this->castFieldToInputForm($field);
        }
    }

    public function getId() {
        return $this->intId;
    }

    public function setId($intId) {
        $this->intId = $intId;
    }

    public function getLabel() {
        return $this->strLabel;
    }

    public function setLabel($strLabel) {
        $this->strLabel = $strLabel;
    }

    public function getType() {
        return $this->strType;
    }

    public function setType($strType) {
        $this->strType = $strType;
    }

    public function getName() {
        return $this->strName;
    }

    public function setName($strName) {
        $this->strName = $strName;
    }

    public function getValue() {
        return $this->strValue;
    }

    public function setValue($strValue) {
        $this->strValue = $strValue;
    }

    public function getClassName() {
        return $this->strClassName;
    }

    public function setClassName($strClassName) {
        $this->strClassName = $strClassName;
    }

    public function getProperties() {
        return $this->arrProperties;
    }

    public function getOptions() {
        return $this->arrOptions;
    }

    public function setProperties($arrProperties) {
        $this->arrProperties = $arrProperties;
    }

    private function castFieldToInputForm(Field $field)
    {
        $this->strName = $field->getName();
        $this->strLabel = $this->createLabel($field->getName());
       
        switch($field->getTypeDate() ) {
            case 'text': $this->strType =self::TYPE_TEXTAREA; break;
            case 'int':  $this->strType = self::TYPE_TEXT; break;
            case 'bigint': $this->strType = self::TYPE_TEXT; break;
            case 'float':  $this->strType = self::TYPE_TEXT; break;
            case 'date': $this->strType = self::TYPE_DATE; break;
            case 'enum':  
                $this->strType = self::TYPE_DROPDOWN;
                foreach( $field->getOptions() as $strOption ){
                    $this->arrOptions[$strOption] = $this->createLabel($strOption);
                }
            break;
            case 'varchar': 
                $this->strType = self::TYPE_TEXT;
                $aPartes = explode('_',$this->strName);
                if ( count($aPartes) > 1 ){
                    if($aPartes[0] == 'imagen' ){
                        $this->strType = self::TYPE_IMAGE;
                    }
					if($aPartes[0] == 'file' ){
                        $this->strType = self::TYPE_FILE;
                    }
                }
                 
                break;
            default :
                echo 'Error al construir Formulario tipo de dato desconocido:'.$field->getTypeDate().'<br/>';
            break;
        }
        if($field->getName() == 'id' ){
            $this->strType = self::TYPE_HIDDEN;
        }
    }

    private function createLabel($strName){
        $strLabel = '';
        if ( strpos($strName,'_')  !== false){
            foreach(explode('_',$strName) as $strLetra){
                $strLabel .= ucfirst($strLetra).' ';
            }
        } else {
            $strLabel = ucfirst($strName);
        }

        return $strLabel;
    }


}
