<?php $this->load->helper('url'); ?>
<ul>
<?php foreach ($searchResult as $result ) : ?>
<li class="box-row">
	<div class="line-contant search_addon">
		<a href="#"><img src="<?php echo $result['image'] ?>" /></a>
		<div class="feed_text title" id="res_title"><?php echo $result['title'] ?></div>
		<div class="feed_text"><?php echo $result['description'] ?></div>
	</div>
</li>
<?php endforeach ?>
</ul>