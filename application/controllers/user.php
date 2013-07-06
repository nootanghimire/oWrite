<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	private $e; 
	private function login_core($username, $user_pass){
		//Get value from database
		$this->load->model('user_model');
		if($this->user_model->init($username) == 1){
			$pass = $this->user_model->getPassword();
			$this->e['db_pass'] = $pass; 
			//Now encrypt th real password 
			//Make thisL
			$e_p = $username. $user_pass . $this->user_model->getEmail();
			$e_p = sha1($e_p);
			$this->e['act_pass'] = $e_p;
			 //Whenever the email is changed, update the password. (Require password to change the email)
			$this->load->library('encrypt');
			$this->load->library('xsecurity');

			//cookie not set :( . And i don't know the reason. 
			//The problem above (cookie not set) was solved. I forgot to use time() + (extratime)  :)
			if($pass == $e_p){
				$this->xsecurity->SetInfoLocal($e_p);
				setcookie('y',$this->encrypt->encode($username, $_SERVER['HTTP_USER_AGENT']),time() + 60*60*24*3, '/');
				return true;
			} else {
				return false; //false'
			}

		} else {
			return false;
		}
	}


	public function login(){
		if(!isset($_POST['user'], $_POST['pass'])){ 
			$this->load->view('header');
			$this->load->view('content/errorError');
			$this->load->view('footer');
			return false;
		}

		$user = strtolower($_POST['user']);
		$pass = $_POST['pass'];
		$redirect_to  = (isset($_POST['redirect_to'])) ? ( (trim($_POST['redirect_to']) != "") ? $_POST['redirect_to'] : null ) : null ; 
		
		if(self::login_core($user, $pass)){
			$d['a'] = $this->e;
			$this->load->view('header', $d);
			if($redirect_to!=null) { 
				ob_start();
				header('location:'. $redirect_to);
				return true;
			}
			$data['userloggedOn'] = true;
			$this->load->view('main', $data);
		}
		else
		{
			$data['userloggedOn'] = false;
			$this->load->view('initial', array('passwordWrong'=>true));
			return false;
		}

		$this->load->view('footer');
		ob_start();
		header('location:/user/profile');
	}


	public function profile($username = null){
		$this->load->library('xsecurity');
		if($username!=null){
			echo $this->xsecurity->getUsername();
		if($this->xsecurity->getUserName() != $username) {return self::othersProfile($username);}
		}
			
			if(!$this->xsecurity->isUserActivated()){return false;}
			$this->load->model('user_model');
			$this->load->model('books_model');
			$data['MyBooks'] = $this->books_model->getBooksByUser($this->xsecurity->getUserName());
			$this->load->model('edits_model');
			$hold_edits_data = $this->edits_model->getEditsByUser($this->xsecurity->getUserName());	
			//foreach 
			$editsobjArray= array();
			foreach ($hold_edits_data as $key => $holding_var) {
				$editsobjArray[$key] = $this->books_model->getBookById($holding_var->BookId);  
			}
			//end foreach
			$data['EditedBooks'] = $editsobjArray;
			$this->load->view('header');
			if($this->user_model->init($this->xsecurity->getUserName()) == 1){

				$data['User'] = $this->user_model->getEntireObject();
				$data['GreetingType'] = "Welcome, ";
				$this->load->view('user/profile', $data); //use UserObject Object to print out what is required. 
				$this->load->view('footer');
			} else {
				//
			}
		
	}

private function othersProfile($username){
	$this->load->model('user_model');
	if($this->user_model->UserExists($username)){
		//$this->user_model->init($username);
		$data['User'] = $this->user_model->getEntireObject();
		$this->load->model('books_model');
		$this->load->model('edits_model');
		$data['MyBooks'] = $this->books_model->getBooksByUser($username);
		$hold_edits_data = $this->edits_model->getEditsByUser($username);
		$editsobjArray = array();
		foreach ($hold_edits_data as $key => $holding_var) {
			$editsobjArray[$key] = $this->books_model->getBookById($holding_var->BookId);  
		}
		//end fopeach
		$data['EditedBooks'] = $editsobjArray; 
		$data['GreetingType'] = "Profile For: ";
		$data['logout']="set"; //set logout to remove showing logout
		$this->load->view('header');
		$this->load->view('user/profile', $data);
		$this->load->view('footer');
	}



}

public function signup(){

	if(!isset($_POST['user'], $_POST['pass'], $_POST['email'])){	
		$this->load->view('header');
		$this->load->view('content/errorError');
		$this->load->view('footer');
		return 0;
	} else {
		if(trim($_POST['user'])=="" || trim($_POST['pass']) == "" || trim($_POST['email'])==""){
			$this->load->view('header');
			$this->load->view('content/specificError', array('ErrorMessage'=>'You moroon! Don\'t play with forms!'));
			$this->load->view('footer');
			return 0;
		}
		$username = strtolower($_POST['user']);
		$password = $_POST['pass'];
		$email = $_POST['email'];
		if(self::UserExists($username)){
			$this->load->view('header');
			$this->load->view('content/specificError',array('ErrorMessage'=>'User Already Exists'));
				//load other thingo here
		} else {
				//The whole logic here
			$pass = $username . $password . $email ;
			$pass = sha1($pass);
			$this->load->model('newuser_model');
			if($this->newuser_model->setUserDetailsBasic($username, $pass, $email)){
					//do other things here.
				if(self::login_core($username, $password)){
					ob_start();
					header('location:/user/profile');
				} else{
					$this->load->view('header');
					$this->load->view('content/specificError', array('ErrorMessage'=>'Oops! We Cannot Log you in! That must be an error. We\'ll figure it out soon. :)'));

				}
			}

		}
	}
	$this->load->view('footer');
}



public function first(){
		//show form here
	$this->load->view('header');
	$this->load->view('user/signup_form');
	$this->load->view('footer');
}


private function UserExists($username){
	$this->load->model("user_model");
	$this->user_model->init($username);
	return $this->user_model->isUserObject;
		/*if($this->user_model->init($username) >= 1) {
			return true;		//exists
		} else {
			return false;		//does not exist 			
		}*/
	}

	//returns login box or user info, depending upon situation
	public function boxContents(){
		//shows login box if not logged on! or user info
		$this->load->library('xsecurity');
		if($this->xsecurity->isUserActivated())	{
			//load notification view!
			$this->load->view('partial/user_info'); //send data in the future as needed
		} else {
			//load basic thingy!
			$this->load->view('partial/login');
		}
	}
	
	function titleContents() {
		$this->load->library('xsecurity');
		if($this->xsecurity->isUserActivated())	{
			//load notification view!
			$this->load->model('notification_model');
			$num = $this->notification_model->getNumNotification($this->xsecurity->getUsername());
			$this->load->view('partial/ShowUsername', array("user"=>$this->xsecurity->getUsername(), "num"=>$num)); //send data in the future as needed
		} else {
			//load basic thingy!
			$this->load->view('partial/loginSignupMsg');
		}
	}
	
	public function logout(){
		//simply remove cookies, and load 
		setcookie('s','oops! the user is logged out.', 60, '/'); //time = 60 . means that the cookie was expired 60 seconds after some date
		setcookie('y','oops! the user is logged out.', 60, '/');
		$this->load->view('initial', array("LogoutMessage"=>"Heading out ! We'll miss you!")); 
	}




	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
