<?php

/**
 * Description of Field
 *
 * @author isai
 * 20/06/2011
 */
class Field {
    
    private $strName;
    private $strTypeDate;
    private $bolRequired;
    private $bolPrimaryKey;
    private $intTypeFilter;
    private $strTypeSql;
    private $arrOptions;

    function __construct($strName,$strType) {
        $this->strName = $strName;
        $this->strTypeDate = $strType;
        $this->processType();
        $this->castTypeFilter();
    }

    private function processType()
    {
        if (! Filter::evaluate(Filter::LETTERS, $this->strTypeDate) ){
            $arrPartes = explode('(',$this->strTypeDate);
            $this->strTypeSql = $this->strTypeDate;
            $this->strTypeDate = $arrPartes[0];
            //echo $this->strTypeDate;
        }
    }

    public function castTypeFilter() {
        switch($this->strTypeDate) {
            case 'text':
                $this->intTypeFilter = Filter::FULLTEXT;
                break;
            case 'date':
                $this->intTypeFilter = Filter::DATE_HUMAN;
                break;
            case 'enum':
                $this->proccessOptions();
                $this->intTypeFilter = Filter::STRING;
                break;
            case 'varchar':
                $this->intTypeFilter = Filter::STRING;
                break;
            case 'int':
                $this->intTypeFilter = Filter::INT;
                break;
            case 'bigint':
                $this->intTypeFilter = Filter::INT;
                break;
            case 'float':
                $this->intTypeFilter = Filter::FLOAT;
                break;
        }
        if($this->strName == 'id' ){
            $this->intTypeFilter = Filter::ID;
        }
        if ( $this->strName == 'email') {
            $this->intTypeFilter = Filter::EMAIL;
        }
    }


    public function getName() {
        return $this->strName;
    }

    public function setName($strName) {
        $this->strName = $strName;
    }

    public function getTypeDate() {
        return $this->strTypeDate;
    }

    public function setTypeDate($strTypeDate) {
        $this->strTypeDate = $strTypeDate;
    }
    public function setTypeFilter($intTypeFilter) {
        $this->intTypeFilter = $intTypeFilter;
    }
    public function getTypeFilter() {
        return $this->intTypeFilter;
    }

    public function getRequired() {
        return $this->bolRequired;
    }

    public function setRequired($bolRequired) {
        $this->bolRequired = $bolRequired;
    }

    public function isPrimaryKey()
    {
        return $this->bolPrimaryKey;
    }

    public function convertPrimaryKey()
    {
        $this->bolPrimaryKey = true;
    }

    public function removePrimaryKey()
    {
        $this->bolPrimaryKey  = false;
    }

    public function getOptions() {
        return $this->arrOptions;
    }

    public function proccessOptions(){
        $arrPartes = explode('(', $this->strTypeSql);
        $arrPartes = explode(')',$arrPartes[1]);
        $listado = $arrPartes[0];
        $arrOptions = explode(',',$listado);
        foreach($arrOptions as $key => $option){
           $arrOptions[$key] = str_replace('\'', '', $option);
        }
        $this->arrOptions = $arrOptions;
    }


}

