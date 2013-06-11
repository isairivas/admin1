<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author isai
 * 19/06/2011
 */
class Form {
    
    private $strAction;
    private $strMethod;
    private $arrInputs;
    private $strTextInputSubmit;
    private $arrFields;
    private $arrInputNotVisible;
    private $arrIds;
    private $strPrefix;
    private $intPositionId;
    private $strName;
    private $arrRegistro;

    function __construct($strName=null,$strAction=null,$strMethod=null,$arrFields=null) {

        $this->arrInputNotVisible = array('created_by','created_at','updated_at','updated_by');
        $this->arrIds = array();
        $this->strPrefix = Util::randomChars(5);
        $this->intPositionId = 10;
        $this->strTextInputSubmit = 'Guardar';
        if( !is_null($strAction) ){
            $this->strAction = $strAction;
        }
        if( !is_null($strMethod) ){
            $this->strMethod = $strMethod;
        }
        if ( ! is_null($strName) ){
            $this->strName = $strName;
        }
        if ( !is_null($arrFields)  && is_array($arrFields)) {
            $this->arrFields = $arrFields;
            $this->createInputForms();
        }
        
    }

    public function setRegistro($arrRegistro)
    {
        $this->arrRegistro = $arrRegistro;
    }
    public function getAction() {
        return $this->strAction;
    }

    public function setAction($strAction) {
        $this->strAction = $strAction;
    }

    public function getMethod() {
        return $this->strMethod;
    }

    public function setMethod($strMethod) {
        $this->strMethod = $strMethod;
    }

    public function getInputs() {
        return $this->arrInputs;
    }

    public function setInputs($arrInputs) {
        $this->arrInputs = $arrInputs;
    }
    public function setName($strName)
    {
        $this->strName = $strName;
    }
    public function getName()
    {
        return $this->strName;
    }

    public function getTextInputSubmit() {
        return $this->strTextInputSubmit;
    }

    public function setTextInputSubmit($strTextInputSubmit) {
        $this->strTextInputSubmit = $strTextInputSubmit;
    }

    public function setFields($arrFields)
    {
        $this->arrFields = $arrFields;
    }

    public function getFields()
    {
        return $this->arrFields;
    }

    public function createInputForms()
    {
        if( is_array($this->arrFields)  ){
            
            $this->arrInputs = array();
           
            foreach($this->arrFields as $field ){ 
                if ( is_object($field) && !in_array($field->getName() , $this->arrInputNotVisible)  ){
                    $objInputForm = new InputForm($field);
                    $objInputForm->setId($this->nextId());
                    if ( !is_null($this->arrRegistro) && !empty($this->arrRegistro[$field->getName()]) ){
                        $objInputForm->setValue($this->arrRegistro[$field->getName()]);
                    }
                 //   echo $objInputForm->getName().'<br/>';
                    $this->arrInputs[] = $objInputForm;
                    unset($objInputForm);
                }
            }
        }
    }
    public function nextId()
    {
        $strId =$this->strPrefix.'_'.$this->intPositionId;
        $this->intPositionId++;
        return $strId;
    }
    public function setInputNotVisible($strNameField =null,$arrNameField=null)
    {
        if (!is_null($strNameField) ){
            $this->arrInputNotVisible [] = $strNameField;
        }
        if ( !is_null($arrNameField) && is_array($arrNameField) ){
            foreach($arrNameField as $strNameField){
                $this->arrInputNotVisible[] = $strNameField;
            }
        }
        
    }


}

