<?php
class Yov_WechatMaterial
{
    /**
     * app ID of wechat
     * @var string
     */
    private $_APP_ID = "";

    /**
     * app secret string of wechat
     * @var string
     */
    private $_APP_SECRET = "";

    /**
     * access token of wechat
     * @var string
     */
    private $_APP_ACCESS_TOKEN = "";

    /**
     * material types
     * @var array
     */
    private $_TYPE_SUPPORT = ["image", "voice", "video", "thumb"];

    /**
     * url of wechat to get access token
     */
    const WECHAT_ACCESS_TOKEN_URL = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=s%&secret=s%";

    /**
     * base url of wechat API
     */
    const WECHAT_URL_PREFIX = 'https://api.weixin.qq.com/cgi-bin';

    /**
     * uri to add material
     */
    const WECHAT_MATERIAL_UPLOAD_URL = '/material/add_material?';

    /**
     * uri to add news
     */
    const WECHAT_MATERIAL_NEWS_UPLOAD_URL = '/material/add_news?';

    /**
     * uri to update news
     */
    const WECHAT_MATERIAL_NEWS_UPDATE_URL = '/material/update_news?';

    /**
     * uri to get material
     */
    const WECHAT_MATERIAL_GET_URL = '/material/get_material?';

    /**
     * uri to upload image
     */
    const WECHAT_MATERIAL_IMAGE_UPLOAD_URL = '/media/uploadimg?';

    /**
     * uri to delete material
     */
    const WECHAT_MATERIAL_DEL_URL = '/material/del_material?';

    /**
     * uri to get count of material
     */
    const WECHAT_MATERIAL_COUNT_URL = '/material/get_materialcount?';

    /**
     * uri to get material by batch
     */
    const WECHAT_MATERIAL_BATCHGET_URL = '/material/batchget_material?';

    /**
     * set APP ID and Secret
     * @param $APP_ID
     * @param $APP_SECRET
     */
    public function setAPP($APP_ID, $APP_SECRET){
        $this->_APP_ID = $APP_ID;

        $this->_APP_SECRET = $APP_SECRET;
    }

    /**
     * get access token of wechat
     * @return string
     */
    public function getAccessToken(){
        // TODO: set cache = 7200s
        if(!$this->_APP_ACCESS_TOKEN){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->_APP_ID}&secret={$this->_APP_SECRET}";

            $res = json_decode(Yov_RemoteRequest::get($url));

            $this->_APP_ACCESS_TOKEN = $res->access_token;
        }

        return $this->_APP_ACCESS_TOKEN;
    }

    /**
     * upload material
     * @param $file_info
     * @param $type : image, voice, video, thumb
     * @return bool
     */
    function materialUpload($file_info,$type){
        if(empty($file_info) || !in_array($type, $this->_TYPE_SUPPORT)){
            return false;
        }

        $this->getAccessToken();

        $url = self::WECHAT_URL_PREFIX . self::WECHAT_MATERIAL_UPLOAD_URL . "access_token={$this->_APP_ACCESS_TOKEN}&type={$type}";

        $real_path = "{$file_info['filename']}";

        if (version_compare(PHP_VERSION, '5.6.0', '<')) {
            $fileObj = new CURLFile($real_path);
            $data = ["media" => $fileObj, 'form-data' => $file_info];   // php_version <= 5.5
        }else{
            $data = ["media" => "@{$real_path}", 'form-data' => $file_info];  // php_version>5.6
        }

        if($type == "video"){
            // special field for video only
            $description = [
                "title"         => isset($file_info['title']) ? $file_info['title'] : "",
                "introduction"  => isset($file_info['introduction']) ? $file_info['introduction'] : ""
            ];

            $data["description"] = json_encode($description);
        }

        $result = Yov_RemoteRequest::post($url, $data);

        if($result){
            $result = json_decode($result, true);

            return $result;
        }

        return false;
    }

    /**
     * add news
     * @param $data
     * @return bool|mixed
     */
    public function addNews($data){
        $this->getAccessToken();

        $url = self::WECHAT_URL_PREFIX . self::WECHAT_MATERIAL_NEWS_UPLOAD_URL . "access_token={$this->_APP_ACCESS_TOKEN}";

        $result = Yov_RemoteRequest::post($url, $data);

        if($result){
            $result = json_decode($result, true);
        }

        return $result;
    }

    /**
     * upload image
     * @param $file_info
     * @return bool|mixed
     */
    public function addImage($file_info){
        $this->getAccessToken();

        $url = self::WECHAT_URL_PREFIX . self::WECHAT_MATERIAL_IMAGE_UPLOAD_URL . "access_token={$this->_APP_ACCESS_TOKEN}";

        $real_path = "{$file_info['filename']}";

        $data = array("media" => "@{$real_path}", 'form-data' => $file_info);

        $result = Yov_RemoteRequest::post($url, $data);

        if($result){
            $result = json_decode($result, true);
        }

        return $result;
    }
}