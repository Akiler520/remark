// JavaScript Document

/**
 * get browser information of user
 */
var _ua = navigator.userAgent.toLowerCase();
var _tmp;
var Browser = {
    ie: (_tmp = _ua.match(/msie ([\d.]+)/)) ?  _tmp[1] : null,
    firefox: (_tmp = _ua.match(/firefox\/([\d.]+)/)) ? _tmp[1] : null,
    chrome: (_tmp = _ua.match(/chrome\/([\d.]+)/)) ? _tmp[1] : null,
    opera: (_tmp = _ua.match(/opera.([\d.]+)/)) ? _tmp[1] : null,
    safari: (_tmp = _ua.match(/version\/([\d.]+).*safari/)) ? _tmp[1] : null
};

/**
 * config, init system info.
 */
var Config = {
    filetypes: "doc|docx|pptx|xls|xlsx|gif|jpeg|jpg|pdf|png|ico|txt|rar|exe|zip|gz|accdb|psd|tif",
	swf_filetypes: "*.dwg;*.skp;*.3ds;*.pdf;*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.avi;*.jpg;*.png;*.gif;*.tif;*.txt;*.jnt;*.odg;*.odp;*.odt;*.ods",
	filename:  "*.conf",
	extensionDef: "null",
	framename: "mainFrame",
	host: "",
	rootPath: "",
	assetPath: "share/assets/",
	imgPath: "share/images/",
	cssPath: "share/css/",
	jsPath: "share/scripts/",
	uploadPath: "source/tmp/",
	convertPath: "source/convert/",
	cookieName: "yov_userinfo",
	defdata: "NULL",
    filesize: "150 MB",
    uploadlimit: 50,
	attachMax: 5,
	fileListMax: 300,
	abort: 0,		// 0=not abort the operate, 1=abort
	rotate_deg: []	// rotate_deg[id_file] = 90/180
};

Config.init = function()
{
    Config.rootPath = $("#_yovim_site_path").val();
    Config.jsPath = Config.rootPath+Config.jsPath;
    Config.cssPath = Config.rootPath+Config.cssPath;
    Config.imgPath = Config.rootPath+Config.imgPath;
    Config.uploadPath = Config.rootPath+Config.uploadPath;
    Config.assetPath = Config.rootPath+Config.assetPath;
    Config.convertPath = Config.rootPath+Config.convertPath;
};

var Common = {
};

Common.str2json = function(data){
    return eval("("+data+")");
};

Common.inArray = function(testArr, string)
{
	if((testArr instanceof Array) == false || string.length <= 0){
		return false;
	}

	var i = 0;
	var len = testArr.length;
	var in_array = false;
	string = string.toLowerCase();

	for(i = 0; i < len; i++){
		if(string == testArr[i].toLowerCase()){
			in_array = true;
			break;
		}
	}

	return in_array;
};

