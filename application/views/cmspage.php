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

	<script>
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
	</script>
</head>
<body>
<div>
<div class="header">
	<div id="logo"><img src="http://shoppix.co.il/asset/img/logo2.png" alt="Zeni" id="imglogo"></div>
</div>
	<nav class="clearfix">
		<ul class="clearfix">
			<li><a href='<?php echo site_url('controlpanel/messages')?>'>הודעות ופניות</a></li>
			<li><a href='<?php echo site_url('controlpanel/reports')?>'>דוחות</a></li>
			<li><a href='<?php echo site_url('controlpanel/setting')?>'>הגדרות</a></li>
			<li><a href='<?php echo site_url('controlpanel/adv')?>'>ניהול באנרים</a></li>
			<li><a href='<?php echo site_url('controlpanel/coupons')?>'>קופוני שיתוף</a></li>
			<li><a href='<?php echo site_url('controlpanel/discounts')?>'>הנחות ומבצעים</a></li>
			<li><a href='<?php echo site_url('controlpanel/products')?>'>מוצרים</a></li>
			<li><a href='<?php echo site_url('controlpanel/storeInfo')?>'>פרטי העסק</a></li>
		</ul>
		<a href="#" id="pull">תפריט</a>
	</nav>
		<?php echo $output; ?>
</div>

</body>
</html>
