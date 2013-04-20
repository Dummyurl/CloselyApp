<div class="store_block_header">המליצו עלינו</div>
<div class="triangle"></div>
<div class="recommands">
	<div class="contentblock">
	<ul class="store_recommand_list" id="recommandsList">
	<?php foreach($recommands as $recommand) : ?>
	<?php $username = $this->users_model->getUserName($recommand->user_id); ?>
		<li class="recommand_row">
			<div class="user_image"><img src="https://graph.facebook.com/<?php echo $recommand->user_id ?>/picture"/></div>
			<div class="recommand_bubble head_bubble">
				<div class="user_recommend">
					<div class="user_name bubble_user"><?php echo $username ?></div>
					<div class="text_recommand bubble_content"><?php echo $recommand->description ?></div>
				</div>
			</div>
			
		</li>
	<?php endforeach ?>	
	</ul>
	<div class="recommands">
		<div class="triangle up"></div>
		<input type="text" value="כתוב תגובה">
		<div class="add_recommand">הגב</div>
	</div>
	</div>
</div>