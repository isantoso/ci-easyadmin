<h1>Add Menu Group</h1>

<p><?=anchor($this->config->item('admin_folder').'/menu/view',' &laquo; back to Menu List')?></p>

<form action="" method="post" class="webform"> 

<div>
	<label>Menu Title</label>
	<input type="text" id="menu_title" name="menu_title" value="<?=set_value('menu_title') ?>" />
</div>

<div>
	<label>&nbsp;</label>
	<input type="submit" id="submit" name="submit" value="ADD MENU" class="button" />
</div>

</form>
