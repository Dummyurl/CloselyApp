
<?php $this->load->helper('url'); ?>
<!doctype html>
<html class="no-js">	
	<head>
		<?php $this->load->view('head/meta'); ?>
		<?php $this->load->view('head/css'); ?>
		<script src="<?php echo base_url();?>asset/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.thumbnailScroller.js"></script>
		<link rel="stylesheet" media="all" href="<?php echo base_url();?>asset/css/jquery.thumbnailScroller.css"/>
	</head>	
	<body>
	<div class="popup">
		<div class="header">
		<div class="freind_cnt"><div class="cnt_bubble"><?php echo 0 ?></div><img src="<?php echo base_url();?>asset/img/cart.png"  /></div>
		<div class="freind_cnt"><div class="cnt_bubble"><?php echo 0 ?></div><img src="<?php echo base_url();?>asset/img/coupons.png"  /></div>
		<div class="freind_cnt"><div class="cnt_bubble"><?php echo 0 ?></div><img src="<?php echo base_url();?>asset/img/comment.png"  /></div>
		<div class="fav"></div>
		<div class="title">Jenai shtiev</div>
		<div class="triangle"></div>
		</div>
		<div class="content">
			<div class="user">
				<div class="picture"><img src="https://graph.facebook.com/1503580127/picture?type=large"  /></div>
				<div id="slider" class="jThumbnailScroller">
					<div class="jTscrollerContainer">
						<div class="jTscroller">
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img1.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img2.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img3.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img4.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img5.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img6.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img7.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img8.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img9.jpg" /></a>
							<a href="#"><img src="<?php echo base_url();?>asset/img/shops/img10.jpg" /></a>
						</div>
					</div>
				</div>
				<div class="user_info">
					<div class="block"><?php $this->load->view('blocks/user_clubs'); ?></div>
					<div class="block"><?php $this->load->view('blocks/user_last_coupons'); ?></div>
					<div class="block"><?php $this->load->view('blocks/user_last_recommands'); ?></div>
				</div>
			</div>
		</div>	
	</div>
	
	<script type="text/javascript">
jQuery.noConflict(); 
	/* calling thumbnailScroller function with options as parameters */
	(function($){
	window.onload=function(){ 
		$("#slider").thumbnailScroller({ 
			scrollerType:"hoverPrecise", 
			scrollerOrientation:"horizontal", 
			scrollSpeed:2, 
			scrollEasing:"easeOutCirc", 
			scrollEasingAmount:800, 
			acceleration:2, 
			scrollSpeed:800, 
			noScrollCenterSpace:10, 
			autoScrolling:0, 
			autoScrollingSpeed:2000, 
			autoScrollingEasing:"easeInOutQuad", 
			autoScrollingDelay:500 
		});
	}
	})(jQuery);
</script>
		
	
	</body>
</html>

