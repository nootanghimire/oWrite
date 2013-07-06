<style type="text/css">
ul{
	background-color: #fff;
	box-shadow: 0 0 6px #848484;
	margin:0 auto;
	width: 90%
}
li {
	display: block;
	background-color: #fff;
	list-style-type: none;
	border-bottom: 1px solid #999;
	margin-left: -50px;
	padding:10px;
	font-size: 18px;
	padding-left: 30px;
	transition:all .25s ease;
	cursor: pointer;
}
li:hover{
	background-color: #01a2e8;
	color:#eee;
}
a{
	color: inherit;
}
a:hover{
	text-decoration: none;
	color: inherit;
}
</style>
<div id="contents" style="opacity:1;margin-top:-30px;">
	<div id="contents_search" style="margin-left:-50px;">
		<h3>Changes Made <?php echo  (isset($viewingEditsFor)) ? "for ".$viewingEditsFor." " : "" ;?> <?php echo (isset($viewingEditsBy)) ? "by " . $viewingEditsBy : "" ; ?></h3>
	</div>
	<div id="contents_edits">
		<ul style="font-size:20px;padding-left:50px;">
	<?php foreach ($edits as $key => $edit) {
		if($edit->ApproveStatus) continue; 
		?>
		<a href="/edits/show/<?=$edit->EditId?>">
		<?php
		echo "<li>".$edit->EditedBy." edited ";
		if(isset($bookNames)){
			echo (strlen($bookNames[$key]) < 30)? $bookNames[$key] : substr($bookNames[$key], 0, 30). "...." ;
		} else {
			echo "this doc";
		}
		echo " ";
		$currentTime = time();
		$editedTime = $edit->EditedOn;
		$difference =  $currentTime - $editedTime ;
		
		if($difference<10){
			echo "just now!"; 
		} elseif($difference<60){
			echo "few seconds ago";
		} elseif($difference<60*5){
			echo "few minutes ago";
		} elseif ($difference<60*30){
			echo "some minutes ago";
		} elseif($difference<60*50){
			echo "about half hour ago";
		} elseif($difference>=60*50 && $difference<60*90){
			echo "about an hour ago";
		} elseif ($difference >= 60*90 && $difference<60*60*24){
			echo "hours back";
		} elseif ($difference>=60*60*24 && $difference<60*60*24*30){
			echo "many days back";
		} else{
			echo "a long time ago..";
		}

		?>
		</li></a>
	<?php 
	}
	
	?>

	</ul>

	</div>
</div>