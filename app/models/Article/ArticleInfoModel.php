<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-12-28
 * Time: 上午11:24
 */
class Article_ArticleInfoModel extends Eloquent{
    /*
     * 设置连接表
     * */
    protected $article = 'blog_article';
    /*
     * 查询users表全部数据
     * */
    public function getArticleBaseInfoAll(){
        return DB::table($this->article)
            ->get();
    }
    /*
     * 根据ID查询users一条用户信息
     * */
    public function getArticleBaseInfoById($id){
        return DB::table($this->article)
            ->where('article_id',$id)
            ->first();
    }
    /*
     * 添加新文章
     */
    public function insertNewArticle($title,$type,$content,$id){
        if(is_null($id)){
        return DB::table($this->article)
            ->insert(array(
                'article_title'=>$title,
                'article_type'=>$type,
                'article_content'=>$content
            ));
        }else{
            return DB::table($this->article)
                ->where('article_id',$id)
                ->update(array(
                    'article_title'=>$title,
                    'article_type'=>$type,
                    'article_content'=>$content
                ));
        }
    }

}