<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-4-3
 * Time: 00:08
 */
class Common_FileUploadsModel extends Eloquent{
    public function FileUpload($file_name,$tofile){
        //判断是否经过了图片上传
        if($_FILES[$file_name]['name']==""){
            return false;
        }
        //判断是否通过post上传
        if(!is_uploaded_file($_FILES[$file_name]['tmp_name'])){
            echo '非法';
        }
        $tmp_file = $_FILES[$file_name]['tmp_name'];
        $file_name = explode('.',$_FILES[$file_name]['name']);
        $fileNames = md5($file_name[0].time());
        $fileNames = $fileNames.'.'.$file_name[1];
        $upload_file = "./uploads/".$tofile."/".$fileNames;
        //把文件从临时文件夹中拖出,拖到对应的文件夹里面
        if(!move_uploaded_file($tmp_file,$upload_file)){
            dd("error");
        }
        return $fileNames;
    }


    static public function BookUpload(){
        //判断是否经过了图片上传
        if($_FILES['book']['name']==""){
            return false;
        }
        //判断是否通过post上传
        if(!is_uploaded_file($_FILES['book']['tmp_name'])){
            echo '非法';
        }
        $tmp_file = $_FILES['book']['tmp_name'];
        $upload_file = "./BookWhole/".$_FILES['book']['name'];
        if(file_exists($upload_file)){
            dd('该文件已经存在');
        }
        if(!move_uploaded_file($tmp_file,$upload_file)){
            dd("error");
        }else{
            return true;
        }
    }
    static public function NewFileUploads($file_name,$tofile){
        //判断是否经过了图片上传
        if($_FILES[$file_name]['name']==""){
            return false;
        }
        //判断是否通过post上传
        if(!is_uploaded_file($_FILES[$file_name]['tmp_name'])){
            echo '非法';
        }
        $tmp_file = $_FILES[$file_name]['tmp_name'];
        $file_name = explode('.',$_FILES[$file_name]['name']);
        $fileNames = md5($file_name[0].time());
        $fileNames = $fileNames.'.'.$file_name[1];
        $upload_file = "./uploads/".$tofile."/".$fileNames;
        //把文件从临时文件夹中拖出,拖到对应的文件夹里面
        if(!move_uploaded_file($tmp_file,$upload_file)){
            dd("error");
        }
        return $fileNames;
    }
}