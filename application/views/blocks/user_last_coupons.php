<?php $this->load->helper('url'); ?>
<?php $this->load->model('users_model'); ?>		
<?php $coupons = $this->users_model->getLastCoupons($userId) ?>
<div class="coupons">
	<div class="headerblock">
		<div class="title">הקופונים שלי</div>
		<div class="triangle"></div>
	</div>
	<div class="contant">
	<?php if ($coupons) : ?>
		<?php foreach ($coupons as $coupon ) : ?>
			<?php $storeInfo = $this->users_model->getStoreInfo($coupon->store_id); ?>
				<li class="coupon">
					<div class="store">
						<a href="<?php echo base_url();?>store/page/<?php echo $coupon->store_id ?>" target="_parent"><img src="<?php echo base_url();?>asset/img/bizlogos/<?php echo $storeInfo[0]->store_logo?>"  /></a>
					</div>
					<div class="discaunt"><?php echo $coupon->type ?></div>
					<div class="title"><?php echo $coupon->coupon_name ?></div>
				</li>
		<?php endforeach ?>
		<div class="footer">
			<a href="<?php echo base_url();?>user/page/<?php echo $userId ?>/coupons" target="_parent">צפה בכל הקופונים שלי</a>
		</div>
	<?php else : ?>
		<div class= "noinfo">לא קיימים קופונים</div>
	<?php endif ; ?>
	</div>	
</div>
