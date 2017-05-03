<?php
class Yov_Hyperlink
{
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