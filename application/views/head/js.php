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
		<!-- side menu hoverinit -->
		<script src="<?php echo base_url();?>asset/js/jquery.hoverIntent.js"></script>
		<!-- tiny scrollbar-->
		<script src="<?php echo base_url();?>asset/js/jquery.mCustomScrollbar.concat.min.js"></script>

		<script>
			(function($){
				$(window).load(function(){
					$("#content_1").mCustomScrollbar({
						autoHideScrollbar:true,
						theme:"light-thin"
					});
				});
			})(jQuery);
		</script>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){	
		
			$('.shop_image').hoverIntent(overimg,outimg);
			 function overimg(){ $(this).addClass('over-img-photo')}
			 function outimg(){ $(this).removeClass('over-img-photo')}
			
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

			$("a.button").hoverIntent({
				over: openMenu, 
				timeout: 200, 
				out: closMenu
			});
			
			 $('#panel').hoverIntent(openpanel,closepanel);
			function openpanel(){$(this).animate({height:220},200);}
			function closepanel(){ $(this).animate({height:44},200);}
			
			
	
		
		}); 

		
		function openMenu(){ 
			prev = $('.navigation-bubble').html();
			var position = $(this).position();
			var id = $(this).attr('id');
			$('.navigation-bubble').fadeIn('slow');
			$(".navigation-bubble").css("top",position.top)
			$(".navigation-bubble").css("left",position.left-340)
			$('.bubble-top .btn_txt').text($("#"+id+' p').text());
		}
		function closMenu(){ 
			$('.navigation-bubble').hide();
		}
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
			$(document).ready(function(){
			 
				$("#slider").easySlider({
					auto: true,
					continuous: true,
					nextId: "slider1next",
					prevId: "slider1prev",
					hoverpause: true 
				});
				$('.boxgrid.slidedown').hover(function(){
					$(".cover", this).stop().animate({top:'-260px'},{queue:false,duration:530});
				}, function() {
					$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:530});
				});
			});
</script>