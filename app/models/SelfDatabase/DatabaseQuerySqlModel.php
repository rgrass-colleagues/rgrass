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
    private $screct = 'hr1ycfLqswslhK';
    /*
     * 直接执行sql语句,如果需要改库,需要输入更改的库名
     * */
    public function querySql($sql,$database=""){
        if(!empty($database)){
            $this->database=$database;
        }
        $this->sql = $sql;
        $dsn = "mysql:host=localhost;dbname=".$database;
        $dbLink=$this->connectDatabase($dsn);
        $rs = $dbLink->query($this->sql);
        if($rs){
            return true;
        }else {
            dd('数据库错误');
        }
    }
    public function querySqlSelect($sql,$database){
        $dsn = "mysql:host=localhost;dbname=".$database;
        $dbLink=$this->connectDatabase($dsn);
        $rs = $dbLink->query($sql);
        if($rs){
            $res = $rs->fetchAll(PDO::FETCH_ASSOC);
            if($res){
                return $res;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    private function connectDatabase($dsn){
        $dbLink = new PDO($dsn, 'root', $this->screct);
        if($dbLink){
            return $dbLink;
        }else{
            return '链接数据库失败';
        }


    }
}