<style type="text/css">
/*
body {margin:0;border:0;padding:0;font:11pt sans-serif}
body > h1 {margin:0 0 0.5em 0;font:2em sans-serif;background-color:#def}
body > div {padding:2px}
p {margin-top:0}
*/
ins {color:green;background:#dfd;text-decoration:none}
del {color:red;background:#fdd;text-decoration:none}
#params {margin:1em 0;font: 14px sans-serif}
.panecontainer > p {margin:0;border:1px solid #bcd;border-bottom:none;padding:1px 3px;background:#def;font:14px sans-serif}
.panecontainer > p + div {margin:0;padding:2px 0 2px 2px;border:1px solid #bcd;border-top:none}
.pane {margin:0;padding:0;border:0;width:100%;min-height:30em;overflow:auto;font:12px monospace}
.diff {color:gray}
</style>

<div id="contents" style="opacity:1;">
	<div id="contents_book">
		<h2>Displaying Edits </h2><?php if($isCurrentUserBook) { ?> <a href="/edits/approve/<?=$editId?>" style="margin-left:100px;color:#01a2e8;font-size:18px;">Approve Edit</a> | <a href="javascript:history.go(-1);" style="color:#01a2e8;font-size:18px;">Cancel</a><?php } ?>
		<?php if(!$isCurrentUserBook) { ?> <a href="javascript:history.go(-1);" style="margin-left:100px;color:#01a2e8;font-size:18px;">Go Back</a><?php } ?>
		
		<div id="wmd-editor" class="wmd-panel" style="margin-top:-20px;display:none;">
			<div id="wmd-button-bar"></div>
			<textarea id="wmd-input"><?=$difference?></textarea>
		</div>
		<div id="wmd-preview" class="wmd-panel justifyoverride"  style="font-family: Georgia, Sans-Serif;">Preview</div>
		<br>
		<?php if($isCurrentUserBook) { ?> <a href="/edits/approve/<?=$editId?>" style="margin-left:100px;color:#01a2e8;font-size:18px;">Approve Edit</a> | <a href="javascript:history.go(-1);" style="color:#01a2e8;font-size:18px;">Cancel</a><?php } ?>
		<?php if(!$isCurrentUserBook) { ?> <a href="javascript:history.go(-1);" style="margin-left:100px;color:#01a2e8;font-size:18px;">Go Back</a><?php } ?>
	</div>

</div>
<script type="text/javascript" src="/js/wmd/showdown.js"></script>
<script type="text/javascript" src="/js/wmd/wmd.js"></script>
