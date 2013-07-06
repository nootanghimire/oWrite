<style type="text/css">
ul{
	background-color: #fff;
	box-shadow: 0 0 6px #848484;
	margin:0 auto;
	width: 90%
}
li {
	display: block;
	background-color: #fff;
	list-style-type: none;
	border-bottom: 1px solid #999;
	margin-left: -40px;
	padding:10px;
	font-size: 18px;
	padding-left: 30px;
	transition:all .25s ease;
	cursor: pointer;
}
li:hover{
	background-color: #01a2e8;
	color:#eee;
}
a:hover{
	text-decoration: none;
}
</style>
<div id="contents">
	<div id="content_search">
		<h5 style="font-weight:lighter;font-family:Verdana, Sans-Serif;">We found <?=$num_results?> results in <?=round($exec_time, 4)?> microseconds.</h5>
		<h3>Search Results for Title</h3>
	</div>
	<hr>
	<div id="content_s_list">
		<ul>
			<?php 
			foreach ($data['title'] as $key => $datum) {
				echo "<a href='/books/see/".$datum->BookId."' style='color:#01a2e8;'><li>".$datum->BookTitle."</li></a>";
				
			}
			?>
		</ul>
	</div>
	<hr>
	<div id="content_search">
		<h3>Search Results for Contents</h3>
	</div>
	<div id="content_s_list">
		<ul>
			<?php 
			foreach ($data['content'] as $key => $datum) {
				echo "<a href='/books/see/".$datum->BookId."' style='color:#01a2e8;'><li>".substr($datum->Content,0,60)."....</li></a>";
			}
			?>

		</ul>
	</div>
</div>