<?php $this->load->helper('url'); ?>
<div class="product_page_container">
	<div class="right_title"></div>
	<div class="left_title">
	<div class="product_name"></div>
	<div class="header_buttons"></div>
	</div>	
	<div class="content">
		<div class="top_content">
			<div class="product_stores">
			</div>
			<div class="image_box">
			</div>
		</div>
		<div class="middle_content">
			<div class="product_buyers">
			</div>
			<div class="adv">
			</div>
		</div>
		<div id="tabs" class="user_tab_fix">
			<ul class="user_buttons">
				<li id="myshops" class="selected_tab">קניות</li>
				<li id="mycoupons">קופונים</li>
				<li id="myrecommands">המלצות</li>
			</ul>
			<div class="right_border"></div>
		</div>
		<div id="loadind_tab"><img src="<?php echo base_url();?>asset/img/ajax-loader.gif" /></br>טוען עמוד</div>
		<div class="actions_grid">
			<div class="store_block_header">הקניות שלי</div>
			<div class="triangle"></div>
			<?php /* $this->load->view('blocks/shops',$last_shops); */ ?>
		</div>
	</div>
</div>	
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	

 }); 
</script>
