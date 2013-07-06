<div id="contents" style="opacity:1;">
	<div id="contents_profile_title">
		<div id="contents_search" style="margin-top:-30px;">
			<h3 style="color:#111"><?=$GreetingType?> <?=$User->UserName?> <?php if(!isset($logout)){ ?> | Hang in here, or <a href="/user/logout" style="color:#dd4814;"> walk the plank!</a><?php } ?></h3>
		</div>
	</div>
	<div id="contents_profile">
		<div id="contents_profile_left">
			<strong><?php if(!isset($logout)){ echo "My"; } else { echo ucfirst($User->UserName)."'s"; } ?> Docs</strong>
			<ol>
				<?php
				$myBooksArray = array();
				$count = 0;
				
				foreach ($MyBooks as $key => $value) {
					$myBooksArray[]=$value->BookId;
					echo "<li><a href='/books/see/".$value->BookId."'>".$value->BookTitle."</a></li>";
					$count++;
				  	# code...
				}
				if(!isset($logout)){
					if($count<=0){
						echo "You do not have any Docs. Why not <a href='/books/write/'>Create One!</a>";
					} else{
						echo "<br><a href='/books/write/'>Start</a> a new Doc!<br>";
					}
				} else {
					echo "<br><a href='/books/write/'>Create</a> a new Doc yourself!<br>";
				}
				?>
				
				
			</ol>
		</div>
		<div id="contents_profile_right">
			<strong>Docs <?php if(!isset($logout)){echo "I've"; } else { echo ucfirst($User->UserName)."'ve";} ?>  Edited</strong>
			<ol>
				<?php 
				$currentBooks = array();
				$count = 0;
				foreach ($EditedBooks as $key => $value) {
					if(in_array($value->BookId, $currentBooks)) continue;
					if(in_array($value->BookId, $myBooksArray)) continue;
					$currentBooks[] = $value->BookId;
					echo "<li><a href='/books/see/".$value->BookId."'>".$value->BookTitle."</a></li>";
					$count++;
				}
				if($count<=0) echo "Whoa! You have not edited any books!";
				?>

			</ol>
		</div>
	</div>
	
</div>