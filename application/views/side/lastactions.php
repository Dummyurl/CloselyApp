<?php $this->load->helper('url'); ?>
<li class="box-row">
	<div class="line-contant">
		<a href="<?php echo base_url();?>user/popup/<?php echo $lasttype['user_id'] ?>" class="fancybox"><img src="https://graph.facebook.com/<?php echo $lasttype['user_id'] ?>/picture"/></a>
		<div class="feed_text"><?php echo $text . ' ' . $lasttype['feed'] . ' ב' . $store . ' <span class="addbold">' . '<a href="' . base_url() .'user/popup/' . $lasttype['user_id'] . '" class="fancybox">' .  $uname . '</a></span>'  ?></div>
		<div class="feed_text title"><?php echo $lasttype['title'] ?></div>
	</div>
</li>