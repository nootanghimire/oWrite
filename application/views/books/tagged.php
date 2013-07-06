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
#content_s_list ul a {
	text-decoration: none;
	color: inherit;
}
</style>
<div id="contents">
	<div id="content_search">
		<h3><?php if($tag=="") {echo "All Docs!";} else {echo "Docs tagged in ".$tag;}?></h3></div>
	<hr>
	<div id="content_s_list">
		<ul>
			<?php 
			foreach ($Books as $key => $datum) {
				echo "<a href='/books/see/".$datum->BookId."'><li>".$datum->BookTitle."</li></a>\r\n";
				
			}
			?> 
		</ul>
	</div>