
			
			<div id="contents_search" style="margin-top:10px!important;">
				<h3>oWrite, your companion for collaborative writing...</h3>	
			</div>
			<div id="contents_main" style="margin-top:-10px;">
				<a href="index.php">Home</a> <span style="color:#00a2e8;"> >> </span><a href="categories.php">Categories</a> <span style="color:#00a2e8;"> >> </span> <a href="random.php">Random</a>
				
				<form name="myform"><label style="margin-top:15px;">Enter Title </label>
					<input name="title_txt" type="text" id="title" placeholder="Enter Title Here"/>
					<textarea name="main_txt"></textarea>
				</form>
				<div id="donotdisturb" onmousedown="fadein('temp');">Do Not Disturb<?php if(isset($db_pass)){echo "<br>Database:<br>".$db_pass . "<br><br>Actual: <br>". $act_pass; } ?></div>
				<br>
				<div id="submit_box">Save
				</div>
			</div>
		
		
