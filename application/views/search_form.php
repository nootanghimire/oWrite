<div id="contents" style="margin-left:10%;width:80%">
	<div id="content-search">
		<span style="color:#dd4814;font-size:25px;font-weight:bold;">Explore oWrite</span><br>		
		<input placeholder="Type to search.." name="search" id="contents_input" type="text" size="60" style="width:80%;"/>
		<div type="search" style="margin-left:65%;margin-top:-48px;" onclick="window.location = '/books/search/'+document.getElementById('contents_input').value;" id="sub_btn" style="border:none;">Search</div>
	</div>
	<br>
	<hr>
	<div id="tags">
		<span style="color:#dd4814;font-size:25px;font-weight:bold;">Tags</span><br>
		<ul id="tag_show">
 			<?php
				//assume every variable is set
				foreach ($tags as $key => $tag) {
					echo "<a href='/books/tagged/".$tag->tag_name."'><li><strong>".$tag->tag_name."</strong><span style='font-size:15px;'> x ".$tag->tag_used."</span></li></a>\r\n";
				}
			?> 
			<!-- <li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li>
			<li>Sample1</li> -->
		</ul>
	</div>

</div>