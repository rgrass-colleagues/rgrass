<?php

class BaseController extends Controller {
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
    public function __construct(){
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
    }
    /*
     * 判断用户是否登陆,前端逻辑
     * */
    protected function is_user_login(){
        session_start();
        if(isset($_SESSION['user_login'])){
            $username= $_SESSION['user_login'];
            $user_info = new User_UserInfoModel();
            $username = $user_info->getUserInfoByUserName($username);
            if(!is_null($username)){
                return $username;
            }else{
                return null;
            }

        }else{
            return null;
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
        $user_ip_manager = array($IP,time(),$url,$from);
        $create_txt = touch('1.txt');
        var_dump($create_txt);
        exit;
//        $file = 'http://rgrass.com/Logs/test.txt';
//        $str = 5678;
//        $file_pointer = fopen($file,"a");//打开文件
//        fwrite($file_pointer,$str);//写入文件
//        fclose($file_pointer);//关闭文件
//        dd(file_get_contents($file));

    }
}
