<h1>User View</h1>

<p><?=anchor($this->config->item('admin_folder').'/users/add','Create New User Login &raquo;')?></p>
	
<?php $this->load->view($this->config->item('admin_folder').'/common/flash_message'); ?>

<div align="center">
<?=$pagination?>
</div>

<table width="100%">
<tr>
	<td class="tdHeading">ID</td>
	<td class="tdHeading">Name</td>
	<td class="tdHeading">User Name</td>
	<td class="tdHeading">Email</td>
	<td class="tdHeading">Group</td>
	<td class="tdHeading"  align="center">ENABLED</td>
	<td class="tdHeading" align="center">EDIT</td>
	<td class="tdHeading" align="center">DELETE</td>
</tr>
<?php foreach($users as $user):?>
<tr class="contentitem" onMouseOver="this.className='contentitemHover'" onMouseOut="this.className='contentitem'">
	<td class="tdItem"><?=$user->user_id?></td>
	<td class="tdItem"><?=$user->name?></td>
	<td class="tdItem"><?=$user->user_username?></td>
	<td class="tdItem"><?=$user->email?></td>
	<td class="tdItem"><?=$user->group_name?></td>
	<td class="tdItem"  align="center"><?=anchor($this->config->item('admin_folder').'/users/enable/'.$user->user_id.'/'.$this->uri->segment(4),'<img src="'.base_url().'assets/icons/'.$user->login_enabled.'.png" alt="enable/disable login" border="0" />')?></td>
	<td class="tdItem"  align="center"><?=anchor($this->config->item('admin_folder').'/users/edit/'.$user->user_id.'/'.$this->uri->segment(4),'<img src="'.base_url().'assets/icons/edit.png" alt="edit module" border="0" />')?></td>
	<td class="tdItem" align="center"><?=anchor($this->config->item('admin_folder').'/users/delete/'.$user->user_id.'/'.$this->uri->segment(4),'<img src="'.base_url().'assets/icons/delete.png" alt="delete module from menu" border="0" />',array('onClick'=>'return confirm(\'This user will be permanently deleted! Are you sure? \')'))?></td>
</tr>
<?php endforeach;?>
</table>

<div align="center">
<?=$pagination?>
</div>
