<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tips
 *
 * @author isai
 */
class Tips extends Scaffold {
    public function  __construct() {
        parent::setTableName('tips');
        parent::setControllerName('tips');
        parent::setColumnasMostradas(array('nombre','status'));
        parent::setPathUploads(PATH_IMAGES_TIPS);
        parent::__construct();
    }
}

