<?php

/**
 * Description of Gelatinas
 *
 * @author isai
 */
class Gelatinas extends Scaffold {
    public function  __construct() {
        parent::setTableName('gelatinas');
        parent::setControllerName('gelatinas');
        parent::setColumnasMostradas(array('nombre','precio','status'));
        parent::setPathUploads(PATH_IMAGES_GELATINAS);
        parent::__construct();
    }
}
