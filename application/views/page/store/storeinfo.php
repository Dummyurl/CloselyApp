<?php $this->load->helper('url'); ?>
<div class="store_page_info">
	<div class="store_page_image"><img src="<?php echo base_url();?>asset/img/bizlogos/<?php echo $info->store_logo;?>" /></div>
	<div class="store_page_details">
	<ul class="store_info_list">
						<li class="info_row">
							<div class="tag">:שם העסק</div>
							<div class="detial"><?php echo $info->store_name;?></div>
						</li>
						<li class="info_row">
							<div class="tag">:כתובת</div>
							<div class="detial"><?php echo $info->store_address;?></div>
						</li>
						<li class="info_row">
							<div class="tag">:טלפון</div>
							<div class="detial"><?php echo $info->phone; ?></div>
						</li>
						<li class="info_row">
							<div class="tag">:אתר</div>
							<div class="detial"><?php echo $info->website; ?></div>
						</li>
					</ul>

	</div>
	<div class="store_page_buttons">
	<ul>
		<li class="action_button">שלח הודעה</li>
		<li class="action_button">הצטרף למועדון</li>
		<li class="action_button">עקוב אחרינו</li>
	</ul>
	</div>
</div>
<div class="store_page_right">
	<div class="store_page_about">
		<div class="store_block_header">קצת עלינו</div>
		<div class="triangle"></div>
		<p><?php echo $info->description; ?></p>
	</div>
	<div class="store_page_lastsales">
		<div class="store_block_header">המבצעים החמים</div>
		<div class="triangle"></div>
	</div>
</div>
<div class="store_page_left">
	<div class="store_page_working">
		<div class="store_block_header">שעות פעילות</div>
		<div class="triangle"></div>
		<p><?php echo $info->time_working; ?></p>
	</div>
	<div class="store_page_map">
		<div id="locationField">
			 <input id="autocomplete" type="text" /> 
		</div>
		<div id="map_canvas"></div>
		<div id="listing"><table id="results"></table></div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
 window.onload = initialize;

 }); 

 if ('<?php echo isset($loadmap) ?>'){
  initialize();
 }

</script>