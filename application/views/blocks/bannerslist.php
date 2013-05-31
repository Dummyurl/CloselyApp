<?php $this->load->helper('url'); ?>
<div class="coupons_grid">
<div id="slider">	
<?php $i = 0; ?>	
			<ul>
			<?php foreach ($coupons as $coupon) : ?>
			<?php $storeInfo = $this->catalog_model->getStoreInfo($coupon->store_id) ?>
			<?php $shopInfo = $this->catalog_model->getShopInfo($coupon->shop_id) ?>
			<?php $userInfo = $this->coupons_model->getUserInfo	($coupon->user_id) ?>
				<li>	
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
							<div class="ask_for_coupon">בקש קופון</div>
							<a href="<?php echo base_url() . 'catalog/shop/' . $coupon->shop_id;?>"><div class="shop_info">פרטי הקנייה</div></a>
						</div>
					</div>	
				</li>
			<?php endforeach ?>
			</ul>
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