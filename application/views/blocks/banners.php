<div class="main_cupon-3">
<div class="block_title_container">
	<div class="double_grey_single_divider"></div>	
	<div class="block_title">...קופונים אחרונים</div>
	<div class="double_grey_double_divider"></div>
</div>
<div id="slider">	
<?php $i = 0; ?>	
			<ul>
			<?php foreach ($coupons as $coupon) : ?>
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
							<div class="sale_store_logo"><img src="<?php echo base_url();?>asset/img/cupons/co1.jpg"/></div>
							<div class="sale_status">
								<div class="state"><?php echo $coupon->expierement ?> :עד</div>
								<div class="triangle"></div>
							</div>
							<div class="cutoff"><img src="<?php echo base_url();?>asset/img/cutoff.png"/></div>
						</div>
							<h3>The Nonsense Society</h3>
							<p>Art, Music, Word<br/><a href="http://www.nonsensesociety.com" target="_BLANK">Website</a></p>	
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
			});
</script>