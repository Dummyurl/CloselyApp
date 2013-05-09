<?php 

	$column_width = (int)(80/count($columns));
	
	if(!empty($list)){
?><div class="bDiv" >
		<table cellspacing="0" cellpadding="0" border="0" id="flex1" class="table-bordered table-striped table-condensed cf">
		<thead>
			<tr class='hDiv'>
<?php
				 //contador utilizado para el arreglo de nombres de las columnas
				 $i=0;
				 foreach($columns as $column){?>
						<th>
							 <div class="text-left field-sorting <?php if(isset($order_by[0]) && $column->field_name == $order_by[0]){?><?php echo $order_by[1]?><?php }?>"
							 rel='<?php echo $column->field_name?>'>
							 <?php echo $column->display_as;
							//almacenamos el nombre de la columna en el arreglo
							$nombres[$i]=$column->display_as;
							//aumentamos el i
							$i++;
							?>
							</div>
						</th>
				<?php }?>
				<?php if(!$unset_delete || !$unset_edit || !empty($actions)){?>
				<th align="left" abbr="tools" axis="col1" class="" width='20%'>
					<div class="text-right">
						<?php echo $this->l('list_actions'); ?>
					</div>
				</th>
				<?php }?>
			</tr>
		</thead>		
		<tbody>
<?php foreach($list as $num_row => $row){ ?>        
<tr>
<?php
					 //contador para sacar el nombre de la columna y asignarlo a los datos
					 //se inicializa aqui adentro para que con cada fila se reinicie.
					 $j=0;
					 foreach($columns as $column){
						 //data-title es el atributo utilizado para poner el nombre de la columna
						 ?>
					
<td data-title='<?php echo $nombres[$j] ?>' class='<?php if(isset($order_by[0]) && $column->field_name == $order_by[0]){?>sorted<?php }?>'>
<div style="width: 100%;" class='text-left'><?php echo $row->{$column->field_name}; ?></div>
</td>
<?php
						 //aumentamos j
						 $j++;
					 }?>
			<?php if(!$unset_delete || !$unset_edit || !empty($actions)){?>
			<td align="left" width='20%'>
				<div class='tools'>				
					<?php if(!$unset_delete){?>
                    	<a href='<?php echo $row->delete_url?>' title='<?php echo $this->l('list_delete')?> <?php echo $subject?>' class="delete-row" >
                    			<span class='delete-icon'></span>
                    	</a>
                    <?php }?>
                    <?php if(!$unset_edit){?>
						<a href='<?php echo $row->edit_url?>' title='<?php echo $this->l('list_edit')?> <?php echo $subject?>'><span class='edit-icon'></span></a>
					<?php }?>
					<?php 
					if(!empty($row->action_urls)){
						foreach($row->action_urls as $action_unique_id => $action_url){ 
							$action = $actions[$action_unique_id];
					?>
							<a href="<?php echo $action_url; ?>" class="<?php echo $action->css_class; ?> crud-action" title="<?php echo $action->label?>"><?php 
								if(!empty($action->image_url))
								{
									?><img src="<?php echo $action->image_url; ?>" alt="<?php echo $action->label?>" /><?php 	
								}
							?></a>		
					<?php }
					}
					?>					
                    <div class='clear'></div>
				</div>
			</td>
			<?php }?>
		</tr>
<?php } ?>        
		</tbody>
		</table>
	</div>
<?php }else{?>
	<br/>
	&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->l('list_no_items'); ?>
	<br/>
	<br/>
<?php }?>	