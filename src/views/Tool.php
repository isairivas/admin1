<?php


/**
 * Description of Tool
 * Abstraccion de una accion de la barra de tareas ( nuevo, search, back. etc )
 *
 * @author isai
 * 25/06/2011
 */
abstract class Tool {

    private $str_label;
    private $str_nombre;
    private $str_type;
    private $str_icon;
    private $str_linkUrl;
    
    function __construct() {
    }

    abstract  function generate();

public function getLabel() {
    return $this->str_label;
}

public function setLabel($str_label) {
    $this->str_label = $str_label;
}

public function getNombre() {
    return $this->str_nombre;
}

public function setNombre($str_nombre) {
    $this->str_nombre = $str_nombre;
}

public function getType() {
    return $this->str_type;
}

public function setType($str_type) {
    $this->str_type = $str_type;
}

public function getIcon() {
    return $this->str_icon;
}

public function setIcon($str_icon) {
    $this->str_icon = $str_icon;
}

public function getLinkUrl() {
    return $this->str_linkUrl;
}

public function setLinkUrl($str_linkUrl) {
    $this->str_linkUrl = $str_linkUrl;
}



}

