<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-1-5
 * Time: 下午11:11
 */
class Type_TypeInfoModel extends Eloquent{
    /*
     * 设置连接表
     * */
    protected $type = 'book_type';
    /*
     * 查询type表全部数据
     * */
    public function getTypeBaseInfoAll(){
        return DB::table($this->type)
            ->get();
    }
    public function getTypeInfoById($type_id){
        return DB::table($this->type)
            ->where('type_id',$type_id)
            ->first();
    }
    /*
     * 把分类汇总查询
     * */
    public function getBookType(){
        //先查出所有parent为0的类别
        $baseType = DB::table($this->type)->where('parent_type',0)->get();
        foreach($baseType as $k=>$v){
            $baseType[$k]->son=DB::table($this->type)->where('parent_type',$k+1)->get();
        }
        return $baseType;
    }
    /*
     * 获取第一层的类型
     * */
    public function getBookFirstType(){
        return DB::table($this->type)->where('parent_type',0)->get();

    }
    /*
     * 插入一条类型
     * */
    public function insertNewBookType($content){
        return DB::table($this->type)
            ->insert($content);
    }
    /*
     * 删除一条类型
     * */
    public function delBookType($type_id){
        return DB::table($this->type)
            ->where('type_id',$type_id)
            ->delete();
        }
    public function modifyBookType($type_id,$content){
        return DB::table($this->type)
            ->where('type_id',$type_id)
            ->update($content);
    }

}