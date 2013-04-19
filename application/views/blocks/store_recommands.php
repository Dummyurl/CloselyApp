<div class="recommands">
	<div class="headerblock">המלצות</div>
	<div class="triangle"></div>
	<div class="contentblock">
	<ul class="store_recommand_list">
	<?php foreach($lastRecommands as $recommand) : ?>
	<?php $username = $this->users_model->getUserName($recommand->user_id); ?>
		<li class="recommand_row">
			<div class="user_image"><img src="https://graph.facebook.com/<?php echo $recommand->user_id ?>/picture"/></div>
			<div class="comment_bubble">
				<div class="rating"><div class="auto" style="width:<?php echo 21.2*$recommand->rating ?>px"></div></div>
				<div class="user_recommend">
					<div class="user_name"><?php echo $username ?></div>
					<div class="text_recommand"><?php echo $recommand->description ?></div>
				</div>
			</div>
			
		</li>
	<?php endforeach ?>

	</ul>
<div class="more_recommands">
	<p>קרא עוד המלצות</p>
</div>
	</div>
</div>