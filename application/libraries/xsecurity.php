<?php

class Xsecurity {
	protected $CI;
	protected $userName = ""; //check if username is empty or not to be sure about login status.
	public function __construct(){
		$this->CI = & get_instance();
	}

	public function SetInfoLocal($data){
		$this->CI->load->library('encrypt');
		$to_encrypt =  $data .  $_SERVER['HTTP_USER_AGENT'];
		$encrypted = $this->CI->encrypt->encode($to_encrypt, $_SERVER['HTTP_USER_AGENT']);
		setcookie('s',$encrypted, time() + 60*60*24*3, "/");
		//setcookie(name, value, expire, path)
	}

	public function isUserActivated(){
		if(!isset($_COOKIE['y'])){return false; }
		$this->CI->load->library('encrypt');
		$uname = $this->CI->encrypt->decode($_COOKIE['y'], $_SERVER['HTTP_USER_AGENT']);
		$this->CI->load->model('user_model');
		if($this->CI->user_model->init($uname)<1){return false;}
		$this->userName =  $uname;
		$p = $this->CI->user_model->getPassword();
		$e = $p .  $_SERVER['HTTP_USER_AGENT'];
		if(!isset($_COOKIE['s'])){return false;}
		$real = $this->CI->encrypt->decode($_COOKIE['s'], $_SERVER['HTTP_USER_AGENT']);
		if($real == $e){ return true;} else {return false;}
	}
	
	public function getUserName() {
		return $this->userName;
	}
}