<h1>User Group List</h1>
<p><?=anchor($this->config->item('admin_folder').'/group/add','Create New User Group &raquo;')?></p>

<table width="100%">
	<tr>
		<td class="tdHeading">Group Name</td>
		<td class="tdHeading" align="center">ENABLED</td>
		<td class="tdHeading" align="center">EDIT</td>
		<td class="tdHeading" align="center">MODULE PERMISSION</td>
		<td class="tdHeading" align="center">DELETE</td>
	</tr>
	<?php foreach($groups as $group):?>
	<tr class="contentitem" onMouseOver="this.className='contentitemHover'" onMouseOut="this.className='contentitem'">
		<td class="tdItem" ><?php echo $group->group_name ?></td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/group/enable/'.$group->group_id,'<img src="'.base_url().'assets/icons/'.$group->group_enabled.'.png" alt="enable/disable group" border="0" />') ?>
		</td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/group/edit/'.$group->group_id,'<img src="'.base_url().'assets/icons/edit.png" alt="enable/disable group" border="0" />') ?>
		</td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/group/permission/'.$group->group_id,'<img src="'.base_url().'assets/icons/key_go.png" alt="set module permission for this group" border="0" />') ?>
		</td>
		<td class="tdItem" align="center">
			<?php echo anchor($this->config->item('admin_folder').'/group/delete/'.$group->group_id,'<img src="'.base_url().'assets/icons/delete.png" alt="delete group" border="0" />',array('onClick'=>'return confirm(\'The group will be permanently deleted! Are you sure? \')')) ?>
		</td>
	</tr>
	<?php endforeach;?>
</table>
	
