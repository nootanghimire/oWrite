<html>
<head>
	<title>oWrite - Contribute</title>
	<link rel="stylesheet" type="text/css" href="/css/index.css" />
	<link rel="icon" type="image/png" href="/static_img/favicon.png">
	
	<script type="text/javascript" src="/js/behaviour.js"></script>
	<script type="text/javascript" src="/js/jQuery/jquery-1.10.1.min.js"></script>
	
	<style>
	#top-msg-popup{
		background-color: #dd1414 !important;
		height: auto;
		padding-top: 5px;
		padding-bottom: 10px;
		color:#fff;
		box-shadow: inset 0 -25px 25px #111;
		position: static;
		top:0px;
		text-align: center;
		cursor: pointer;
		-webkit-user-select:none;
		-moz-user-select:none;
		transition:2s;
		width: 100%;
		margin:0 auto;
	}
	</style>
</head>
<body style="overflow: hidden">


	<?php
	if(isset($passwordWrong)){
		if($passwordWrong){
			?>
			<div style="background:#111;"><div id="top-msg-popup" onclick="disappearlong(this);">Oops! Perhaps you have mistyped your username and/or password! Correct it! (Click to dismiss)</div></div>
			<?php

		}
	}
	?>
	<div id="wrapper">	


		<div id="header">

			<div id="header_left">
				<p class="main_txt">oWrite</p>
				<p class="sec_txt">Collaborate to elaborate</p>
			</div>
			<div id="header_right">
				<div id="login_box">
					<span style="font-size:20px;color:#111;margin-left:15px;">Login</span>
					<form id="login-form" name="login-form" action="/user/login/" method="post" enctype="multipart/form-data" onKeyPress="submitOnEnter(this, event);">
						<p><input type="text" placeholder="Username" name="user" required>
							<script type="text/javascript" src="/js/jQuery/jquery-1.10.1.min.js"></script>						<input type="password" placeholder="Password" name="pass" required></p>
							<div id="sub_btn" onclick="document.forms['login-form'].submit();" style="font-size:22px;padding:0px !important;top:-10px;">Login</div>
						</form>
					</div>
				</div>
			</div>
			<div id="contents">
				<div id="contents_left">
					<p class="heading1">Why oWrite?</p>
					<ul id="list">
						<li>Write your own document </li>
						<li>Read and contribute to others' writings </li>
						<li>Let others contribute to your writings </li>
						<li><a href="/books/explore" style="color:#01a2e8;">Explore Docs</a> or <a href="/books/see/17" style="color:#01a2e8;">Learn More..</a></li>
					</ul>
				</div>
				<div id="contents_right">
					<div id="form-bg" draggable="true">
						<form id="myForm" method="post" action="/user/signup/" enctype="application/x-www-urlencoded" onKeyPress="submitOnEnter(this, event, true);">
							<div id="tempBtn" onmousedown="opacOn('form-bg');">
								<h2>Get Started</h2>
							</div>
							<p><input type="text" placeholder="Username" name="user" required /></p>
							<p><input type="password" placeholder="Password" name="pass" required /></p>
							<p><input type="email" placeholder="Email" name="email" required /></p>
						<!--input id="rememberme" class="css-checkbox" type="checkbox" />
						<label for="rememberme" name="rememberme" class="css-label">&nbsp;&nbsp;Remember Me</label>-->
						<div id="sub_btn" onclick="validateAndSubmit(document.forms['myForm']);">Sign Up!</div>
					</form>
					<!--p class="newuser">Not a member? <a href="signup.php">Sign Up!</a></p>-->
				</div>
			</div>
		</div>
		<div id="footer">
			<div id="footer_left">
				<p><a href="/">oWrite</a> | Developer's Circle | Copyright &copy; 2013</p>
			</div>
			<div id="footer_right">
				<p><a href="https://www.facebook.com/groups/developerscircle/">Facebook</a> | <a href="">Twitter</a> | <a href="">About Us</a> | <a href="">Contact Us</a></p>
			</div>
		</div>
	</div>
	<div id="popup-logout-message" style="display:none;">
		<div id="popup-msg-logout">
			Heading Out! We're gonna miss you here!! :( 
			<br>
			<span style="font-size:18px;font-weight:lighter;">(Click to dismiss)</span>
		</div>
	</div>
	<?php
	if(isset($LogoutMessage)){
		?>
		<script type="text/javascript">
		var obj = document.getElementById('popup-logout-message');
		obj.style.display = 'block';
		obj.onclick = function(){
			disappear(obj);
		}
		</script>
		<?php
	}
	?>
	<script type="text/javascript" src="/js/script.js"></script>
</body>
</html>
