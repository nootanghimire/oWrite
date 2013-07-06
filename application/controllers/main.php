<?php

class Main Extends CI_Controller{

	function index(){
		
			$this->load->library('xsecurity');
			if(!($this->xsecurity->isUserActivated())) {
			$this->load->view('initial');
			} else {
				ob_start();
				header("location:/user/profile");
			}
			
	}
	
	function loginToContinue($redirect_to = null){
	$redirect_to = ($redirect_to == null) ? "/main/index" : $redirect_to ;
		$this->load->view('initial', array("redirect_to"=>$redirect_to));
	}
}