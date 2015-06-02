<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-6-1
 * Time: 11:01
 */
class SelfDatabase_DatabaseQuerySqlModel extends Eloquent{
    private $database="rgrass_main";
    private $sql=null;
    /*
     * 直接执行sql语句,如果需要改库,需要输入更改的库名
     * */
    public function querySql($sql,$database="",$select=false){
        if(!empty($database)){
            $this->database=$database;
        }
        $this->sql = $sql;
        $dsn = "mysql:host=localhost;dbname=".$database;
        $dbLink = new PDO($dsn, 'root', 'hr1ycfLqswslhK');
        $rs = $dbLink->query($this->sql);
        if($select){
            $res = $rs->fetchAll(PDO::FETCH_ASSOC);
            if($res){
                return $res;
            }
        }
        if($rs){
            return true;
        }else {
            dd('数据库错误');
        }
    }
    public function querySqlSelect($sql,$database){
        $dsn = "mysql:host=localhost;dbname=".$database;
        $dbLink = new PDO($dsn, 'root', 'hr1ycfLqswslhK');
        $rs = $dbLink->query($sql);
        $res = $rs->fetchAll(PDO::FETCH_ASSOC);
        if($res){
            return $res;
        }else{
            dd('数据库查询失败');
        }
    }
}