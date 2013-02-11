		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- JS -->
		<script src="<?php echo base_url();?>asset/js/jquery-1.6.4.min.js"></script>
		<script src="<?php echo base_url();?>asset/js/css3-mediaqueries.js"></script>
		<script src="<?php echo base_url();?>asset/js/tabs.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<!-- include Cycle plugin -->
		<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js"></script>
		<script src="<?php echo base_url();?>asset/js/facebook.js"></script>
		 <script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.oembed.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/wall.js"></script>
		
				<!-- Tweet -->
		<script src="<?php echo base_url();?>asset/js/tweet/jquery.tweet.js" ></script> 
		<!-- ENDS Tweet -->
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/easySlider1.7.js"></script> 
		<!-- superfish -->
		<script  src="<?php echo base_url();?>asset/js/superfish-1.4.8/hoverIntent.js"></script>
		<script  src="<?php echo base_url();?>asset/js/superfish-1.4.8/superfish.js"></script>
		<script  src="<?php echo base_url();?>asset/js/superfish-1.4.8/supersubs.js"></script>
		<!-- ENDS superfish -->
		<script src="<?php echo base_url();?>asset/js/custom.js"></script>
		<!-- prettyPhoto -->
		<script  src="<?php echo base_url();?>asset/js/prettyPhoto/jquery.prettyPhoto.js"></script>
		<!-- ENDS prettyPhoto -->
		
		<!-- poshytip -->
		<script  src="<?php echo base_url();?>asset/js/poshytip-1.1/src/jquery.poshytip.min.js"></script>
		<!-- ENDS poshytip -->
		
		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,300' rel='stylesheet' type='text/css'>
		
		<!-- Flex Slider -->
		<script src="<?php echo base_url();?>asset/js/jquery.flexslider-min.js"></script>
		<!-- modernizr -->
		<script src="<?php echo base_url();?>asset/js/modernizr.js"></script>
		
		<script type='text/javascript'>
		$(function(){
		  var prev;    
		  $('.button').hover(function(){
		  prev = $('.description_box').html();
			  $('.description_box').html(this.id);
		  }, function(){
			  $('.description_box').html(prev);
			  	$('.description_box').cycle({
					fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
				});
		  });
		})
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.description_box').cycle({
					fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
				});
			});
		</script>
		
<script type="text/javascript">
$(document).ready(function(){
	$('.bt-top').click(function() { 
		$('.bt-top').each(function() {
			$(this).attr("src","<?php echo base_url();?>asset/img/bt.png");
		});
		var id = $(this).attr("id");
		var src = "<?php echo base_url();?>asset/img/" + id + "-bt.png";
		$('#'+id).attr("src", src);
	});
});
</script>
		
			<script type="text/javascript">
			console.log('fff');
			$("#slider").easySlider({
				auto: true,
				continuous: true,
				nextId: "slider1next",
				prevId: "slider1prev"
			});
	</script>	
	
	<script type="text/javascript">
			$(document).ready(function(){
				$('.boxgrid.slidedown').hover(function(){
					$(".cover", this).stop().animate({top:'-260px'},{queue:false,duration:300});
				}, function() {
					$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:300});
				});
			});
		</script>