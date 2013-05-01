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
<?php echo print_r($freinds);	 ?>

<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
	
		var catalogview = 1;
		var currenttab = 'catshops';
	
		$('#tab-switch-1').click(function(){
			if ('<?php echo $isloggin ?>'){
				if (!$(this).hasClass("selected_switch")) {
					$(this).addClass("selected_switch");
					$('#tab-switch-2').removeClass("selected_switch");
					 catalogview = 2;
					 changeView(2,currenttab);
				}	
			}
		});
		
		// evreyone
		$('#tab-switch-2').click(function(currenttab){
			if (!$(this).hasClass("selected_switch")) {
				$(this).addClass("selected_switch");
				$('#tab-switch-1').removeClass("selected_switch");
				 catalogview = 1;
				 changeView(1,currenttab);
			}		//do stuff

		});

		function changeView(view,currenttab){
		url = '<?php echo base_url();?>' + 'catalog/getview';
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'view=' + view + '&tab=' + currenttab + '&category=<?php echo $id ?>' + '&freinds=<?php echo json_encode($freinds) ?>', 
				beforeSend: function() {
					$("#load_store_tab").show();
				},
				success: function(msg) {
					$('.actions_grid').html(msg);
					}
				});		
		}	

	
 	$('#tabs li').click(function(){
		$('#tabs li').each(function() {
			$(this).removeClass("selected_tab");
		});
		$(this).addClass("selected_tab");


	
		var tab = $(this).attr('id');
		currenttab = tab ;
		url = '<?php echo base_url();?>' + 'catalog/gettab';
		
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'view=' + catalogview + '&tab=' + tab + '&category=' + '<?php echo $id ?>' + '&freinds=<?php echo json_encode($freinds) ?>',
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