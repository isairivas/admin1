<?php

/**
 * Description of Pasteles
 *
 * @author isai
 */
class Pasteles extends Scaffold {
    public function  __construct() {
        parent::setTableName('pasteles');
        parent::setControllerName('pasteles');
        parent::setColumnasMostradas(array('nombre','precio','status'));
        parent::setPathUploads(PATH_IMAGES_PASTELES);
        parent::__construct();
    }
}


