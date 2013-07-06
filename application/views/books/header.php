<html>
<head>
	<title>oWrite - Contribute</title>
<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/css/footer.css" />
	<link rel="stylesheet" type="text/css" href="/css/contents.css" />
	<link rel="stylesheet" type="text/css" href="/css/class.css" />
	<script type="text/javascript"  src="/js/script.js"></script>
	
</head>
<body>
	<div id="wrapper">
		<div id="temp2" style="display:none;opacity:0;color:white !important;">
			<div id="exitdonotdisturb2" style="position:absolute;left:50px;text-decoration:none;cursor:default;">Doc Title</div>
			<div id="exitdonotdisturb2" onmousedown="exitdonotdisturb('temp2')">Exit Read</div>
			<br>
			<div id="tempform">
				
			</div>
		</div>
		<div id="popup_hint" style="">
			<span>
				Hey there! You have been idle for a while now! Do you need any <a>help</a>?
			</span>
		</div>
		
		<div id="header"  >		
			<div id="header_login" onclick="toggle('loginbox');">
				<h3 style="margin:10px;">Login/Sign Up</h3>
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
			<div id="header_logo" onmouseover="toggle('header_info');" onmouseout="toggle('header_info');" onclick="window.location = 'index.php';">
				<h1 style="margin:10px;">oWrite</h1>
			</div>
			<div id="menu">
				<h3>Categories</h3>
			</div>
		</div>
		<div id="contents">