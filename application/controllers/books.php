<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller {


	public function see($id=null){
		$this->load->view('header');
		if($id==null){
		
			$this->load->view('content/specificError', array('ErrorMessage'=>'Id Cannot Be Null.'));
			$this->load->view('footer');
			return false;
		}
		$this->load->library('vote');
		$totalVotes = $this->vote->getVotesFor($id);
		$this->load->model('books_model');
		if(!( $book = $this->books_model->getBookById($id))){
			$this->load->view('content/specificError', array('ErrorMessage'=>'Databse Error.'));
			$this->load->view('footer');
			return false;
		}

		$this->load->view('books/see', array('Book'=>$book, 'votes'=>$totalVotes)); //use $Book->BookTitle, etc... in view
		$this->load->view('footer');	
	}


	public function approve($editId_array){
		//use fine diff. check security
	}	

	public function submitEdit(){
		//Use POST for
		//	$Book_ID
		//	$New_Content	
		// Then use FineDiff to find the differences and store it in database.  Use edits_model
		$this->load->library('xsecurity');
		if(!($this->xsecurity->isUserActivated())){
			$this->load->view('header');
			$this->load->view('content/specificError', array('ErrorMessage'=>'Oops! You must be logged On to write a book! And it\'s easier. Just click the link below and you are done'));
			$this->load->view('partial/login');
			$this->load->view('footer');
			return false;
		}
		if(!isset($_POST['content'], $_POST['book_id'])){
			$this->load->view('books/header');
			$this->load->view('content/errorError');
			$this->load->view('footer');
			return false;
		}
		//make edit_model
		$book_id = $_POST['book_id']; $content=  $_POST['content'];
		$this->load->model('edits_model');
		if($this->edits_model->insertNewEdit($this->xsecurity->getUserName(), $book_id, $content)){
			//load something good
			ob_start();
			header('location:/edits/show/'.$this->edits_model->getInsertId());
		} else {
			//load error view
			echo "Bad";
		}
	}
	
	public function write(){
		$this->load->library('xsecurity');
		if(!($this->xsecurity->isUserActivated())){
			$this->load->view('header');
			$this->load->view('content/specificError', array('ErrorMessage'=>'Oops! You must be logged On to write a book! And it\'s easier. Just click the link below and you are done'));
			$this->load->view('partial/login');
			$this->load->view('footer');
			return false;
		} else {
			$this->load->view('header');
			$this->load->view('books/writeBook');
			$this->load->view('footer');
		}
		
	}

	public function save(){
		$this->load->library('xsecurity');
		if(!$this->xsecurity->isUserActivated()){return false;}
		if(!isset($_POST['content'], $_POST['title'])){
			$this->load->view('header');
			$this->load->view('content/specificError', array('ErrorMessage'=>"Cannot find anything to save!") );
			$this->load->view('footer');
			return false;
		} else {
		   //write book save logic here
		   $book_content = $_POST['content'];
		   $book_title = $_POST['title'];
		   $book_tags =  $_POST['tag'];
		   $this->load->model('books_model');
		   $this->books_model->saveToBook($book_title, $book_content, $this->xsecurity->getUserName(), $book_tags);
		   $this->load->model('tags_model');
		   $tags = explode(",",$book_tags);
		   foreach ($tags as $tag) {
		   	if(!$this->tags_model->addTag($tag)){
		   		$this->tags_model->addUsage($tag);
		   	}
		   }
		   ob_start();
		   header('location:/books/see/'.$this->books_model->getInsertId());
		}	
	}
	
	public function edit($bookid=null){
		$this->load->library('xsecurity');
		if($bookid == null){
			$this->load->view('books/header');
			$this->load->view('content/specificError', array('ErrorMessage' => "Cannot find any book id to edit!"));
			$this->load->view('footer');
		} else {
			if(!($this->xsecurity->isUserActivated())){
				$this->load->view('books/header');
				$this->load->view('content/specificError', array('ErrorMessage'=>'Oops! You must be logged On to edit a book! And it\'s easier. Just click the link below and you are done'));
				$this->load->view('partial/login', array("redirect_to"=>"/books/edit/".$bookid));
				$this->load->view('footer');
				return false;
			}
			//display book editor;
			$this->load->model('books_model');
			if($this->books_model->bookExists($bookid)){
			$this->load->view('header');
			$this->load->view('books/edit', array("Book"=>$this->books_model->getBookById($bookid))); //use $Books-> to access 
			$this->load->view('footer');
			} else {
				$this->load->view('header');
				$this->load->view('content/specificError', array('ErrorMessage'=>'Oops! We cannot find book with that ID'));
				$this->load->view('footer');
			}
		}
		
	}

	public function search($term=null){
		$this->load->library('search');
		$data['data'] = $this->search->search($term);
		$data['exec_time'] = $this->search->getExecTime();
		$data['num_results']=$this->search->getNumResults();
		$this->load->view('header');
		$this->load->view('search', $data);
		$this->load->view('footer');
	}

	public function explore(){
	/*	$this->load->database();
		$q = $this->db->get('books');
		$data['books']= $q->result();*/
		$this->load->model('tags_model');
		$data['tags'] = $this->tags_model->getAllTags();
		$this->load->view('header');
		$this->load->view('search_form', $data);
		$this->load->view('footer');
	}

	public function vote(){
		//everything is taken as post
		if(!isset($_POST['bookId'], $_POST['voteType'])){ echo "x"; return false;} //this condition is probably useless
		$bookId = $_POST['bookId'];
		$voteType = $_POST['voteType'];
		$voteType = ($voteType==1) ? true: false;
		$this->load->library('vote');
		if($voteType){
			if($this->vote->VoteUp($bookId) === false) { echo"x"; return false;}
		} else {
			if($this->vote->VoteDown($bookId) === false) { echo "x"; return false;}
		}
		$totalVotes = $this->vote->getVotesFor($bookId);
		$this->load->view('partial/voteStats', array('total_votes'=>$totalVotes));

	}

	public function tagged($tag_name=""){
		$this->load->view('header');
		$this->load->library('search');
		$data['Books'] = $this->search->searchTags($tag_name);
		$data['tag'] = $tag_name;		
		$this->load->view('books/tagged', $data);
		$this->load->view('footer');
	}
	
	public function trending(){
		//$this->load->view('header');
		$this->load->model('books_model');
		//var_dump($this->books_model->getTrendingBooks());
		$this->books_model->getTrendingBooks();
		//$this->load->view('books/trending');
		//$this->load->view('footer');
	}

	public function recent(){
		$this->load->view('header');
		$this->load->view('recent');
		$this->load->view('footer');
	}
	
}

/* End of file books.php */
/* Location: ./application/controllers/books.php */
