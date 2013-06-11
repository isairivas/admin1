<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sliders
 *
 * @author isai
 */
class Sliders extends Scaffold {
    public function  __construct() {
        parent::setTableName('sliders');
        parent::setControllerName('sliders');
        parent::setColumnasMostradas(array('nombre','link','status'));
        parent::setPathUploads(PATH_IMAGES_SLIDERS);
        parent::__construct();
    }
}


