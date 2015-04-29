<?php
class TestController extends BaseController{
    function test(){
        $test = new User_UserInfoModel();
        $test = $test->getUserBaseInfoAll();
        var_dump($test);
    }
}