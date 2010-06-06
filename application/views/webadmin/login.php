<?php $this->load->view($this->config->item('admin_folder').'/common/header');?>

<?php $this->load->view($this->config->item('admin_folder').'/common/top-logo');?>

<div class="clear" style="margin-top:10px;"></div>

<div class="boxLogin">

<form method="post" action="" >
<h1>Control Panel Login</h1>
<p>
	<strong>User Name</strong><br/>
	<input type="text" name="user_username"  value="" class="inputBox" />
</p>

<p>
	<strong>Password </strong><br/>
	<input type="password" name="user_password" id="user_password" value="" class="inputBox" />
</p>

<p>
	<strong>Please enter the keywords below: </strong><br/>
	<?php echo $recaptcha_html?>
</p>

<p>
	<input type="submit" id="submit" name="submit" value="LOGIN" class="buttonLogin" />	
</p>

</form>
</div>


<?php $this->load->view($this->config->item('admin_folder').'/common/flash_message'); ?>

<?php $this->load->view($this->config->item('admin_folder').'/common/footer');?>
