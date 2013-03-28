<?php $this->load->helper('url'); ?>
<?php $this->load->model('users_model'); ?>	
<?php foreach ($topusers as $uid=>$cnt ) : ?>
<?php $user_name = $this->users_model->getUserName($uid) ?>
		<li class="box-row">
		<div class="line-contant">
		<a href="<?php echo base_url();?>user/popup/<?php echo $uid ?>" class="fancybox"><img src="https://graph.facebook.com/<?php echo $uid ?>/picture"  /></a>
		<div class="shopper_more_info fancybox">צפה בכרטיס</div>
		<div class="topusername"><?php echo $user_name ?></div>
		<div class="shopper_line">סה"ב <?php echo $cnt ?></div>
		</div>
		</li>
<?php endforeach ?>