<?php
/**
 * material Controller
 *
 * @author Martin
 */
class MaterialController extends Yov_Controller
{
    function init(){
        parent::init();
    }

    function indexAction(){
        $this->display('material/index.tpl');
    }

    public function addImageAction(){
        $uploadObj = new Ak_Upload($_FILES['fileBarSnapshot']);

        $imagePath = '';

        if ($uploadObj->getError() == 0) {
            $upfileInfo = $uploadObj->getUpFileInfo();

            $uploadObj->setSavePath(UPLOAD_PATH_TMP);
            $uploadObj->setFileNameRand(1);
            $uploadObj->setSaveFileNamePrefix();

            $uploadObj->uploadAll();

            $ret = $uploadObj->getResult();

            // create thumbnail
//            Source::getInstance()->createThumb(UPLOAD_PATH_TMP.$ret['save_name'][0], UPLOAD_PATH_TMP.THUMB_KEY.$ret['save_name'][0]);

            $imagePath = $ret['save_path'] . $ret['save_name'][0];
        }else{
            Ak_Message::getInstance()->add('Error happened')->output(0);
        }

        $wechatMaterialObj = new Yov_WechatMaterial();

        $wechatMaterialObj->setAPP(WECHAT_APP_ID, WECHAT_APP_SECRET);

        $size = filesize($imagePath);

        $fileInfo = [
            'filename' => $imagePath,
            'content-type' => 'image/jpg', //文件类型
            'filelength' => $size
        ];

        $mediaInfo = $wechatMaterialObj->materialUpload($fileInfo, "image");

        if($mediaInfo){
            $this->jsonReturn(RESPONSE_SUCCESS, "success", $mediaInfo);
        }else{
            $this->jsonReturn(RESPONSE_ERROR, "error happened");
        }
    }

    public function uniqueCheckAction(){
        $hashCode = $this->request['hash'];
        $uniqType = $this->request['type'];

        // TODO: unique check
        $info = [];
        $ret = array(
            "count" => empty($info) ? 0 : 1,
            "data"  => $info
        );;

        Ak_Message::getInstance()->add('ok', $ret)->output(RESPONSE_SUCCESS);
    }

}