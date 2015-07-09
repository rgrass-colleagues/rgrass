


<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 15-4-3
 * Time: 00:08
 */
class ViewSpalls_BookViewSpallsModel extends Eloquent{
    /*
 * 对目录数组进行拼接排列
 * */
    static public function showHomeBookCatalog($catalog,$book_id,$page=false){
        /*
         * 需要对表格对照$catalog的内容进行拼接
         * 有点难度,需要认真浏览
        */
        $page=$page?$page:3;//一行几章
        $html = "<tr>";
        foreach($catalog as $key=>$val){
                $organization_name = Book_BookNewInfoModel::getChapterOrganizationInfoByOid($val[0]->chapter_organization)->organization_name;
            $i=1;
            $html .='<tr><td style="text-align:left;width:100%;font-size:18px;" colspan="'.$page.'"><span>'.$organization_name.'</span></td></tr>';
            if(isset($val[0]->null_chapter)){
                continue;
            }
            foreach($val as $k=>$v){
                if((($i)%$page)!=0){
                    $html .= "<td><a href=\"/ChapterContent?book_id={$book_id}&&chapter_id={$v->id}\" class=\"js_input\">{$v->chapter_name}</a></td>";
                }else{
                    $html .= "<td><a href=\"/ChapterContent?book_id={$book_id}&&chapter_id={$v->id}\" class=\"js_input\">{$v->chapter_name}</a></td></tr><tr>";
                }
                $i++;
            }
            $html .="</tr>";
        }
            return $html;
    }






    static public function getPreNextList($catalog){
        //把id按顺序排列好
        foreach($catalog as $val){
            if(isset($val[0]->null_chapter)){
                continue;
            }
            foreach($val as $v){
            $arr[] = $v->id;
            }
        }

        $c_arr = count($arr)-1;//计算key的最大值
        foreach($arr as $kpn=>$vpn){
            if($kpn==0){//代表第一个
                $p_id_arr[] = 'none';
            }else{
                $p_id_arr[] = $arr[$kpn-1];
            }
            if($kpn==$c_arr){//代表最后一个
                $n_id_arr[] = 'none';
            }else{
                $n_id_arr[] = $arr[$kpn+1];
            }
        }
        $pre_arr = implode(',',$p_id_arr);
        $next_arr = implode(',',$n_id_arr);
        $res = array($pre_arr,$next_arr);
        return $res;
    }


    public function notuse(){
//                if($key==0){//$catalog[0]的时候
//                    if($k==0){//p:0=>none,n:0=>1   ---- $catalog[0][0]
//                        if(isset($catalog[0][0]->id)){
//                            $p_id = $catalog[0][0]->id;//上一页
//                        }else{
//                            $p_id = '错误1';
//                        }
//                        echo $k.'---',$p_id.'###';
//                    }else{
//                        if(isset($catalog[0][$k-1]->id)){
//                            $p_id = $catalog[0][$k-1]->id;
//                        }else{
//                            $p_id='错误2';
//                        }
//                        echo $k.'---',$p_id.'###';
//                    }
//                    if($k+1>count($catalog[0])-1){//下一页
//                        if(isset($catalog[1][0]->id)){
//                            $n_id = $catalog[1][0]->id;
//                        }else{
//                            $n_id = '错误3';
//                        }
//                        echo $k.'---',$n_id.'<br>';
//                    }else{
//                        if(isset($catalog[0][$k+1]->id)){
//                            $n_id = $catalog[0][$k+1]->id;
//                        }else{
//                            $n_id='错误4';
//                        }
//                        echo $k.'---',$n_id.'<br>';
//                    }
//                }else{
//                    if($k==0){//N,0,上一页
//                        $counts = count($catalog[$key-1]);
//                        if(isset($catalog[$key-1][$counts-1]->id)){
//                            $p_id = $catalog[$key-1][$counts-1]->id;
//                        }else{
//                            $p_id = '错误11';
//                        }
//                        echo $k.'---',$p_id.'###';
//                    }else{
//                        if(isset($catalog[$key][$k-1]->id)){
//                            $p_id = $catalog[$key][$k-1]->id;
//                        }else{
//                            $p_id = '错误22';
//                        }
//                        echo $k.'---',$p_id.'###';
//                    }
//                    if($k+1>count($catalog[$key])){//下一页
//                        echo $k+1;
//                        echo count($catalog[$key]);
//                        if(isset($catalog[$key][$k+1]->id)){
//                            $n_id = $catalog[$key][$k+1]->id;
//                        }else{
//                            $n_id = '错误33';
//                        }
//                        echo $k.'---',$n_id.'<br>';
//                    }else{
//                        if(isset($catalog[$key][$k+1]->id)){
//                            $n_id=$catalog[$key][$k+1]->id;
//                        }else{
//                            if(isset($catalog[$key+1][0]->id)){
//                                $n_id = $catalog[$key+1][0]->id;
//                            }else{
//                                $n_id = '没有下一页';
//                            }
//                        }
//                    }
//                    echo $k.'---',$n_id.'<br>';
//                }

    }
}



