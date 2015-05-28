<?php

class BaseController extends Controller {
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
    public function __construct(){

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
}
