<?php $this->load->helper('url'); ?>
<div class="category_container">
	<div class="header">
		<div class="head_bar">
			<div class="title"><h1><?php echo $info[0]->category_name ?></h1></div>
			<div class="view_state">
				<div class="view_switch">
					<a href="" class="showswitch right_radius <?php echo $freinds_switch  ?> switch_header" id="tab-switch-1" onclick="return false;">חברים</a>
					<a href="" class="showswitch left_radius <?php echo $all_switch  ?> switch_header" id="tab-switch-2" onclick="return false;">הכל</a>								
				</div>
			</div>
		</div>
		<div class="main_picture"><img src="<?php echo base_url();?>asset/img/cat_main_bg.jpg" /></div>
		<div class="description"><h2><?php echo $info[0]->description ?></h2></div>
		<div class="sub_categories">
		<?php $sub_cnt = sizeof($subCategories) ?>
			<ul>
			<?php foreach ($subCategories as $category) : ?>
				<li style="width:<?php echo (100-$sub_cnt)/$sub_cnt ?>%"><h3 style="font-size:<?php echo 90/$sub_cnt ?>px"><?php echo $category->category_name ?></h3></li>
			<?php endforeach ?>
			</ul>
		</div>
	</div>
	<div class="search">
		<div class="search_box"><input type="text" value="מה את/ה מחפש/ת?"></div>
		<div class="search_button">חפש</div>
		<div class="search_type">
		<div class="type"><input type="radio" name="group1" value="shopping"> קניות</div>
		<div class="type"><input type="radio" name="group1" value="coupons" checked> קופונים</div>
		<div class="type"><input type="radio" name="group1" value="recommands"> המלצות</div>
		</div>
	</div>
	<div class="stores_slider"></div>
	<div class="content">
		<div id="tabs">
			<ul>
				<li id="catshops" class="selected_tab">קניות</li>
				<li id="catcoupons">קופונים</li>
				<li id="catrecommands">המלצות</li>
				<li id="catproducts">מוצרים</li>
			</ul>
			<div class="right_border"></div>
		</div>
	</div>
	<div id="loadind_tab"><img src="<?php echo base_url();?>asset/img/ajax-loader.gif" /></br>טוען עמוד</div>
	<div class="actions_grid">
		<?php $this->load->view('blocks/shops',$shops); ?>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
var tabsId = ['catshops','catcoupons','catrecommands','catproducts'];
	var view = '<?php echo $view ?>';
	 var correctTab = jQuery.inArray(view,tabsId);	
	if (correctTab != -1){
		console.log('view' + '<?php echo $view ?>');
		url = '<?php echo base_url();?>' + 'catalog/gettab';
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'tab=<?php echo $view ?>' + '&category=' + '<?php echo $id ?>',
				beforeSend: function() {
					$("#loadind_tab").show();
				},				
				success: function(block) {
					 $("#loadind_tab").hide();
					 $('.actions_grid').html(block);
					 
					}
					 
				});			
	}

 window.onload = function() {
	$(".stores_slider").thumbnailScroller({ 
			scrollerType:"hoverPrecise", 
			scrollerOrientation:"horizontal", 
			scrollSpeed:2, 
			scrollEasing:"easeOutCirc", 
			scrollEasingAmount:800, 
			acceleration:2, 
			scrollSpeed:800, 
			noScrollCenterSpace:10, 
			autoScrolling:0, 
			autoScrollingSpeed:2000, 
			autoScrollingEasing:"easeInOutQuad", 
			autoScrollingDelay:500 
		});
};
 	$('#tabs li').click(function(){
		$('#tabs li').each(function() {
			$(this).removeClass("selected_tab");
		});
		$(this).addClass("selected_tab");


	
		var tab = $(this).attr('id');
		url = '<?php echo base_url();?>' + 'catalog/gettab';
		
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'tab=' + tab + '&category=' + '<?php echo $id ?>',
				beforeSend: function() {
					$("#loadind_tab").show();
				},				
				success: function(block) {
					 $("#loadind_tab").hide();
					 $('.actions_grid').html(block);
					 
					}
					 
				});		
	});
	

	
 }); 
</script>