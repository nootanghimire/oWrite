<?php

Class Vote {
	protected $CI; //The CodeIgniter Instance

	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->database();
	}

	public function getVotesFor($bookId){
		$this->CI->db->where('BookId', $bookId);
		$q = $this->CI->db->get('votes');
		$negativeVotes = $positiveVotes = 0;
		$data = $q->result();
		foreach ($data as $key => $datum) {
			if($datum->VoteType == 1){
				$positiveVotes++;
			} else {
				$negativeVotes++;
			}
		}
		return $positiveVotes - $negativeVotes; 
	}

	public function VoteUp($bookId){
		$this->CI->load->library('xsecurity');
		$flag = false;
		if(!$this->CI->xsecurity->isUserActivated()){return false;}
		$userName = $this->CI->xsecurity->getUserName();
		$this->CI->db->where('BookId', $bookId);
		$q = $this->CI->db->get('votes');
		$data = $q->result();
		foreach ($data as $key => $datum) {
			if($datum->VotedBy == $userName) { $flag=true; break; }
		}
		if($flag) return false;
		$insertData = array(
						array(
							"BookId"=>$bookId,
							"VoteType"=>1,
							"VotedBy"=>$userName,
							"VotedOn"=>time()
							)
						);
		return $this->CI->db->insert_batch('votes', $insertData);
	}

	public function VoteDown($bookId){
		$this->CI->load->library('xsecurity');
		$flag = false;
		if(!$this->CI->xsecurity->isUserActivated()){return false;}
		$userName = $this->CI->xsecurity->getUserName();
		$this->CI->db->where('BookId', $bookId);
		$q = $this->CI->db->get('votes');
		$data = $q->result();
		foreach ($data as $key => $datum) {
			if($datum->VotedBy == $userName) { $flag=true; break; }
		}
		if($flag) return false;
		$insertData = array(
						array(
							"VoteId"=>"NULL",
							"BookId"=>$bookId,
							"VoteType"=>0,
							"VotedBy"=>$userName,
							"VotedOn"=>time()
							)
						);
		return $this->CI->db->insert_batch('votes', $insertData);
	}


}

?>