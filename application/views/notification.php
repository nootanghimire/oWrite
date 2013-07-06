<div id="contents">
	<div id="content_search">
		<h3>Notifications</h3></div>
		<hr>
	<div id="tags">
<?php
	if(isset($notifications)){
		if(count($notifications)<=0){ ?>No notifications!! <br> This is either coolness, or lonliness ;) <?php
		}
		echo "<ul id=\"tag_show\">";
		foreach ($notifications as $key => $notification) {
			echo "<a href=\"notifications/seen/".$notification->NotifyId."/".$notification->NotifyClickLink."\"><li>".$notification->NotifyFor." on ".date('L, f Y', $notification->NotifiedOn)."</li></a>";
		}
		echo "</ul>";
	} else {
		echo "Whoa! It seems that you are not enjoying this site! Why? Do something!";
	}
?>
