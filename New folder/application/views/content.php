<?php foreach ($blocks as $block) : ?>
	<?php $this->load->view('blocks/'.$block,$records); ?>
<?php endforeach ?>