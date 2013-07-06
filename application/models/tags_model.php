<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class 	Tags_model {

	protected $CI;

	public function __construct(){
		$this->CI = &get_instance();
		$this->CI->load->database();
	}

	public function getAllTags(){ //default sorted by popularity
		$query = "SELECT * FROM tags ORDER BY tag_used DESC;";
		$q = $this->CI->db->query($query);
		$data = $q->result();
		return $data;
	}

	public function addTag($tag){
		$dat = self::getAllTags();
		foreach ($dat as $key => $datum) {
			if($datum->tag_name == $tag ) return false;
		}
		$insertData = array(
						array(
							"tag_name"=>$tag,
							"tag_used"=>0
						)
					);
		$this->CI->db->insert_batch('tags', $insertData);
	}

	public function addUsage($tag){
		$query = "SELECT * FROM tags WHERE tag_name='$tag';";
		$q = $this->CI->db->query($query);
		$datum = $q->row();
		$current = $datum->tag_used ;
		$current++;
		$query = "UPDATE tags SET tag_used=$current WHERE tag_name='$tag';";
		$q = $this->CI->db->query($query);
		
	}

	/*public function getTagsFor($bookId){
		$this->CI->db->from('books')->where('BookId', $bookId);
		$q = $this->get();
		$data = $q->row();
	}*/
}
?>