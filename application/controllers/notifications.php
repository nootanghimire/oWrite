<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Notifications extends CI_Controller {

	public function index(){
		$this->load->model('notification_model');
		$this->load->library('xsecurity');
		if(!$this->xsecurity->isUserActivated()){
			//view Error;
			$this->load->view('books/header', array('title'=>'Notifications'));
			$this->load->view('content/specificError', array('ErrorMessage'=>'Whose notification do you want to see, huh? Tell me and I\'ll provide that! Now stop laughing this and login fast!'));
			$this->load->view('partial/login', array("redirect_to"=>"/notifications/"));
			$this->load->view('footer');
			return false;
		}

		$userName = $this->xsecurity->getUserName();
		$data['notifications'] = $this->notification_model->fetchNotifications($userName);
		$this->load->view('header', array('title'=>'Notifications'));
		$this->load->view('notification', $data);
		$this->load->view('footer');

	}

	public function seen($id, $class,$method, $arg=null){
		$this->load->model('notification_model');
		$this->notification_model->MakeNotificationSeen($id);
		ob_start();
		header("location:/".$class."/".$method."/".$arg);
	}

	public function getNum(){
		//returns total number of notifications;
		$this->load->library('xsecurity');
		$this->load->model('notification_model');
		if(!$this->xsecurity->isUserActivated()) return false;
		$userName = $this->xsecurity->getUserName();
		$num =$this->notification_model->getNumNotification($userName);
		$this->load->view('partial/numNotification', array("num"=>$num));
	}
}

?>