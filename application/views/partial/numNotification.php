<?php
	if(!isset($num)){?> Whoa! Cool, No notices :) <?php }
	else {
		if($num<=0){
			?> Whoa! Cool, No notices :) <?php  exit();
		}
?>
<a href="/notifications">Click to see your <?=$num?> notification(s).</a>

<?php
}
?>