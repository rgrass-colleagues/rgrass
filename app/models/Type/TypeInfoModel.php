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
    protected $type = 'blog_type';
    /*
     * 查询type表全部数据
     * */
    public function getTypeBaseInfoAll(){
        return DB::table($this->type)
            ->get();
    }
}