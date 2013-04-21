<?php $this->load->helper('url'); ?>
<?php $this->load->view('head/multilocation',$shopstores); ?>
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
			<div id="locationField">
				 <input id="autocomplete" type="text" /> 
			</div>
			<div id="map_canvas"></div>
			<div id="listing"><table id="results"></table></div>
		</div>
		<div class="user_box">
			<div class="user_info_page">
				<div class="picture"><img src="https://graph.facebook.com/<?php echo $id; ?>/picture?type=large"  /></div>
				<div class="buttons">
				<ul>
					<li class="action_button">עקוב אחריי</li>
					<li class="action_button">הוסף לחברים</li>
					<li class="action_button">שלח הודעה</li>
				</ul>
				</div>
			</div>
			<div class="user_adv">
				<div id="slider" class="jThumbnailScroller">
					<div class="jTscrollerContainer">
						<div class="jTscroller">
						<?php foreach($freinds as $freind) : ?>
							<a href="#"><img src="https://graph.facebook.com/<?php echo $freind; ?>/picture"  /></a>	
						<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="my_freinds"></div>
		<ul class="user_buttons">
			<li>הקניות שלי</li>
			<li>הקופונים שלי</li>
			<li>ההמלצות שלי</li>
		</ul>
		<div class="actions_grid"></div>
	</div>
</div>	
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
 window.onload = initialize;
 }); 
</script>