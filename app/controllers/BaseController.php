<?php

class BaseController extends Controller {
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
    public function __construct(){
        $this->is_user_login();
        $this->ipManager();
    }
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
    //xss 过滤(post)
    protected function post($name, $default = null){
        $__value = isset($_POST[$name]) ? $_POST[$name] : '';
        if ($__value == '' && $default != null)
            return $default;
        return $this->remove_xss($__value);
    }
    protected function get($name, $default = null){
        $__value = isset($_GET[$name]) ? $_GET[$name] : '';
        if ($__value == '' && $default != null)
            return $default;
        return $this->remove_xss($__value);
    }
    protected function remove_xss($val){
        if (is_array($val)) return $val;
        return htmlspecialchars($val, ENT_QUOTES);
    }
    //判断是否登录
    protected function is_admin_login(){
        session_start();
        if (!isset($_SESSION['admin_login']))
        {
            throw new Exception('登陆失败');
        }
        session_write_close();
    }
    /*
     * 判断用户是否登陆,前端逻辑
     * */
    protected function is_user_login(){
        session_start();
//        dd(isset($_SESSION['user_login']));
        if(isset($_SESSION['user_login'])){
            $user_id= $_SESSION['user_login'];
//            $userInfo = new User_UserInfoModel();
//            $user_info = $userInfo->getUserBaseInfoById($user_id);
            $user_info = User_UserNewInfoModel::getUserInfoByUserId($user_id);
            $user_property = User_UserNewInfoModel::getUserPropertyByUserId($user_id);
            $user_detail = User_UserNewInfoModel::getUserDetailById($user_id);
            if(!is_null($user_info)){
                //用户头像url
                $p_url = './uploads/users/'.$user_info->user_picture;
                $default_picture_url = './Home/img/user_default_picture.png';
                if($user_info->user_picture != ''){
                    if(file_exists($p_url)){
                        $user_picture_url = $p_url;
                    }else{
                        $user_picture_url = $default_picture_url;
                    }
                }else{
                    $user_picture_url = $default_picture_url;
                }
                //用户头像url end
                View::share('user_info',$user_info);
                View::share('user_detail',$user_detail);
                View::share('user_property',$user_property);
                View::share('user_picture_url',$user_picture_url);
                session_write_close();
                return $user_info;
            }else{
                session_write_close();
            }

        }else{
            session_write_close();
        }
    }
    /*
     * 返回上一级url
     *
     * */
    protected function from_url(){
        $from_url = null;
        if(!empty($_SERVER['HTTP_REFERER'])){
            $_SESSION['from_url'] = $_SERVER['HTTP_REFERER'];
        }
        if(!empty($_SESSION['from_url'])){
            $from_url = $_SESSION['from_url'];//上一级的url地址
        }else{
            $from_url = 'http://www.rgrass.com';
        }
        $from_url = 'http://www.rgrass.com';
        return $from_url;
    }
    /*获取用户个人IP*/
    protected function getIp(){
        $onlineip='';
        if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){
            $onlineip=getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
            $onlineip=getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){
            $onlineip=getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){
            $onlineip=$_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }
    /*
     * 把IP进行处理并写入日志txt文件里面
     * */
    protected function ipManager(){
        $IP = $this->getIp();
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $from="";
        if(isset($_SERVER['HTTP_REFERER']))
        {
            $from = $_SERVER['HTTP_REFERER'];
        }
        $now_time = date('Y-m-d H:i:s',time());
        $user_ip_manager = array(
            'ip'=>$IP,
            'time'=>$now_time,
            'url'=>$url,
            'from'=>$from
        );
        $s_user_ip_manager = serialize($user_ip_manager);
        $today = date('Y-m-d',time());
        $path_today = './Logs/log_'.$today.'.txt';
        if(!file_exists($path_today)){
            touch($path_today);
        }
        $file_pointer = fopen( $path_today,"a");//打开文件
        fwrite($file_pointer,$s_user_ip_manager.',');//写入文件
        fclose($file_pointer);//关闭文件

    }
}
