<h1>Add User Group</h1>

<p><?=anchor($this->config->item('admin_folder').'/group/view',' &laquo; back to User Group List')?></p>

<form action="" method="post" class="webform"> 

<div>
<label>Group Name</label>
<input type="text" id="group_name" name="group_name" value="<?=set_value('group_name')?>" />
</div>

<div>
<label>Group Enabled/Disabled?</label>
<label for="group_enabled1" class="radiolabel">  
<input type="radio" name="group_enabled" id="group_enabled1" value="1" <?=set_radio('group_enabled',1)?>  />
<img src="<?=base_url()?>/assets/icons/1.png" /> Enabled
</label>


<label for="group_enabled0" class="radiolabel">  
<input type="radio" name="group_enabled" id="group_enabled0" value="0" <?=set_radio('group_enabled',0)?> />
<img src="<?=base_url()?>/assets/icons/0.png" /> Disabled
</label>
</div>

<div>
<label>Group Description</label>
<textarea name="group_description" id="group_description" class="textBox"></textarea>
</div>

<div>
	<label>&nbsp;</label>
	<input type="submit" id="submit" name="submit" value="ADD NEW USER GROUP" class="button" />
</div>
</form>