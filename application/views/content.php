<?php if($page == 'home') : ?>
	<?php foreach ($blocks as $block) : ?>
		<?php $this->load->view('blocks/'.$block,$records); ?>
	<?php endforeach ?>
<?php elseif($page == 'user') : ?>
	<?php $this->load->view('page/user/view',$user); ?>
<?php elseif($page == 'store') : ?>
	<?php $this->load->view('page/store/view',$store); ?>
<?php elseif($page == 'category') : ?>
	<?php $this->load->view('page/catalog/category',$category); ?>
<?php elseif($page == 'product') : ?>
	<?php $this->load->view('page/catalog/product',$product); ?>
<?php elseif($page == 'shop') : ?>
	<?php $this->load->view('page/catalog/shop',$shop); ?>
<?php else : ?>
	<?php $this->load->view('page/error',$error); ?>	
<?php endif ?>