<?php

class Search{
	public $starttime;
	public $endtime;
	protected $_CI;
	protected $NumResults;


	public function __construct(){
		
		$this->_CI =& get_instance();
		$this->NumResults = "";
	}

	public function searchTags($term){
		$term = explode(" ", $term);
		$term[0] = "%".$term[0];
		$term[count($term)-1]= $term[count($term)-1]."%";
		$term = implode("%", $term); 
		$this->_CI->load->database();
		$quer = "SELECT * FROM books WHERE tags LIKE '$term';";
		$q = $this->_CI->db->query($quer);
		$num_rows = $q->num_rows();
		return $q->result();
	}


	public function search($term){
		$this->starttime = time().microtime();

		/*$term = explode(" ", $term);
		$term[0] = "%".$term[0];
		$term[count($term)-1]= $term[count($term)-1]."%";
		$term = implode("%", $term); */
		$term = "%".$term."%";
		$this->_CI->load->database();
		$quer = "SELECT * FROM books WHERE BookTitle LIKE '$term';";
		$q = $this->_CI->db->query($quer);
		$num_rows = $q->num_rows();
		$dat['title'] = $q->result();
		$quer1 = "SELECT * FROM books WHERE Content LIKE '$term';";
		$q1 = $this->_CI->db->query($quer1);
		$dat['content'] = $q1->result();
		$num_rows +=  $q1->num_rows();
		$this->NumResults = $num_rows;
		$this->endtime = time().microtime();
		return $dat;
	}

	public function getExecTime(){
		return ($this->endtime - $this->starttime);
	}

	public function getNumResults(){
		return $this->NumResults;
	}

}


