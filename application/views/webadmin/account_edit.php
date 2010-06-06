<h1>Your Account</h1>

<form action="" method="post" class="webform">
<fieldset>
<legend>Updating Your Details</legend>
<div>
	<label>User Name: <strong></strong></label>
	<input type="text" id="user_username" name="user_username" value="<?=$user->user_username?>" disabled="true" />
</div>

<div>
	<label>Name:</label>
	<input type="text" id="name" name="name" value="<?=set_value('name',$user->name)?>" />
</div>

<div>
	<label>Phone:</label>
	<input type="text" id="phone" name="phone" value="<?=set_value('phone',$user->phone)?>" />
</div>

<div>
	<label>Email:</label>
	<input type="text" id="email" name="email" value="<?=set_value('email',$user->email)?>" />
</div>

<div>
	<label>&nbsp;</label>
	<input type="submit" id="submit" name="submit" value="UPDATE DETAILS" class="button" />
<div>
</fieldset>
</form>