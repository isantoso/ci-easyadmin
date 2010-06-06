<h1>Module List</h1>
<p><?=anchor($this->config->item('admin_folder').'/module/add','Create New Module &raquo;')?></p>

<table width="100%">
	<tr>
		<td class="tdHeading">Menu</td>
		<td class="tdHeading">Module Name</td>
		<td class="tdHeading">Access Path</td>
		<td class="tdHeading" align="center">Edit</td>
		<td class="tdHeading" align="center">Enabled?</td>
		<td class="tdHeading" align="center">Menu</td>
		<td class="tdHeading" align="center">Delete</td>
	</tr>
	<?php foreach($modules as $module):?>
	<tr class="contentitem" onMouseOver="this.className='contentitemHover'" onMouseOut="this.className='contentitem'">
		<td class="tdItem"><?php echo $module->menu_title ?></td>
		<td class="tdItem"><?php echo $module->module_name ?></td>
		<td class="tdItem"><?php echo $module->access_path ?></td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/module/edit/'.$module->module_id,'<img src="'.base_url().'assets/icons/edit.png" alt="edit module" border="0" />') ?>
		</td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/module/enable/'.$module->module_id,'<img src="'.base_url().'assets/icons/'.$module->module_enabled.'.png" alt="enable/disable module" border="0" />') ?>
		</td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/module/menu/'.$module->module_id,'<img src="'.base_url().'assets/icons/'.$module->show_on_menu.'.png" alt="show/hide module from menu" border="0" />') ?>
		</td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/module/delete/'.$module->module_id,'<img src="'.base_url().'assets/icons/delete.png" alt="delete module from menu" border="0" />',array('onClick'=>'return confirm(\'Module:  will be permanently deleted! Are you sure? \')')) ?>
		</td>
	</tr>
	<?php endforeach;?>
</table>
