<html>
<head>
	<title><?php if (isset($title)) {echo $title; }else{ ?>oWrite - Contribute<?php } ?></title>
	<link rel="icon" type="image/png" href="/static_img/favicon.png">
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/css/footer.css" />
	<link rel="stylesheet" type="text/css" href="/css/contents.css" />
	<script type="text/javascript"  src="/js/script.js"></script>
	<script type="text/javascript" src="/js/behaviour.js"></script>
	<script type="text/javascript" src="/js/jQuery/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="/js/jQuery/jquery.idle-timer.js"></script>
	<script type="text/javascript">
	$(function() {
		var timeout = 500000;
		$(document).bind("idle.idleTimer", function() {
			$("#popup_hint").fadeIn(400);
		});
		$(document).bind("active.idleTimer", function() {
			$(document).click(function(){
				$("#popup_hint").fadeOut(400);
			});
		});
		$.idleTimer(timeout);
	});

	</script>
	<script type="text/javascript" src="/js/wmd/showdown.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="popup_hint" style="">
			<span>
				Hey there! You have been idle for a while now! Do you need any <a>help</a>?
			</span>
		</div>
		<div id="temp" style="display:none;opacity:0;">
			<div id="tempinfo">oWrite - Distraction Free Writing Mode</div>
			<div id="exitdonotdisturb" onmousedown="exitdonotdisturb('temp')">Exit Do Not Disturb</div>
			<br>
			<form name="tempform">
				<textarea name="temp_txt"></textarea>
			</form>
		</div>
		<div id="header"  >		
			<div id="header_login" onclick="toggle('loginbox');">
				<h3 style="margin:10px;">--------</h3>
			</div>
			<div id="loginbox" style="display:none;">
				<h3>Login:</h3>
				<hr>
				<form name="login" action="" method="post">

					<label for="username">Username:</label> <input type="text" name="username" class="input_box"  placeholder="Username" /><br>
					<label for="password">Password:</label> <input type="password" name="password" class="input_box"  placeholder="Password" /><br>

					<div id="sub_btn">Log In</div>
				</form>
				<div id="newuser">
					<a href="signup.php">New User? Sign Up!</a>
				</div>
			</div>
			<div id="header_info" style="display:none; margin-top:-10px;">Collaborate to elaborate!&nbsp; &nbsp;</div>
			<div id="header_logo" onmouseover="toggle('header_info');" onmouseout="toggle('header_info');" onclick="window.location = '/';">
				<h1 style="margin:10px;">oWrite</h1>
			</div>
			<div id="menu" onclick="location.href='/books/explore/'">
				<h3>Explore</h3>
			</div>
		</div>
		<div id="contents">