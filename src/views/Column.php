<?php

/**
 * Description of Column
 * Abstraccion de una columna en la vista automatizada de listar
 *
 * @author isai
 * 25/06/2011
 */

class Column {

    private $strIcon;
    private $strNombre;
    private $strLabel;
    private $strAction;
    private $strAlert;
    private $strLinkURL;
    private $Field;
    
    function __construct(Field $field=null) {
        if( !is_null($field) ){
            $this->Field = $field;
            $this->castFieldToColumn($field);
        }
    }

    public function getIcon() {
        return $this->strIcon;
    }

    public function setIcon($strIcon) {
        $this->strIcon = $strIcon;
    }

    public function getName() {
        return $this->strNombre;
    }

    public function setName($strNombre) {
        $this->strNombre = $strNombre;
    }

    public function getLabel() {
        return $this->strLabel;
    }

    public function setLabel($strLabel) {
        $this->strLabel = $strLabel;
    }

    public function getAction() {
        return $this->strAction;
    }

    public function setAction($strAction) {
        $this->strAction = $strAction;
    }

    public function getAlert() {
        return $this->strAlert;
    }

    public function setAlert($strAlert) {
        $this->strAlert = $strAlert;
    }

    public function getLinkURL() {
        return $this->strLinkURL;
    }

    public function setLinkURL($strLinkURL) {
        $this->strLinkURL = $strLinkURL;
    }

    
    public  function castFieldToColumn(Field $field)
    {
        $this->strNombre = $field->getName();
        $this->strLabel = $this->createLabel($field->getName());
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

