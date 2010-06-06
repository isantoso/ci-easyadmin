<h1>Group - Module Permissions</h1>

<p><?=anchor($this->config->item('admin_folder').'/group/view',' &laquo; back to User Group List')?></p>

<p><strong>Module Permission for <?=$group->group_name ?></strong></p>

<form action="" method="post" id="group_permission_form">
<table width="100%">
	<tr>
		<td class="tdHeading" align="center">Enabled?</td>
		<td class="tdHeading" align="center">Menu</td>
		<td class="tdHeading">Menu</td>
		<td class="tdHeading">Module Name</td>
		<td class="tdHeading">Access Path</td>

		<td class="tdHeading" align="center">Access</td>
	</tr>
	<?php
	foreach($modules as $module):
	$permission = $this->module_model->get_module_permission($group->group_id,$module->module_id);
	?>
	<tr class="contentitem" onMouseOver="this.className='contentitemHover'" onMouseOut="this.className='contentitem'">
		<td class="tdItem" align="center">
			<img src="<?=base_url()?>assets/icons/<?=$module->module_enabled?>.png" alt="" border="0" />
		</td>
		<td class="tdItem" align="center">
			<img src="<?=base_url()?>assets/icons/<?=$module->show_on_menu?>.png" alt="" border="0" />
		</td>
		<td class="tdItem"><?php echo $module->menu_title ?></td>
		<td class="tdItem"><?php echo $module->module_name ?></td>
		<td class="tdItem"><?php echo $module->access_path ?></td>

		<td class="tdItem" align="center">

			<img src="<?=base_url()?>assets/icons/0.png" alt="" border="0" />
			<input type="radio" id="module_<?=$module->module_id?>_0" value="0" name="module[<?=$module->module_id?>]" <?php if($permission == 0) echo 'checked'?> />



			<img src="<?=base_url()?>assets/icons/1.png" alt="" border="0" />
			<input type="radio" id="module_<?=$module->module_id?>_1" value="1" name="module[<?=$module->module_id?>]" <?php if($permission == 1) echo 'checked'?> />

		</td>
	</tr>
	<?php endforeach;?>
</table>

<div align="center">
	<input type="hidden" id="update_module_permission" name="update_module_permission" value="1" />
	<input type="submit" id="submit" value="UPDATE PERMISSIONS" />
</div>

</form>
