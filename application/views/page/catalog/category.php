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
				<li><h3 style="font-size:<?php echo 90/$sub_cnt ?>px"><?php echo $category->category_name ?></h3></li>
			<?php endforeach ?>
			</ul>
		</div>
	</div>
	<div class="search">
		<form id="searchBar">
			<div class="search_box"><input type="text" value="מה את/ה מחפש/ת?" id="category-search" name="searchData"></div>
			<div id="divResult"></div>
			<div class="search_button">חפש</div>
			<div class="search_type">
			<div class="type"><input type="radio" name="group1" value="shopping"> קניות</div>
			<div class="type"><input type="radio" name="group1" value="coupons" checked> קופונים</div>
			<div class="type"><input type="radio" name="group1" value="recommands"> המלצות</div>
			</div>
		</form>
	</div>
	<div class="stores_slider">
		<ul>
				<?php foreach ($stores as $store) : ?>
				<?php $logo = $this->catalog_model->getStoreImage($store->store_id); ?>
					<li><img src="<?php echo base_url();?>asset/img/bizlogos/<?php echo $logo ?>"  /></li>
				<?php endforeach ?>
		</ul>
	</div>
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

	var table = $("#searchBar input[type='radio']:checked").val();
	
	(function animate() {
		$(".stores_slider li:first").each(function(){
			$(this).animate({marginLeft:-$(this).outerWidth(true)},3000,function(){
				$(this).insertAfter(".stores_slider li:last").fadeIn('slow');
				$(this).css({marginLeft:0});
				setTimeout(function(){animate()},2000);
			});
		});
	})();

	
	$(".box-row").click(function(){
	$(this).show();
		var title = $(this).find('#res_title').text();
		console.log(title);
	});
	
	var warpperWidth = $(".category_container ul").width();
		var sumWidth = 0;
		var lastBox;
		var rel = 1;
		$(".sub_categories li").each(function() {
			$(this).attr("sub",rel);
			var beforAdd = sumWidth;
			sumWidth += $(this).outerWidth();
			if(warpperWidth<sumWidth){
				var adding = warpperWidth-beforAdd;
				lastBox = $('.sub_categories li[sub="' +(rel-1)+'"]');
				lastBox.width(lastBox.width()+adding);
				sumWidth = $(this).outerWidth();
			}
			rel++;	
		});
		var last =$('.sub_categories li[sub="' +(rel-1)+'"]');
		adding = warpperWidth-sumWidth;
		var newLastWidth = last.outerWidth()
		last.outerWidth(newLastWidth+adding);
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

	// Remove search bar text on foucos
	var Input = $('input[name=searchData]');
	var default_value = Input.val();
	Input.focus(function() {
		if(Input.val() == default_value) Input.val("");
	}).blur(function(){
		// $('#divResult').hide();
		if(Input.val().length == 0) Input.val(default_value);
	});
	
	$('#searchBar input[type=radio]').click(function(){
		table = $(this).val();
	});
	
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
	
	
$("#category-search").keyup(function() 
{ 
var inputSearch = $(this).val();
var dataString = 'word='+ encodeURI(inputSearch) + '&table='+ table + '&category=<?php echo $id ?>';
var returl  = '<?php echo base_url();?>' + 'feed/getSearchResult';
if(inputSearch!='')
{
	$.ajax({
	type: "POST",
	url: returl,
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#divResult").html(html).show();
	}
	});
} else {
$("#divResult").hide();
return false; 
} 
});

	
 }); 
</script>