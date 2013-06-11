<?php

/**
 * Description of Status
 *
 * @author isai
 */
class Status extends Scaffold {

   public function  __construct() {
        parent::setTableName('status');
        parent::setControllerName('status');
        parent::setColumnasMostradas(array('titulo'));
        parent::__construct();
    }
}

