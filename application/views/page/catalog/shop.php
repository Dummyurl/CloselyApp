<?php $this->load->helper('url'); ?>
<div class="shop_page_container">
	<div class="left_title">
		<h1><?php echo $info->shop_title; ?></h1>
		<div class="add_recommand">הוסף המלצה<img src="<?php echo base_url();?>asset/img/add.png" /></div>
	</div>	
	<div class="content">
		<div class="top_content">
			<div class="image_box">
				<?php  ?>
				<img src="<?php echo base_url();?>asset/img/store/<?php echo $storeId .'/'. $mainProduct->product_image ?>"/>
			</div>
			<div class="top_left">
				<div class="product_slider">
					<div class="header">פריטים שנרכשו בקנייה זו</div>
					<div class="triangle"></div>
				</div>
				<div class="shop_owner">
				</div>
			</div>
		</div>
		<div class="middle_content">
			<div class="product_details">
				<div class="header">פרטי המוצר</div>
				<div class="triangle"></div>
				<div class="description"></div>
			</div>
		</div>
		<div class="footer_content">
			<div class="coupon_box">
				<div class="header">קופון מהקנייה</div>
				<div class="triangle"></div>
				<div class="coupon"></div>
			</div>
			<div class="adv">
			</div>
			<div class="comments">
			</div>
		</div>
	</div>
</div>	
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	

 }); 
</script>
