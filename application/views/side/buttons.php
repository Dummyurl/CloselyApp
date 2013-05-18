					<div id="headline">	
						<div class="navigation-bubble">
							<div class="bubble-top"><p class="btn_txt"></p></div>
							<div class="bubble-center">
							<img id="loading-image" src="<?php echo base_url();?>asset/img/ajax-loader.gif" />
							</div>	
							<div class="bubble-bottom"></div>	
						</div>	
						<?php $i = 0; ?>
						<?php foreach ($categories as $category) : ?>
						<?php $i++; ?>
						
							<?php if ($category->parent_id == 0) : ?>
							<?php $catId =  'b' . $category->category_id ?>
							<?php $catName = $category->category_name ?>
							<?php if ($i%2 == 1 ) :?>
								<div class="mainbutton">
							<?php endif ?>
								<span class="left"><a href="<?php echo base_url();?>catalog/category/<?php echo $category->url ?>" class="button" id="<?php echo $catId ?>"><img src="<?php echo base_url();?>asset/img/buttons/<?php echo $catId ?>.png" alt="alt text" /><p><?php echo $catName ?></p></a></span>
							<?php if ($i%2 == 0 ) :?>
								</div>
							<?php endif ?>

							<?php endif ?>
						<?php endforeach ?>
		        		<em id="corner"></em>
						
		        	</div>
					
<script type="text/javascript">
jQuery(document).ready(function($){					
			
	$("a.button").hoverIntent({
		over: openMenu, 
		timeout: 200, 
		out: closMenu
	});
			
	function openMenu(){ 
		prev = $('.navigation-bubble').html();
		var position = $(this).position();
		var id = $(this).attr('id');
		url = "<?php echo base_url();?>" + 'catalog/categoryinfo/' + id.substring(1, 2);
		
		try {			
		$.ajax({
			type: 'POST',    
			url:url,
			beforeSend: function() {
              $("#loading-image").show();
           },
			success: function(msg){	
				 $("#loading-image").hide();
				 $('.bubble-center').html(msg);
				 if ($('.categories_list').outerWidth() == 0 ){
					$('.bubble-center').height(80);
					$('.categories_list').html('<div style="color:black;text-align:center">לא קיימות תתי קטגוריות</div>');
				} else {
					$('.bubble-center').height($('.categories_list').outerWidth());
				}
			}
		});

		} catch (e) {

		}
		$('.navigation-bubble').fadeIn('slow');
		$('.bubble-center').html('<img id="loading-image" src="' + '<?php echo base_url();?>' + 'asset/img/ajax-loader.gif" />');
		$(".navigation-bubble").css("top",position.top)
		$(".navigation-bubble").css("left",position.left-340)
	    $('.bubble-top .btn_txt').text($("#"+id+' p').text());
	}
	function closMenu(){ 
		$('.navigation-bubble').hide();
	}

});
</script>