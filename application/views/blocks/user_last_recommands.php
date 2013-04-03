<?php $this->load->helper('url'); ?>
<?php $this->load->model('users_model'); ?>		
<?php $recommands = '' ?>	
<div class="recommands">
	<div class="header">
		<div class="title">ההמלצות שלי</div>
		<div class="triangle"></div>
	</div>
	<div class="contant">
		<?php if ($recommands) : ?>
		<div class="footer">
			<a href="<?php echo base_url();?>user/page/<?php echo $userId ?>/recommands">צפה בכל ההמלצות שלי</a>
		</div>
		<?php else : ?>
			<div class= "noinfo">לא קיימות המלצות</div>
		<?php endif ; ?>
	</div>
</div>