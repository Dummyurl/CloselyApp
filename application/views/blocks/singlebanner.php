
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
							<div class="sale_store_logo"><img src="<?php echo base_url() . 'asset/img/bizlogos/' . $store->store_logo  ?>"/></div>
							<div class="sale_status">
								<div class="state"><?php echo $coupon->expierement ?> :עד</div>
								<div class="triangle"></div>
							</div>
							<div class="cutoff"><img src="<?php echo base_url();?>asset/img/cutoff.png"/></div>
						</div>
						<div class="coupon_over">
							<img src="https://graph.facebook.com/<?php echo $coupon->user_id ?>/picture"/>
							<div class="coupon_shop"><?php echo ':הקנייה </br>' .  $shop->shop_title ?></div>
							<div class="clearfix"></div>
							<p class="coupon_adder"><?php echo $user  . ' :נוסף ע"י'?></p>
							<div class="ask_for_coupon">בקש קופון</div>
							<div class="shop_info">פרטי הקנייה</div>
						</div>
					</div>	
				

<script type="text/javascript">
			$(document).ready(function(){
				$('.boxgrid.slidedown').hover(function(){
					$(".cover", this).stop().animate({top:'-260px'},{queue:false,duration:530});
				}, function() {
					$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:530});
				});
			});
</script>