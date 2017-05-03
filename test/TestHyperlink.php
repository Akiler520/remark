<?php
class TestHyperlink extends PHPUnit_Framework_TestCase
{
    public function testAddHyperlink(){
        $array = ['Chinese', 'Chinese companies', 'United States', 'United States of America'];

        $text_string = 'Chinese是中国人的意思，Chinese companies是什么意思? Chinese 与 Chinese companies 是什么关系？Chinese companies不能代替Chinese. United States是美国，United States of America也是美国，但United States也不能代替United States of America';

        $hyperlinkObj = new Yov_Hyperlink();

        $hyperlinkObj->bubbleSort($array);

        $withHyperlink = $hyperlinkObj->doAddHyperlink($array, $text_string);

        echo $withHyperlink;
    }
}