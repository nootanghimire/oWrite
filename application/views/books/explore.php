
<ul>
<?php
	foreach($books as $book){
		echo "<li><a href='/book/see/".$book->BookId."' style='color:#01a2e8;'>".$book->BookTitle."</a>";
	}


?>

</ul>
