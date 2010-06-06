<form method="post" action="" class="webform">
<fieldset>
	<legend>Control Panel Login</legend>
<div>
	<label>User Name</label>
	<input type="text" name="user_username"  value=""  />
</div>

<div>
	<label>Password </label>
	<input type="password" name="user_password" id="user_password" value="" />
</div>

<div>
	<?php echo $recaptcha_html?>
</div>

<div>
	<label>&nbsp;</label>
	<input type="submit" id="submit" name="submit" value="LOGIN" class="button" />	
</div>
</fieldset>
</form>