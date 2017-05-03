<?php
/**
 * Index Controller
 *
 * @author Martin
 */
class IndexController extends Yov_Controller{

    function init(){
        parent::init();
    }

    public function indexAction(){
        $this->display('index/index.tpl');
    }
}