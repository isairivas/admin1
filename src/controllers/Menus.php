<?php


/**
 * Description of Menus
 *
 * @author isai
 */
class Menus extends Scaffold {
    public function  __construct() {
        parent::setTableName('menus');
        parent::setControllerName('menus');
        parent::setColumnasMostradas(array('nombre','status'));
        parent::setPathUploads(PATH_IMAGES_MENUS);
        parent::__construct();
    }
}

