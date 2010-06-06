<h1>Add New User</h1>
<p><?=anchor($this->config->item('admin_folder').'/users/view',' &laquo; back to User List')?></p>

<form action="" method="post" class="webform">  
	<fieldset>
	<legend>User Information</legend>
	
	<div>
	<label>User Group </label>
	<select id="group_id" name="group_id" >
		<option value="">Please select</option>
		<?php foreach($group_options as $group):?>
		<option value="<?=$group->group_id?>" <?=set_select('group_id', $group->group_id); ?>><?=$group->group_name?></option>
		<?php endforeach;?>
	</select>
	</div>

	<div>
		<label>Name</label>
		<input type="text" id="name" name="name" value="<?=set_value('name')?>" />
	</div>
	
	<div>
		<label>Phone</label>
		<input type="text" id="phone" name="phone" value="<?=set_value('phone')?>"   />
	</div>
	
	<div>
		<label>Email</label>
		<input type="text" id="email" name="email" value="<?=set_value('email')?>" />
	</div>
	
	<div>
		<label>User Name</label>
		<input type="text" id="user_username" name="user_username" value="<?=set_value('user_username')?>" />
	</div>
	
	<div>
		<label>Password</label>
		<input type="text" id="user_password" name="user_password" value="" />
	</div>
	
	<div>
		<label>Repeat Password</label>
		<input type="text" id="user_password_confirm" name="user_password_confirm" value="" />
	</div>

	<div>
	<label>Enable Login</label>
	<label for="login_enabled1" class="radiolabel">  
	<input type="radio" name="login_enabled" id="login_enabled1" value="1"  <?php echo set_radio('login_enabled', '1'); ?>  />
	<img src="<?=base_url()?>/assets/icons/1.png" /> Yes
	</label>
	
	
	<label for="login_enabled0" class="radiolabel">   
	<input type="radio" name="login_enabled" id="login_enabled0" value="0" <?php echo set_radio('login_enabled', '0'); ?> />
	<img src="<?=base_url()?>/assets/icons/0.png" /> No
	</label>
	</div>

	<div>
		<label>&nbsp;</label>
		<input type="submit" id="submit" name="submit" value="ADD NEW USER" class="button" />
	</div>
	</fieldset>
</form>
