<?php
define('DS', 					DIRECTORY_SEPARATOR);
define('PS', 					PATH_SEPARATOR);

define('DEBUG',					true);
define("IS_TEST",				true);

if(IS_TEST === false || PHP_OS == 'Linux'){
    define('WEB_PATH',				'/');      // ** set null when publish, or error will happen
    define('SITE_PATH',				'');      // ** set null when publish, or error will happen
}else{
    define('WEB_PATH',				'/');      // ** set null when publish, or error will happen
    define('SITE_PATH',				'/');      // ** set null when publish, or error will happen
}

define('BASE_PATH', 			dirname(dirname(__FILE__)).'\\');		// for windows only

define('ROOT_PATH',				$_SERVER['DOCUMENT_ROOT'].WEB_PATH);		// for linux or windows

define('TMP_PATH',				ROOT_PATH.'tmp/');

define('EMAIL_ERR_LOCK',		ROOT_PATH.'email_err_lock');

define('UPLOAD_PATH',			ROOT_PATH.'source/');
define('UPLOAD_PATH_TMP',		ROOT_PATH.'source/tmp/');

define('UPLOAD_MAX_SIZE',		10*1024*1024);			// 10M, can be edit in file '.htaccess'

define('LIB_PATH',				ROOT_PATH.'lib/');
define('CONFIG_PATH',			ROOT_PATH.'config/');
define('SMARTY_PATH',			LIB_PATH.'Smarty/');
define('EMAIL_PATH',			LIB_PATH.'Mailer/');
define('YOV_PATH',			    LIB_PATH.'Yov/');

define('PLUGIN_PATH',			ROOT_PATH.'plugin/');
define('CONTROLLER_PATH',	    ROOT_PATH.'controller/');
define('SOURCE_PATH',		    ROOT_PATH.'source/');
define('LOG_FILE',				TMP_PATH.'info.log');

define('PAGE_SIZE',             20);    // page size of each list

/******* response code for AJAX of client request: status_code *****/
define("RESPONSE_SUCCESS",              1);  // return success
define("RESPONSE_ERROR",                0);  // return error
define("RESPONSE_NOT_LOGIN",            -1);  // not login
define("RESPONSE_FILE_EXIST",           10);    // the file is exist
define("RESPONSE_NOT_FOUND",            404);   // page not found

define("WECHAT_APP_ID",         "wx39fef4087e722be1");
define("WECHAT_APP_SECRET",     "2c58ea2d33e0d43d9bf3d6346afcb1f9");
