<?php

Class User_model extends CI_Model {

	private $users_row;
	private $num_rows;
	public $isUserObject = false;


	public function __construct(){
		parent::__construct();
	}

	public function init($username){
		$this->load->database();
		$this->db->from('users')->where('UserName', $username);
		$query = $this->db->get();
		//$query = $this->db->query("SELECT * FROM users WHERE Username='test';");
		$this->users_row = $query->row();
		$this->setWhere();
		$this->num_rows = $query->num_rows();
		if(is_object($this->users_row)) {
			$this->isUserObject = true;
		}
		return $this->num_rows;
	}


	public function getNumRows(){
		return $this->num_rows;	
	}

	public function UserExists($userName=null){
		if($userName==null){return false;}
			$this->isUserObject = false;
			self::init($userName);
			return $this->isUserObject;
	}

	/*
	 * Database get methods
	 */

	public function getPassword(){
		return $this->users_row->EncPassword;
	}

	public function getName(){
		$a = $this->users_row;
		return array("First"=> $a->FirstName, "Middle" => $a->MiddleName, "Last"=> $a->LastName);
	}

	public function getEmail(){
		return $this->users_row->Email;
	}

	public function getUid(){
		return $this->users_row->UserId;
	}

	public function getDOB($format = 'l, F y'){
		return date($format, $this->users_row->DOB);
	}

	public function getBio(){
		return $this->users_row->Bio;
	}

	public function getPic(){
		return $this->users_row->Picture;
	}

	public function getPoints(){
		return $this->users_row->Points;
	}

	public function getCurrentConsecutive(){
		return $this->users_row->currentConsecutiveHand;
	}

	public function getMaxConsecutive(){
		return $this->users_row->MaximumConsecutive;
	}

	public function getLastActive(){
		return $this->users_row->LastActive;
	}

	public function getQ1(){
		return $this->users_row->SecurityQuestion1;
	}

	public function getQ2(){
		return $this->users_row->SecurityQuestion2;
	}

	public function getA1(){
		return $this->users_row->Answer1;
	}

	public function getA2(){
		return $this->users_row->Answer2;
	}

	public function getEntireObject(){
		return $this->users_row;
	}

	/*
	 * Database set methods
	 * Merely an update query
	 */

	public function setWhere($where=FALSE){
		if($where === FALSE ){
			if($this->isUserObject){
				$this->db->where("UserID",$this->getUid());
			}
		}

	}

	public function setLastActive($value){
			return $this->db->update_batch('users',array('LastActive'=>$value));	
	}

	public function setCurrentConsecutive($value){
		return $this->db->update_batch('users',array('currentConsecutiveHand'=>$value));	
	}

	public function setMaxConsecutive($value){
		return $this->db->update_batch('users',array('MaximumConsecutive'=>$value));	
	}

	public function setQ1($value){
		return $this->db->update_batch('users',array('SecurityQuestion1'=>$value));	
	}

	public function setQ2($value){
		return $this->db->update_batch('users',array('SecurityQuestion2'=>$value));	
	}

	public function setBio($value){
		return $this->db->update_batch('users',array('Bio'=>$value));	
	}

	public function setPic($value){
		return $this->db->update_batch('users',array('Picture'=>$value));	
	}

	public function setEmail($value){
		return $this->db->update_batch('users',array('Email'=>$value));	
	}

	public function setName($arr_name){
		return $this->db->update_batch('users',array('FirstName'=>$arr_name[0], 'MiddleName'=>$arr_name[1], 'LastName'=>$arr_name[2]));	
	}

	public function setDOB($timeStamp){
		return $this->db->update_batch('users',array('DOB'=>$timeStamp));	
	}

	public function setPoints($value){
		return $this->db->update_batch('users',array('Points'=>$value));	
	}

}