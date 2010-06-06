<h1>Update User Login</h1>

<p><?=anchor($this->config->item('admin_folder').'/users/view',' &laquo; back to User List')?></p>

<form action="" method="post" class="webform">  
	<fieldset>
	<legend>User Information</legend>

	<div>
	<label>User Name: </label><strong><?=$user->user_username?></strong>
	</div>

	<div>
	<label>User Group</label>
	<select id="group_id" name="group_id" >
		<option value="">Please select</option>
		<?php foreach($group_options as $group):?>
		<option value="<?=$group->group_id?>" <?=set_select('group_id', $group->group_id,($user->group_id == $group->group_id) ? TRUE : FALSE); ?>><?=$group->group_name?></option>
		<?php endforeach;?>
	</select>
	</div>
	
	<div>
	<label>Name</label>
	<input type="text" id="name" name="name" value="<? if(set_value('name')) { echo set_value('name'); } else { echo $user->name; }?>"  />
	</div>
	
	<div>
	<label>Phone</label>
	<input type="text" id="phone" name="phone" value="<? if(set_value('phone')) { echo set_value('phone'); } else { echo $user->phone; }?>"  />
	</div>
	
	<div>
	<label>Email</label>
	<input type="text" id="email" name="email" value="<? if(set_value('email')) { echo set_value('email'); } else { echo $user->email; }?>"  />
	</div>
	

	
	<div>
		<label>&nbsp;</label>
		<input type="submit" id="submit" name="submit" value="UPDATE USER" class="button"/>
	</div>

</fieldset>
</form>
