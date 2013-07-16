<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edits extends CI_Controller {

		public function view($editId){
		}
		
		//in config/routes.php route /edits/for to /edits/editsFor
		public function editsFor($bookId){
			$this->load->model('edits_model');
			$this->load->model('books_model');
			$book =  $this->books_model->getBookById($bookId);
			$edits = $this->edits_model->getEditsForBook($bookId);
			$data = array(
						"viewingEditsFor"=>$book->BookTitle,
						"edits"=>$edits
					);
			$this->load->view('header');
			$this->load->view('edits/viewEdits', $data);
			$this->load->view('footer');
		}

		//mapped to /edits/for/(:num)/by(:num)
		public function editsForBy($bookId, $userName){
			$this->load->model('edits_model');
			$this->load->model('books_model');
			$book = $this->books_model->getBookById($bookId);
			$edits= $this->edits_model->getEditsByUserForBook($userName, $bookId);
			$data = array(
						"viewingEditsFor" => $book->BookTitle, 
						"viewingEditsBy" => $userName,
						"edits"=>$edits
					);
			$this->load->view('header');
			$this->load->view('edits/viewEdits', $data);
			$this->load->view('footer');

		}

		public function by($userName=null){
			if($userName==null){return false;}
			$this->load->model('edits_model');
			$this->load->model('books_model');
			$edits =  $this->edits_model->getEditsByUser($userName);
			foreach ($edits as $key => $edit) {
				$book = $this->books_model->getBookById($edit->BookId);
				$bookName[$key]=$book->BookTitle;
			}
			$data = array(
						"edits"=>$edits,
						"bookNames"=>$bookName,
						"viewingEditsBy"=>""
					);
			$this->load->view('header');
			$this->load->view('edits/viewEdits', $data);
			$this->load->view('footer');
		}

		public function show($editId){

			$this->load->library('xsecurity');
			if(!$this->xsecurity->isUserActivated()){
				return false;
			}
			$userName = $this->xsecurity->getUserName();
		
		//FineDiff::$wordGranularity,
			include "/application/libraries/finediff.php";
			$this->load->library('findiff');
			$this->load->model('edits_model');
			$this->load->model('books_model');
			$e = $this->edits_model->getSpecificEdit($editId);
			$bId = $e->BookId;
			$b = $this->books_model->getBookById($bId);

			if(strtolower($userName) == strtolower($b->BookAuthor)){
				$data['isCurrentUserBook']= true;
			} else {
				$data['isCurrentUserBook']= false;
			}


			$from_text = $b->Content;
			$to_text = $e->editContent;
			$this->finediff->init($from_text, $to_text);
			$data['difference'] = $this->finediff->renderDiffToHTML() ;
			$data['editId']	= $editId; 		
			$this->load->vieW('header');
			$this->load->view('edits/showEdit', $data);
			$this->load->view('footer');
		}

		public function approve($editId=null){
			if($editId==null){return false;}
			$this->load->library('xsecurity');
			if(!$this->xsecurity->isUserActivated()){
				return false;
			}
			$userName = $this->xsecurity->getUserName();
			$this->load->model('books_model');
			$this->load->model('edits_model');
			$edits = $this->edits_model->getSpecificEdit($editId);
			$book = $this->books_model->getBookById($edits->BookId);
			if(strtolower($userName) != strtolower($book->BookAuthor)){
				echo "You scoundrel! We are traking you!! Don't tamper with the URL";
				return false;
			}
			$this->edits_model->setApproveYes($editId);
			$this->books_model->changeContent($edits->BookId,$edits->editContent);
			if(!$this->books_model->checkForContributor($edits->BookId, $edits->EditedBy)){
				$this->books_model->addContributor($edits->BookId, $edits->EditedBy);
			}
			$this->load->model('notification_model');
			$this->notification_model->setNotification($edits->EditedBy ,$userName. " approved your proposed edits to his doc. See the edited one!", "/books/see/".$edits->BookId);
			ob_start();
			header("location:/books/see/".$edits->BookId);
		}
}