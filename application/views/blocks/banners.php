<div class="main_cupon-3">
<div class="block_title_container">
	<div class="double_grey_single_divider"></div>	
	<div class="block_title">...קופונים אחרונים</div>
	<div class="triangle_blocks "></div>
	<div class="double_grey_double_divider"></div>
</div>
<div id="slider">	
<?php $i = 0; ?>	
			<ul>
			<?php foreach ($coupons as $coupon) : ?>
			<?php $storeInfo = $this->catalog_model->getStoreInfo($coupon->store_id) ?>
			<?php $shopInfo = $this->catalog_model->getShopInfo($coupon->shop_id) ?>
			<?php $userInfo = $this->coupons_model->getUserInfo	($coupon->user_id) ?>
			<?php $i++; ?>	
				<?php if ($i%3 == 1 ) :?>
				<li>
				<?php endif ?>		
					<div class="boxgrid slidedown">
						<div class="cover">
							<div class="sale_type"><?php echo $coupon->type ?></div>
							<div class="triangle-l "></div>
							<div class="triangle-small "></div>
							
							<div class="sale_content">
								<div class="sale_title"><?php echo $coupon->coupon_name ?></div>
								<div class="sale_description"><?php echo $coupon->description ?></div>
							</div>
							<div class="clearfix"></div>
							<div class="sale_store_logo"><img src="<?php echo base_url() . 'asset/img/bizlogos/' . $storeInfo[0]->store_logo  ?>"/></div>
							<div class="sale_status">
								<div class="state"><?php echo $coupon->expierement ?> :עד</div>
								<div class="triangle"></div>
							</div>
							<div class="cutoff"><img src="<?php echo base_url();?>asset/img/cutoff.png"/></div>
						</div>
						<div class="coupon_over">
							<img src="https://graph.facebook.com/<?php echo $coupon->user_id ?>/picture"/>
							<div class="coupon_shop"><?php echo ':הקנייה </br>' .  $shopInfo[0]->shop_title ?></div>
							<div class="clearfix"></div>
							<p class="coupon_adder"><?php echo $userInfo[0]->user_name  . ' :נוסף ע"י'?></p>
							<div class="ask_for_coupon" id="<?php echo $coupon->coupon_id ?>">בקש קופון</div>
							<a href="<?php echo base_url() . 'catalog/shop/' . $coupon->shop_id;?>"><div class="shop_info">פרטי הקנייה</div></a>
						</div>
					</div>	
				<?php if ($i%3 == 0 ) :?>
				</li>
				<?php endif ?>
			<?php endforeach ?>
			</ul>
		</div>
</div>	

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
				
				
				$('.ask_for_coupon').click(function(){
					var couponId = $(this).attr('id');
					url = '<?php echo base_url();?>' + 'catalog/requastCoupon';
					// $.fancybox.showActivity();
/* 					$.ajax({  
							type: "POST",  
							url: url, 
							cache	: false,
							data:  {userId: '<?php echo $userId ?>' , couponId: couponId},
							success: function(html) {
								$.fancybox(html);
							}	 
						}); */		
						
 				$.fancybox(
					{
						autoSize:false,
						href : url + '?couponId=' + couponId,
						width:400,
						height:360,
						scrolling:'no',
						padding:0,
						closeBtn: false,
						type : 'iframe',
					}); 
					return false;	
				});
			});		
			
			

</script>