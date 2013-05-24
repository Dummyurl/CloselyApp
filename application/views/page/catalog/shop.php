<?php $this->load->helper('url'); ?>
<link rel="stylesheet" media="all" href="<?php echo base_url();?>asset/css/jquery.thumbnailScroller.css"/>
<div class="shop_page_container">
	<div class="left_title">
		<div class="add_recommand">הוסף המלצה<img src="<?php echo base_url();?>asset/img/add.png" /></div>
		<a href="<?php echo base_url();?>user/popup/<?php echo $info->user_id ?>" class="fancybox"><img src="https://graph.facebook.com/<?php echo $info->user_id ?>/picture"/></a>
		<h1><?php echo $info->shop_title; ?></h1>

	</div>	
	<div class="content">
		<div class="top_content">
			<div class="image_box">
				<?php  ?>
				<img src="<?php echo base_url();?>asset/img/store/<?php echo $storeId .'/'. $mainProduct->product_image ?>"/>
				<?php if($mainProduct->price) : ?>
					<div class="product_price"><?php echo '₪' . $mainProduct->price ?></div>
				<?php endif ?>
			</div>
			<div class="top_left">
				<div class="product_slider">
					<div class="header">פריטים שנרכשו בקנייה זו</div>
					<div class="triangle"></div>
					<div id="slider" class="jThumbnailScroller">
						<div class="jTscrollerContainer">
							<div class="jTscroller" id="cycleSlide">
							<?php foreach($shopProducts as $product) : ?>
								<a  href="#" onclick="return false;"><img class="shopproduct" id="<?php echo $product->product_id ;?>" src="<?php echo base_url();?>asset/img/store/<?php echo $storeId .'/'. $product->product_image ?>"/></a>	
							<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
				<div class="shop_owner">
				</div>
			</div>
		</div>
		<div class="middle_content">
			<div class="product_details">
				<div class="header"><?php echo $mainProduct->product_name ?></div>
				<div class="triangle"></div>
				<div class="description"><?php echo $mainProduct->description ?></div>
			</div>
		</div>
		<div class="footer_content">
			<div class="coupon_box">
				<div class="header">קופון מהקנייה</div>
				<div class="triangle"></div>
				<div class="coupon"><?php $this->load->view('blocks/singlebanner',$coupon); ?></div>
			</div>
			<div class="adv">
				<div class="header">פרטי העסק</div>
				<div class="triangle"></div>
									<div class="contentblock">
					<ul class="store_info_list">
						<li class="info_row">
							<div class="tag">:שם העסק</div>
							<div class="detial"><?php echo $store->store_name;?></div>
						</li>
						<li class="info_row">
							<div class="tag">:כתובת</div>
							<div class="detial"><?php echo $store->store_address;?></div>
						</li>
						<li class="info_row">
							<div class="tag">:טלפון</div>
							<div class="detial"><?php echo $store->phone; ?></div>
						</li>
						<li class="info_row">
							<div class="tag">:אתר</div>
							<div class="detial"><?php echo $store->website; ?></div>
						</li>
						<li class="info_row">
							<div class="tag">:שעות פעילות</div>
							<div class="detial"><?php echo $store->time_working; ?></div>
						</li>
					</ul>

					</div>

			</div>
			<div class="comments">
				<?php $this->load->view('blocks/shop_comments_template',$blocks); ?>
			</div>

		</div>
	</div>
</div>	
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
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
	
		
	$('.shopproduct').click(function(){
		var src = $(this).attr('src');
		$('.image_box img').fadeOut('slow', function(){
			$('.image_box img').attr("src", src);
			$('.image_box img').fadeIn('slow');
		});
		url = '<?php echo base_url();?>' + 'catalog/getProduct';
		
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'id=' + $(this).attr('id') + '&store=' + '<?php echo $storeId ?>',
				dataType: 'json',				
				success: function(res) {
				var product = res; 
				console.log(product.description);
					 $(".description").html(product.description);
					 $(".product_details .header").html(product.product_name); 
					 if(product.price != 0){
						$(".product_price").show();
						$(".product_price").html('₪' + product.price); 
					 } else {
						$(".product_price").hide();
					 }
					 
					}
					 
				});		
	});
 }); 
</script>
