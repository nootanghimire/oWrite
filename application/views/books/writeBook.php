<div id="contents_search">
	<h3> Yay !  Start Writing ! </h3>	
</div>
<div id="wmd-editor" class="wmd-panel" style="margin-top:-20px;">
	<form name="books-save-form" id="books-save-form" action="/books/save" method="post">
		<input name="title" type="text" id="title" value="" placeholder="Enter Title" style="height:30px;width:100%;margin-bottom:-5px;border:1px solid #01a2e8;"/>

		<div id="wmd-button-bar"></div>
		<textarea id="wmd-input" name="content"></textarea>
		<input name="tag" type="text" id="tag" value="" placeholder="eg. fiction, thriller, science" style="height:30px;width:100%;margin-bottom:-5px;border:1px solid #01a2e8;"/>
	</form>
</div>
<br>
<div id="sub_btn" style="position:relative;left:80%;margin-top:-30px;" onclick="document.forms['books-save-form'].submit();">Create
</div>
<span style="font-size:20px;margin-left:100px;">Preview</span><hr>
<div id="wmd-preview" class="wmd-panel" style="text-align:justify;">Preview</div>

<br>

<hr style="opacity:0;">
			<!--
			<div id="contents_main" style="margin-top:-10px;">
				<form name="myform">
					<input name="title_txt" type="text" id="title" placeholder="Enter Title"/>
					<textarea name="main_txt"></textarea>
				</form>
				<div id="donotdisturb" onmousedown="fadein('temp');">Do Not Disturb</div>
				<br>
				<div id="sub_btn" style="position:relative;left:78.5%;margin-top:-20px;">Save
				</div>
				<hr style="opacity:0;">
			</div>-->
			<script type="text/javascript" src="/js/wmd/showdown.js"></script>
			<script type="text/javascript" src="/js/wmd/wmd.js"></script>