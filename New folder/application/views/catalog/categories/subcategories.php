<?php $this->load->helper('url'); ?>
<div class="category_img"><img src="<?php echo base_url();?>asset/img/category/<?php echo $info[0]->image; ?>" alt="alt text" /></div>
<div class="categories_list">
	<?php foreach ( $subcategories as $category ) : ?>
	<div class = "subcategories_line"><?php echo $category->category_name ?></div>
	<?php endforeach ?>
</div>


