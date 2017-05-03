<?php

class TestMaterial extends PHPUnit_Framework_TestCase
{
    public function testAddMaterialImage(){
        $wechatMaterialObj = new Yov_WechatMaterial();

        $wechatMaterialObj->setAPP(WECHAT_APP_ID, WECHAT_APP_SECRET);

        $imagePath = "/source/tmp/test.jpg";
        $size = filesize($imagePath);

        $fileInfo = [
            'filename' => $imagePath,
            'content-type' => 'image/jpg', //文件类型
            'filelength' => $size
        ];

        $mediaInfo = $wechatMaterialObj->materialUpload($fileInfo, "image");

        var_dump($mediaInfo);
    }
}