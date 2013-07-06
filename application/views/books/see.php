<script type="text/javascript">
document.ready=function(){

(function(){
	document.getElementById('vote_up').onclick= function(){
		Vote(1,<?=$Book->BookId?>);
	}

	document.getElementById('vote_down').onclick = function(){
		Vote(0,<?=$Book->BookId?>);
	}
}());
function Vote(type, id){
	params = "bookId="+id+"&voteType="+type;
	var Ajax = createAjax();
	Ajax.onreadystatechange = function(){
		if(Ajax.status==200 && Ajax.readyState==4){
			if(Ajax.responseText == 'x') {
				alert('There was an error! Perhaps you are not logged on! Or already voted!')
				return;
			}
			document.getElementById('vup_num').innerHTML = Ajax.responseText;
		}
	}
	Ajax.open('POST', '/books/vote', true);
	Ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	Ajax.send(params);
}
}
</script>
<style type="text/css">
#vote{
	float:right;
	padding-right: 100px;
}
</style>
<div id="contents" style="opacity:1;">
	<div id="contents_book">
		<h2><?=$Book->BookTitle?> 
			
			<br>
			<span style="font-size:18px;">By</span> <a href="/user/profile/<?=$Book->BookAuthor?>" style="color:#01a2e8;font-size:18px;"><?=$Book->BookAuthor?></a> | <a href="/books/edit/<?=$Book->BookId?>" style="color:#01a2e8;font-size:18px;">Edit</a> | <a href="/edits/for/<?=$Book->BookId?>" style="color:#01a2e8;font-size:18px;">View All Edits</a>
			<div id="vote">
				<img id ="vote_up" src="/static_img/yes.png" onmouseover="this.src='/static_img/yes_h.png'" onmouseout="this.src='/static_img/yes.png'"> <span id ="vup_num" style="font-size:18px;"><?=$votes;?></span> 
				<img id ="vote_down" src="/static_img/no.png" onmouseover="this.src='/static_img/no_h.png'" onmouseout="this.src='/static_img/no.png'">
			</div>
			<br>
			<span style="color:#999;font-size:15px;font-weight:lighter;">Tags: <?=$Book->tags?></span>
		</h2>
		<div id="wmd-editor" class="wmd-panel" style="margin-top:-20px;display:none;">
			<div id="wmd-button-bar">
			</div>
			<textarea id="wmd-input"><?=$Book->Content?></textarea>
		</div>
		<div id="wmd-preview" class="wmd-panel justifyoverride" style="font-family: Georgia, Sans-Serif;">Preview
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/wmd/showdown.js"></script>
<script type="text/javascript" src="/js/wmd/wmd.js"></script>
