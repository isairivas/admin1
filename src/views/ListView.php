<?php


/**
 * Description of ListView
 * Abstraccion de la vista de listar 
 *
 * @author isai
 * 24/06/2011
 */
class ListView {

    private $arrToolBar;
    private $bolPaginate;
    private $arrFields;
    private $strControllerName;
    private $arrOrden;
    private $intElementosMostrados;
    private $arrColumns;
    private $arrRegistros;
    private $arrColumnsMostrados;
    private $strTitle;

    function __construct($strTitle = null,$strControllerName = null) {

        $this->arrFields = array();
        $this->arrOrden = array();
        $this->arrToolBar = array();
        $this->bolPaginate = false;
        $this->intElementosMostrados = 10;
        $this->strControllerName = null;
       
       
       if ( !is_null($strTitle) ){
           $this->strTitle = $strTitle;
       }
       if ( !is_null($strControllerName) ){
           $this->strControllerName = $strControllerName;
       }
        $this->defaultTools();
    }

    private function defaultTools()
    {
         $Tool_nuevo = new ToolButton();
         $Tool_nuevo->setNombre('Nuevo');
         $Tool_nuevo->setLabel('Nuevo');
         $Tool_nuevo->setIcon(HOME.'images/add.png');
         $Tool_nuevo->setLinkUrl(HOME.$this->strControllerName.'/nuevo');
         $this->arrToolBar[] = $Tool_nuevo;
    }
    private function defaultColumns()
    {
         $Column_eliminar = new Column();
         $Column_eliminar->setAction('delete');
         $Column_eliminar->setLabel('Eliminar');
         $Column_eliminar->setIcon(HOME.'images/delete.png');
         $Column_eliminar->setAlert('Esta seguro que desea eliminar este registro');
         $this->setColumn($Column_eliminar);
    }

    /**
     * elegir cuales son las columnas que se mostraran
     * @param <type> $strColumn string nombre de la columna a mostrar
     * @param <type> $arrColumns  array con nombres de las columnas
     */
    public function showColumn($strColumn=null,$arrColumns=null)
    {
        if ( !is_null($strColumn) && Filter::evaluate(Filter::LETTERS, $strColumn) ) {
            $this->arrColumnsMostrados[] = $strColumn;
        }
        if( !is_null($arrColumns) && is_array($arrColumns) ){
            foreach($arrColumns as $strColumn){
                $this->arrColumnsMostrados[] = $strColumn;
            }
        }
    }

    public function setColumn(Column $column)
    {
        if( !is_null($column) ){
            $this->arrColumns[] = $column;
        }
    }
    public function getColumnsShow()
    {
        return $this->arrColumnsMostrados;
    }
    public function getColumn()
    {
        return $this->arrColumns;
    }
    public function setControllerName($strControllerName)
    {
        $this->strControllerName = $strControllerName;
    }
    public function getControllerName()
    {
        return $this->strControllerName;
    }

    /**
     *  En este metodo se indica si va a estar paginado el listado o no
     * @param <boolean> $bolPaginate true or false
     * @param <int> $intElementosMostrados Numero de elementos a mostrar por cada pagina
     */
    public function setPaginate( $bolPaginate,$intElementosMostrados = 10 ){
       if( filter_var($bolPaginate, FILTER_VALIDATE_BOOLEAN)  ){
           $this->bolPaginate = $bolPaginate;
           if ( filter_var($intElementosMostrados,FILTER_VALIDATE_INT) ){
               $this->intElementosMostrados = $intElementosMostrados;
           } else { 
               Param::setSystemMessage("Error in \$intElementosMostrados: parametro invalido, solo enteros [ListView.php] ");
           }
       } else {
           Param::setSystemMessage("Error in \$bolPaginate: parametro invalido, solo true o false [ListView.php]");
       }
    }

    /**
     *
     * @param <type> $arrField arreglo con los field de el modelo
     */
    public function setFields($arrField )
    {
        
            $this->arrFields = $arrField;
        
    }
    public function getFields()
    {
        return $this->arrFields;
    }
    public function setRegistros($arrRegistros)
    {
       
            $this->arrRegistros = $arrRegistros;
        
    }
    public function getRegistros()
    {
        return $this->arrRegistros;
    }

    public function createColumns()
    {
        foreach ($this->getFields() as $objField){
            if( is_a($objField, 'Field') && in_array($objField->getName(), $this->arrColumnsMostrados) ){
                $objColumn = new Column($objField);
                $objColumn->setAction('edit');
                $this->arrColumns[] = $objColumn;
                unset($objColumn);
            }
        }
        $this->defaultColumns();
    }

    public function setTitle($strTitle)
    {
        $this->strTitle = $strTitle;
    }
    public function getTitle()
    {
        return $this->strTitle;
    }

    public function getTools()
    {
        return $this->arrToolBar;
    }

}

