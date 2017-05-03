<?php
class HyperlinkController extends Yov_Controller
{
    function init(){
        parent::init();
    }

    public function addHyperlinkAction(){
        $array = ['Chinese', 'Chinese companies', 'United States', 'United States of America'];

        $text_string = 'Chinese是中国人的意思，Chinese companies是什么意思? Chinese 与 Chinese companies 是什么关系？Chinese companies不能代替Chinese. United States是美国，United States of America也是美国，但United States也不能代替United States of America';

        $this->bubbleSort($array);

        $withHyperlink = $this->doAddHyperlink($array, $text_string);

        echo $withHyperlink;
        return $withHyperlink;
    }

    public function doAddHyperlink($array, $string)
    {
        $hyperlinkArr = [];

        foreach ($array as $item) {
            $hyperlinkArr[] = "<a href='{$item}'>{$item}</a>";
        }

        foreach ($array as $item) {
            $string = $this->doAddHyperlinkBatch($string, $hyperlinkArr, $item);
        }

        return $string;
    }

    public function doAddHyperlinkBatch($string, $hyperlinkArr, $item){
        $stringTmp = [];

        foreach ($hyperlinkArr as $key_link => $item_link) {
            $stringArr = explode($item_link, $string);

            if(count($hyperlinkArr) > 1){
                unset($hyperlinkArr[$key_link]);
                foreach ($stringArr as $item_str) {
                    $stringTmp[] = $this->doAddHyperlinkBatch($item_str, $hyperlinkArr, $item);
                }
            }else{
                $hyperlink = "<a href='{$item}'>{$item}</a>";

                $stringArrTmp = [];
                foreach ($stringArr as $item_string) {
                    $stringArrTmp[] = str_replace($item, $hyperlink, $item_string);
                }
                return implode($item_link, $stringArrTmp);
            }

            return implode($item_link, $stringTmp);
        }

        return $stringTmp;
    }

    public function bubbleSort(&$arr){
        $flag = false;

        for($i = 0; $i < count($arr) - 1; $i++){
            for($j = 0; $j < count($arr) - 1 - $i; $j++){
                if(strlen($arr[$j]) < strlen($arr[$j + 1])){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $flag = true;
                }
            }

            if(!$flag){
                break;
            }

            $flag = false;
        }
    }
}