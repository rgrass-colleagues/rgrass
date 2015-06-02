<?php
class TestController extends BaseController{
    function test(){
        $test = new Book_CreateBookContentModel();
        $test = $test->selectDatabaseByBookId('3213120');
        dd($test);
    }
}