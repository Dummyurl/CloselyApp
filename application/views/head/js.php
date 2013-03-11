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

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){	
		

			
			$('.navigation-bubble').hoverIntent(overme,outme);
			function overme(){ $(this).css('display','block');}
			function outme(){ $(this).css('display','none');}
			
			$('.summery-type[rel=1]').addClass('overli');
 			$('.summery-type').hoverIntent(overli,outli);
			var triangleLeft = {};
			triangleLeft = $('.infobox-container .triangle-l').position();
			
			function overli(){
				$(this).addClass('overli')
				var triangle = $(this).attr('rel');
				switch(triangle)
				{
					case "1": $('.infobox-container .triangle-l').css('left','223px') ;
					break;
					case "2": $('.infobox-container .triangle-l').css('left','127px');
					break;
					case "3": $('.infobox-container .triangle-l').css('left','32px');
					break;
				}
        
			 }
	 
			function outli(){
				$(this).removeClass('overli');
				$('.infobox-container .triangle-l').css('left',triangleLeft.left) ;
			}


			
			<?php if($fb_data['me']): ?>
			 $('#panel').hoverIntent(openpanel,closepanel);
			function openpanel(){$(this).animate({height:180},200);$('.panel_contant').css('display','block');}
			function closepanel(){ $(this).animate({height:44},200);$('.panel_contant').css('display','none');}
			<?php endif; ?>
		

	
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
