<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Books_model extends CI_Model{

	protected $insert_id;

	public function __construct(){
		parent::__construct();
		$this->load->database();

	}

	public function getInsertId(){
		return $this->insert_id;
	}

	public function getFromCat($category){
		$this->db->from('books')->where('BookCategory', $category);
		$q = $this->db->get();
		return $q->result(); //results array of objects
	}

	public function getBookById($id){
		$this->db->from('books')->where('BookId', $id);
		$q = $this->db->get();
		return $q->row(); //single row for results
	}

	public function getBooksLikeName($name){
		$this->db->from('books')->like('BookName', $name);
		$q = $this->db->get();
		return $q->result(); //results array of objects
	}

	public function getBooksByUser($username){
		$this->db->from('books')->where('BookAuthor',$username);
		$q = $this->db->get();
		return $q->result(); //result is array of objects	
	}
	

	public function saveToBook($title, $content, $author_username, $category="",  $description=""){
		//$content must have all the contents. It will replace all the contents
		$insertData = array(
					array(
					'BookTitle' => $title,
					'Content' => $content,
					'BookStartedOn' => time(),
					'BookAuthor' => $author_username,
					'Description' => $description,
					'tags'=>$category
					)
				);
		$ret =  $this->db->insert_batch('books', $insertData);
		$this->insert_id = $this->db->insert_id();
		return $ret;
	}
	
	public function getContributors($book_id){
		$book_obj = self::getBookById($book_id);
		return $book_obj->Contributors;
	}
	
	public function addContributor($book_id, $contributer_username) {
		$contributors = self::getContributors($book_id); 
		$to_add = ($contributors == "") ? $contributer_username : ",".$contributer_username;
		//$to_add = mysqli_escape_string($to_add);

		$query = "UPDATE books SET Contributors='$to_add' WHERE BookId=$book_id ;";
		return $this->db->query($query);

	}
	
	public function removeContributor($book_id, $contributer_username) { //This thingo probably is never fcalled. 
		$to_add = str_replace(",".$contributer_username,"",$contributors);  //Check str_replace syntax
		$this->db->where('BookId', $book_id);
		return $this->db->update_batch("edits", array('Contributors'=>$to_add));
	}
	
	public function checkForContributor($bookid, $contributer_username){
		$contributors = explode(",",self::getContributors($bookid)); 
		if(in_array($contributer_username, $contributors)){
			return true;
		} 
		return false;
	}

	public function editDescription($bookid, $new_desc){
		$this->db->where('BookId', $bookid);
		return $this->db->update_batch("edits", array('Description'=>$new_desc));
	}
	
	public function changeCategory($bookid, $new_cat){
		$this->db->where('BookId', $bookid);
		return $this->db->update_batch("edits", array('BookCategory'=>$new_cat));
	}
	public function bookExists($book_id){
		return is_object(self::getBookById($book_id));
	}

	public function changeContent($book_id, $new_cont){
		$new_cont = mysql_real_escape_string($new_cont);
		$query = "UPDATE books SET Content='$new_cont' WHERE BookId='$book_id';";
		$this->db->query($query);
	}
	public function getRecentBooks(){
		
		$query = "SELECT * FROM books ORDER BY BookStartedOn DESC LIMIT 0,10;";
		$q = $this->db->query($query);
		$data = $q->result();
	}

	public function getTrendingBooks(){
		//See Number of votes (Total Votes Versus DownVotes)
		//See time
		//See Number of Contributers
		//See Number of Edits'
		$query = "SELECT DISTINCT BookId FROM edits  WHERE EditedOn > ".(time()-86400).";";	
		$q = $this->db->query($query);
		$data = $q->result();
		$bookId = array();
		foreach($data as $datum){
			//echo $datum->BookId;
			$bookId[]= $datum->BookId;
		}
		$query = "SELECT SUM(BookId) FROM edits WHERE BookId IN (".implode(",",$bookId).")";	
		$q2 = $this->db->query($query);
		$data2 = $q->result();
		var_dump($data2);

	}


}
?>	