<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
    public function __construct(){
        $this->is_admin_login();
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
}
