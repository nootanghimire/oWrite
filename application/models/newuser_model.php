<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Newuser_model extends CI_Model {
	
 	public function __construct(){
 		parent::__construct();
 		$this->load->database();
 	}

 	public function setUserDetailsBasic($uname, $password, $email){
 		$data = array(
 					array(
 					'UserId'=>'NULL',
 					'UserName'=> $uname,
 					'EncPassword'=> $password,
 					'Email'=> $email
 					)
 			);
 		return $this->db->insert_batch('users', $data);
 	} 	


}

?>
