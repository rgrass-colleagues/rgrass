


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
        $organization = new Book_BookInfoModel();
        $page=$page?$page:3;
        $html = "<tr>";
        foreach($catalog as $key=>$val){
            $organization_name = ($organization_info = $organization->getChapterOrganizationInfoByOid($catalog[$key][0]->chapter_organization))?$organization_info->organization_name:'正文';//通过卷id号获取卷名
            $i=1;
            $html .='<tr><td style="text-align:left;width:100%;font-size:18px;" colspan="'.$page.'"><span>'.$organization_name.'</span></td></tr>';
            if(!is_array($val)){//如果该分卷里面的内容不是数组,略过去
                continue;
            }
            foreach($val as $k=>$v){
                $p_id_arr[] = $key==0?($k==0?'none':$catalog[0][$k-1]->id):($k==0?$catalog[$key-1][count($catalog[$key-1])-1]->id:$catalog[$key][$k-1]->id);
                $n_id_arr[] = $key==0?(($k+1>count($catalog[0])-1)?$catalog[1][0]->id:$catalog[0][$k+1]->id):(($k+1>count($catalog[$key]))?"":((isset($catalog[$key][$k+1]->id))?$catalog[$key][$k+1]->id:(isset($catalog[$key+1][0]->id)?$catalog[$key+1][0]->id:'none')));
//                if($key==0){
//                    if($k==0){//0,0
//                        if(isset($catalog[0][0]->id)){
//                            $p_id = $catalog[0][0]->id;//上一页
//                        }else{
//                            $p_id = '错误';
//                        }
//                        echo $k.'---',$p_id.'###';
//                    }else{
//                        if(isset($catalog[0][$k-1]->id)){
//                            $p_id = $catalog[0][$k-1]->id;
//                        }else{
//                            $p_id='错误';
//                        }
//                        echo $k.'---',$p_id.'###';
//                    }
//                    if($k+1>count($catalog[0])-1){//下一页
//                        if(isset($catalog[1][0]->id)){
//                            $n_id = $catalog[1][0]->id;
//                        }else{
//                            $n_id = '错误';
//                        }
//                        echo $k.'---',$n_id.'<br>';
//                    }else{
//                        if(isset($catalog[0][$k+1]->id)){
//                            $n_id = $catalog[0][$k+1]->id;
//                        }else{
//                            $n_id='错误';
//                        }
//                        echo $k.'---',$n_id.'<br>';
//                    }
//                }else{
//                    if($k==0){//N,0,上一页
//                        $counts = count($catalog[$key-1]);
//                        if(isset($catalog[$key-1][$counts-1]->id)){
//                            $p_id = $catalog[$key-1][$counts-1]->id;
//                        }else{
//                            $p_id = '错误';
//                        }
//                        echo $k.'---',$p_id.'###';
//                    }else{
//                        if(isset($catalog[$key][$k-1]->id)){
//                            $p_id = $catalog[$key][$k-1]->id;
//                        }else{
//                            $p_id = '错误';
//                        }
//                        echo $k.'---',$p_id.'###';
//                    }
//                    if($k+1>count($catalog[$key])){//下一页
//                        echo $k+1;
//                        echo count($catalog[$key]);
//                        if(isset($catalog[$key][$k+1]->id)){
//                            $n_id = $catalog[$key][$k+1]->id;
//                        }else{
//                            $n_id = '错误';
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
                if((($i)%$page)!=0){
                    $html .= "<td><a href=\"/ChapterContent?book_id={$book_id}&&chapter_id={$v->id}\" class=\"js_input\">{$v->chapter_name}</a></td>";
                }else{
                    $html .= "<td><a href=\"/ChapterContent?book_id={$book_id}&&chapter_id={$v->id}\" class=\"js_input\">{$v->chapter_name}</a></td></tr><tr>";
                }
                $i++;
            }
            $html .="</tr>";
        }
        $pre_arr = json_encode($p_id_arr);
        $next_arr = json_encode($n_id_arr);
        $res = array($html,$pre_arr,$next_arr);
        return $res;
    }
    static public function getPreNextList($catalog){
        foreach($catalog as $key=>$val){
            foreach($val as $k=>$v){
                $p_id_arr[] = $key==0?($k==0?'none':$catalog[0][$k-1]->id):($k==0?$catalog[$key-1][count($catalog[$key-1])-1]->id:$catalog[$key][$k-1]->id);
                $n_id_arr[] = $key==0?(($k+1>count($catalog[0])-1)?$catalog[1][0]->id:$catalog[0][$k+1]->id):(($k+1>count($catalog[$key]))?"":((isset($catalog[$key][$k+1]->id))?$catalog[$key][$k+1]->id:(isset($catalog[$key+1][0]->id)?$catalog[$key+1][0]->id:'none')));
            }
        }
        $pre_arr = implode(',',$p_id_arr);
        $next_arr = implode(',',$n_id_arr);
        $res = array($pre_arr,$next_arr);
        return $res;
    }
}