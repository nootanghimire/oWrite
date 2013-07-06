<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Edits_model extends CI_Model{


	protected $last_insert_id=false;

	public function __construct(){
		parent::__construct();
		$this->load->database();

	}


	public function insertNewEdit($user_id, $book_id, $content){
		//make and insert Things
		$insertData = array(
					array(
					'EditedBy'=>$user_id,
					'BookId'=>$book_id,
					'editContent'=>$content,
					'ApproveStatus'=>0,
					'EditedOn'=>time()
					)
				);
		$a = $this->db->insert_batch('edits', $insertData);
		$this->last_insert_id = $this->db->insert_id();
		return $a;
		
	}

	public function setApproveYes($editId){
		$editId = sprintf("%d", $editId);
		//$updateData = array(
				//array(
				//'ApproveStatus'=>1,
				//'ApprovedOn' => time()
				//)
				//);
		//$this->db->where('EditId',$editId);
		$this->db->query('UPDATE edits SET ApproveStatus=\'1\', ApprovedOn=\''.time().'\' WHERE EditId =\''.$editId.'\';');
		//$this->db->update_batch('edits', $updateData);
	}

	public function getApproveStatus($editId){
		$this->db->from('edits')->where('EditId',$editId);
		$q = $this->db->get();
		$row = $q->row();
		return $row->ApproveStatus;
	}
	
	public function getEditsByUser($username){
		$this->db->from('edits')->where('EditedBy', $username);
		$q = $this->db->get();
		return $q->result(); //array of objects
	}
	
	public function getEditsForBook($bookId){
		//use security. return edits (Array of objects) for book
		$this->db->from('edits')->where('BookId', $bookId);
		$q = $this->db->get();
		return $q->result(); //array of objects
	}
	
	public function getEditsByUserForBook($username, $bookId){
		$this->db->from('edits')->where(array('EditedBy'=>$username, 'BookId'=>$bookId));
		$q = $this->db->get();
		return $q->result(); //array of objects; //use foreach on the other side
	}
	
	public function getSpecificEdit($editId){
		$this->db->from('edits')->where('EditId', $editId);
		$q =  $this->db->get();
		return $q->row(); //returns object. (databse clone :) )
	}

	public function getInsertId(){
		return $this->last_insert_id;
	}
}

?>
