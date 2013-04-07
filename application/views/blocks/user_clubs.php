<?php $this->load->helper('url'); ?>
<?php $this->load->model('users_model'); ?>	
<?php $clubs = $this->users_model->getClubs($userId) ?>
<div class="clubs">
	<div class="header header_orange">
		<div class="title">המועדונים שלי</div>
		<div class="triangle"></div>
	</div>
	<div class="contant">
	<?php if ($clubs) : ?>
	<?php foreach ($clubs as $club ) : ?>
			<li class="club">
				<a href="<?php echo base_url();?>store/page/<?php echo $club->store_id ?>" target="_parent"><img src="<?php echo base_url();?>asset/img/bizlogos/<?php echo $club->logo;?>" /></a>
			</li>
	<?php endforeach ?>
	<div class="footer">
		<a href="<?php echo base_url();?>user/page/<?php echo $userId ?>/clubs" target="_parent">צפה בכל המועדונים שלי</a>
	</div>
	<?php else : ?>
			<div class= "noinfo">לא קיימים מועדונים</div>
	<?php endif ; ?>
	</div>
</div>