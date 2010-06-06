<h1>Menu Item Order</h1>

<p><?=anchor($this->config->item('admin_folder').'/menu/view','&laquo; back to View Menu')?></p>


<p>Click and drag the menu item up or down to move the menu order</p>
<ul id="menu_parent">
<?php foreach($menus as $menu): ?>
	<li id="menu_id_<?=$menu->menu_id?>" class="listOrderParent"><?=$menu->menu_title?>
	
	<?php
	$modules =  $this->module_model->get_all($menu->menu_id,0);
	if(is_array($modules)):
	echo '<ul id="menu_child_'.$menu->menu_id.'">';
	foreach($modules as $module):
	?>

	<?php echo '<li id="module_id_'.$module->module_id.'" class="listOrderChild">'.$module->module_name.'</li>'?>
	
	<?php endforeach; ?>
	<?php echo '</ul>' ?>
	<?php endif; ?>
	</li>

<?php endforeach; ?>
</ul>

<script type="text/javascript">
$(document).ready(function(){

	$('#menu_parent').sortable(
		{
			update: function(){
				update_menu_order('#menu_parent');
			}
		}
	);

	<?php foreach($menus as $menu): ?>
	$('#menu_child_<?=$menu->menu_id?>').sortable(
		{
			update: function(){
				update_menu_order('#menu_child_<?=$menu->menu_id?>');
			}
		}
	);
	<?php endforeach; ?>
});

/* ajax function to update menu order */
function update_menu_order(element_id)
{
	to_post = ($(element_id).sortable('serialize'));

	$.ajax({
			type: "POST",
			url: "reorder/ajax",
			data: to_post,
			success: function(msg){
			alert( "Data Saved");
		}
	});

}
</script>