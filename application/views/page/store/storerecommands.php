<?php $this->load->helper('url'); ?>
<div class="store_block_header">
<div class="view_switch">
	<a href="" class="showswitch right_radius <?php echo $freinds_switch  ?> switch_header" id="tab-switch-1" onclick="return false;">חברים</a>
	<a href="" class="showswitch left_radius <?php echo $all_switch  ?> switch_header" id="tab-switch-2" onclick="return false;">הכל</a>								
</div>
<div class="tab_title">המליצו עלינו</div>
</div>
<div class="triangle"></div>
<div id ="load_store_tab" ><img src="<?php echo base_url();?>asset/img/ajax-loader.gif" /></br>טוען עמוד</div>
<?php $this->load->view('blocks/store_recommands',$records); ?>

<script type="text/javascript" charset="utf-8">	

		$('#tab-switch-1').click(function(){
		if ('<?php echo $isloggin ?>'){
			if (!$(this).hasClass("selected_switch")) {
				$(this).addClass("selected_switch");
				$('#tab-switch-2').removeClass("selected_switch");
				 changeView(2);
			}	
		}
		});
		
		// evreyone
		$('#tab-switch-2').click(function(){
			if (!$(this).hasClass("selected_switch")) {
				$(this).addClass("selected_switch");
				$('#tab-switch-1').removeClass("selected_switch");
				 changeView(1);
			}		//do stuff

		});


		
	function changeView(view){
		url = '<?php echo base_url();?>' + 'store/getview';
		$.ajax({  
				type: "POST",  
				url: url,  
				data:  'view=' + view + '&tab=' + '<?php echo $current_tab ?>' + '&store=<?php echo $id ?>' + '&freinds=<?php echo $freinds ?>', 
				beforeSend: function() {
					$("#load_store_tab").show();
				},
				success: function(msg) {
					$('.store_tab_page').html(msg);
					}
				});		
    }
	

</script>