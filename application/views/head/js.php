		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- JS -->

		<script src="<?php echo base_url();?>asset/js/css3-mediaqueries.js"></script>
			<!-- <script src="<?php echo base_url();?>asset/js/tabs.js"></script> -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<!-- include Cycle plugin -->
		<script src="<?php echo base_url();?>asset/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js"></script>
		 <script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.oembed.js"></script>
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
		<!-- side menu hoverinit -->
		<script src="<?php echo base_url();?>asset/js/jquery.hoverIntent.js"></script>
		<!-- tiny scrollbar-->
		<script src="<?php echo base_url();?>asset/js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.mousewheel.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.jscrollpane.min.js"></script>
		<!-- Fancybox -->
		<script type="text/javascript" src="<?php echo base_url();?>asset/fancybox/jquery.fancybox.pack.js"></script>
		<!-- Fancybox slider -->
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery-ui-1.8.13.custom.min.js"></script>
		<!-- Fancybox slider -->
		<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.thumbnailScroller.js"></script>

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){	
		

			
			$('.navigation-bubble').hoverIntent(overme,outme);
			function overme(){ $(this).css('display','block');}
			function outme(){ $(this).css('display','none');}
			
			

			
			<?php if($fb_data['me']): ?>
			 $('#panel').hoverIntent(openpanel,closepanel);
			function openpanel(){$(this).animate({top:6},600);$('.panel_contant').css('display','block');}
			function closepanel(){ $(this).animate({top:-135},600);$('.panel_contant').css('display','none');}
			<?php endif; ?>
		


			$(".fancybox").fancybox({
				'width':'60%',
				 'minHeight':500,
				 'autoHeight':true,
				 'scrolling':'no',
				 'scrollOutside':false,
				 'autoDimensions':false,
				 'autoScale' : false,
				 'transitionIn' : 'none',
				 'transitionOut' : 'none',
				 'type' : 'iframe'
			}); 
		}); 


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
