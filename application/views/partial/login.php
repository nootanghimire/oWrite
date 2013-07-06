<h3>Login:</h3>
				<hr>
				<form name="login" action="/user/login" method="post" id="login_form">

					<label for="username">Username:</label> <input type="text" name="user" class="input_box"  placeholder="Username" /><br>
					<label for="password">Password:</label> <input type="password" name="pass" class="input_box"  placeholder="Password" /><br>
					<input type="hidden" name="redirect_to" value="<?=(isset($redirect_to)) ? $redirect_to : ""?>"/>
					<div id="sub_btn" onclick="document.getElementById('login_form').submit();">Log In</div>
				</form>
				<div id="newuser">
					<a href="/user/first">New User? Sign Up!</a>
				</div>