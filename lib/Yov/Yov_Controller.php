<?php
/**
 * Main Controller of Yovim
 *
 * @copyright Copyright (C) 2014 Yovim
 *
 * @author Martin
 */
class Yov_Controller{
    /**
     * the request from client
     *
     * @var null
     */
    public $request = null;

    /**
     * the object of view
     * @var null|object|Smarty
     */
    public $view = null;

    /**
     * to filter the data by setting of client
     * @var array
     */
    public $filter = array();

    function __construct(){
        /**
         * if file is larger than UPLOAD_MAX_SIZE, the form from client will be null, so do below.
         */
        $contentLen = $_SERVER['CONTENT_LENGTH'];
        $contentType = substr($_SERVER['CONTENT_TYPE'], 0, stripos($_SERVER['CONTENT_TYPE'], ';'));

        if ($contentType == 'multipart/form-data' && $contentLen > UPLOAD_MAX_SIZE) {
            Ak_Message::getInstance()->add('Maybe the file is too large, Max is: '.(UPLOAD_MAX_SIZE/1024/1024).'M.')->output(0);
        }

        $this->request = Yov_Router::getInstance()->getRequest();

        $this->view = Yov_init::getInstance()->view;

        $this->init();
    }

    public function init(){
        // controller => action, which need login access
    }

    /**
     * display the common view page
     *
     * @param $tplFile  : the template page
     * @param string $framework : the container of the page
     */
    protected function display($tplFile, $framework ='framework.tpl')
    {
        if ($framework == false) {
            $this->view->display($tplFile);
        } else {
            $this->view->assign('tplfile', $tplFile);
            $this->view->display($framework);
        }
    }

    /**
     * display only a single page, not framework
     *
     * @param $tplFile  : the template page
     */
    protected function displaySingle($tplFile)
    {
        $this->view->display($tplFile);
    }

    /**
     * display the source page
     *
     * @param $tplFile
     */
    protected function displaySource($tplFile)
    {
        //the source path is not the same one with the view path, so we need the change it before display
        $this->view->template_dir = SOURCE_PATH;

        $this->view->display($tplFile);
    }

    public function jsonReturn($status, $message, $data = []){
        $result = [
            'status'    => $status,
            'msg'   => $message,
            'data'      => $data
        ];

        echo json_encode($result);

        exit;
    }
}