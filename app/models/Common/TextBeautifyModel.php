<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-10
 * Time: 11:21
 */
class Common_TextBeautifyModel extends Eloquent{
    /*
     *
     * */
    public function addPInText($text){
        $str=trim($text); // 取得字串同时去掉头尾空格和空回车
        //$str=str_replace("<br>","",$str); // 去掉<br>标签
        $str="<p>".trim($str); // 在文本头加入<p>
        $str=str_replace("\r\n","</p>\n<p>",$str); // 用p标签取代换行符
        $str.="</p>\n"; // 文本尾加入</p>
        $str=str_replace("<p></p>","",$str); // 去除空段落
        $str=str_replace("\n","",$str); // 去掉空行并连成一行
        $str=str_replace("</p>","</p>\n",$str); //整理html代码
        return $str;
    }
    static public function addNewPInText($text){
        $str=trim($text); // 取得字串同时去掉头尾空格和空回车
        //$str=str_replace("<br>","",$str); // 去掉<br>标签
        $str="<p>".trim($str); // 在文本头加入<p>
        $str=str_replace("\r\n","</p>\n<p>",$str); // 用p标签取代换行符
        $str.="</p>\n"; // 文本尾加入</p>
        $str=str_replace("<p></p>","",$str); // 去除空段落
        $str=str_replace("\n","",$str); // 去掉空行并连成一行
        $str=str_replace("</p>","</p>\n",$str); //整理html代码
        return $str;
    }
}