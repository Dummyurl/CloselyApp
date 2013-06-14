<?php $this->load->helper('url'); ?>
<?php if(!empty($shopstores['locations'])) : ?>
<?php $this->load->view('head/multilocation',$shopstores); ?>
<?php endif; ?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=he&libraries=places"></script>		
<script type="text/javascript" src="<?php echo base_url();?>asset/js/jquery.thumbnailScroller.js"></script>
<link rel="stylesheet" media="all" href="<?php echo base_url();?>asset/css/jquery.thumbnailScroller.css"/>
<div class="user_page_container">
	<div class="title_top">
		<div class="fav"></div>
		<div class="title"><?php echo $info->user_name?></div>
		<input type="text" value="חיפוש">
		<div class="w-triangle"></div>

	</div>	
	<div class="content">
		<div class="map">
			<?php if(!empty($shopstores['locations'])) : ?>
				<div id="locationField">
					 <input id="autocomplete" type="text" /> 
				</div>
				<div id="map_canvas"></div>
				<div id="listing"><table id="results"></table></div>
			<?php else: ?>
				<div class="noinfo">לא בוצעו קניות</div>
			<?php endif ?>
		</div>
		<div class="user_box">
			<div class="user_info_page">
				<div class="picture"><img src="https://graph.facebook.com/<?php echo $id; ?>/picture?type=large"  /></div>
				<div class="buttons">
				<ul>
					<li class="action_button" id ="followme">עקוב אחריי</li>
					<li class="action_button" id ="addtofreinds">הוסף לחברים</li>
					<li class="action_button" id ="sendmessage">שלח הודעה</li>
				</ul>
				</div>
			</div>
			<div class="user_adv">
			<div class="store_block_header">החברים שלי</div>
			<div class="triangle"></div>
				<div id="slider" class="jThumbnailScroller">
					<div class="jTscrollerContainer">
						<div class="jTscroller">
						<?php foreach($freinds as $freind) : ?>
							<a href="<?php echo base_url();?>user/popup/<?php echo $freind ?>" class="fancybox"><img src="https://graph.facebook.com/<?php echo $freind; ?>/picture"  /></a>	
						<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="my_freinds">פרסומת של חנות שקניתי בה</div>

		<div id="tabs" class="user_tab_fix">
			<ul class="user_buttons">
				<li id="myshops" class="selected_tab">קניות</li>
				<li id="mycoupons">קופונים</li>
				<li id="myrecommands">המלצות</li>
				<li id="myclubs">מועדונים</li>
			</ul>
			<div class="right_border"></div>
		</div>
		<div id="loadind_tab"><img src="<?php echo base_url();?>asset/img/ajax-loader.gif" /></br>טוען עמוד</div>
		<div class="actions_grid">
			<div class="store_block_header">הקניות שלי</div>
			<div class="triangle"></div>
			<?php $this->load->view('blocks/shops',$last_shops); ?>
		</div>
	</div>
</div>	
<?php print_r($FreindRequest); ?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
var tabsId = ['myshops','mycoupons','myrecommands'];
	var view = '<?php echo $view ?>';
	 var correctTab = jQuery.inArray(view,tabsId);	
	if (correctTab != -1){
		console.log('view' + '<?php echo $view ?>');
		url = '<?php echo base_url();?>' + 'user/gettab';
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'tab=<?php echo $view ?>' + '&user=' + '<?php echo $id ?>',
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
	<?php if(!empty($shopstores['locations'])) : ?>
	initialize();
	<?php endif; ?>
	$("#slider").thumbnailScroller({ 
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
 	$('.user_buttons li').click(function(){
		$('.user_buttons li').each(function() {
			$(this).removeClass("selected_tab");
		});
		$(this).addClass("selected_tab");


	
		var tab = $(this).attr('id');
		url = '<?php echo base_url();?>' + 'user/gettab';
		
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'tab=' + tab + '&user=' + '<?php echo $id ?>',
				beforeSend: function() {
					$("#loadind_tab").show();
				},				
				success: function(block) {
					 $("#loadind_tab").hide();
					 $('.actions_grid').html(block);
					 
					}
					 
				});		
	});

if('<?php echo !empty($isFollowed) && $followStatus[0]->status ?>'){	
	$('#followme').html('במעקב');
	$('#followme').addClass('following');
}

	
	$('#followme').click(function(){
		var url = '<?php echo base_url();?>' + 'user/follow/' + <?php echo $id ?>;
		if('<?php echo !empty($loginuser) ?>'){
			$.ajax({  
				type: "POST",  
				url: url,  
				data: {user: '<?php echo $loginuser ?>'},				
				success: function(status) { 
					if(status){
					
						$('#followme').html('במעקב');
						$('#followme').addClass('following');
					} else {
						$('#followme').html('עקוב אחרי');
						$('#followme').removeClass('following');						
					}
				}
			});	
		} else {
			alert('עלייך להתחבר לאתר כדי לבצע פעולה זו');
		}
	});

	if('<?php echo !empty($isMyFreind) ?>'){	
		$('#addtofreinds').html('חברים');
		$('#addtofreinds').addClass('following');
	} else if('<?php echo !empty($FreindRequest) ?>'){
		$('#addtofreinds').html('נשלחה בקשת חברות');
		// $('#addtofreinds').addClass('following');
	}
	$('#addtofreinds').click(function(){
	console.log('<?php echo !empty($loginuser) ?>');
		if('<?php echo !empty($loginuser) ?>'){
		
				var userId = '<?php echo $id ?>';
				var url = '<?php echo base_url();?>' + 'user/addtofreinds';
 				$.fancybox({
					autoSize:false,
					href : url + '?user=' + userId,
					width:400,
					height:300,
					scrolling:'no',
					padding:0,
					closeBtn: false,
					type : 'iframe',
				}); 
				return false;		
		} else {
			alert('עלייך להתחבר לאתר כדי לבצע פעולה זו');
		}
	});
	
	
	
	
 }); 
</script>
