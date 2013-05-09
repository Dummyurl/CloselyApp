<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){

	var warpperWidth = $("#tabs ul").width();
	console.log(warpperWidth);
		var sumWidth = 0;
		var lastBox;
		var rel = 1;
		$("#tabs li").each(function() {
			$(this).attr("sub",rel);
			var beforAdd = sumWidth;
			sumWidth += $(this).outerWidth();
			if(warpperWidth<sumWidth){
				var adding = warpperWidth-beforAdd;
				lastBox = $('#tabs li[sub="' +(rel-1)+'"]');
				lastBox.width(lastBox.width()+adding);
				sumWidth = $(this).outerWidth();
			}
			rel++;	
		});
		var last =$('#tabs li[sub="' +(rel-1)+'"]');
		adding = warpperWidth-sumWidth;
		var newLastWidth = last.outerWidth()
		last.outerWidth(newLastWidth+adding);
 }); 
</script>
</head>
<body>
<div class="header">
<div id="logo"><img src="http://shoppix.co.il/asset/img/logo2.png" alt="Zeni" id="imglogo"><div>
		<div id="tabs">
			<ul>
				<li id="info">פרטי העסק</li>
				<li id="products">מוצרים</li>
				<li id="discounts">הנחות ומבצעים</li>
				<li id="banners">ניהול באנרים</li>
				<li id="settings">הגדרות</li>
				<li id="reports">דוחות</li>
				<li id="messages">הודעות</li>
			</ul>
		</div> 
		<?php echo $output; ?>
    </div>
</body>
</html>
