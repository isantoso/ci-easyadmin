<h1>Menu Group List</h1>
<p><?=anchor($this->config->item('admin_folder').'/menu/add','Create New Menu &raquo;')?></p>

<table width="100%">
	<tr>
		<td class="tdHeading">MENU</td>
		<td class="tdHeading" align="center">EDIT</td>
		<td class="tdHeading" align="center">DELETE</td>
	</tr>
<?php foreach($menus as $menu):?>
	<tr class="contentitem" onMouseOver="this.className='contentitemHover'" onMouseOut="this.className='contentitem'">
		<td class="tdItem"><?=$menu->menu_title?></td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/menu/edit/'.$menu->menu_id,'<img src="'.base_url().'assets/icons/edit.png" alt="edit menu" border="0" />') ?>
		</td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/menu/delete/'.$menu->menu_id,'<img src="'.base_url().'assets/icons/delete.png" alt="delete menu" border="0" />',array('onClick'=>'return confirm(\'The menu will be permanently deleted! Are you sure? \')')) ?>
		</td>
	</tr>
<?php endforeach;?>
</table>

<p><?=anchor($this->config->item('admin_folder').'/menu/reorder','[Change Menu List Order]')?></p>