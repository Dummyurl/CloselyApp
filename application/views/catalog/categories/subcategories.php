<?php $this->load->helper('url'); ?>
<div class="category_img"><img src="<?php echo base_url();?>asset/img/category/<?php echo $info[0]->image; ?>" alt="alt text" /></div>
<div class="categories_list">
	<?php foreach ( $subcategories as $category ) : ?>
	<div class = "subcategories_line"><a href="<?php echo '/catalog/category/' . $category->url ?>"><?php echo $category->category_name ?></a></div>
	<?php endforeach ?>
</div>


