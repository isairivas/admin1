<?php
/**
 * Description of Promociones
 *
 * @author isai
 */
class Promociones extends Scaffold {
    public function  __construct() {
        parent::setTableName('promociones');
        parent::setControllerName('promociones');
        parent::setColumnasMostradas(array('nombre','status'));
        parent::setPathUploads(PATH_IMAGES_PROMOCIONES);
        parent::__construct();
    }
}

