<?php $this->load->helper('url'); ?>
<div class="recommands">
	<div class="contentblock">
	<ul class="store_recommand_list" id="recommandsList">
	<?php foreach($recommands as $recommand) : ?>
	<?php $username = $this->users_model->getUserName($recommand->user_id); ?>
	<?php $storeInfo = $this->stores_model->getStoreInfo($recommand->store_id); ?>
		<li class="recommand_row">
			<div class="user_image"><img src="https://graph.facebook.com/<?php echo $recommand->user_id ?>/picture"/></div>
			<div class="recommand_bubble head_bubble">
				<div class="store_logo"><img src="<?php echo base_url();?>asset/img/bizlogos/<?php echo $storeInfo[0]->store_logo;?>" /></div>
				<div class="user_recommend">
					<div class="user_name bubble_user"><?php echo $username ?></div>
					<div class="text_recommand bubble_content"><?php echo $recommand->description ?></div>
				</div>
			</div>
			
		</li>
	<?php endforeach ?>	
	</ul>
	</div>
</div>