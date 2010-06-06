<h1>Create New Module</h1>
<p><?=anchor($this->config->item('admin_folder').'/module/view',' &laquo; back to Module List')?></p>

<form class="webform" method="post" action="" >
	<fieldset>
	<legend>Module Information</legend>

	<div>
	<label>Menu Group:</label>
	<select id="menu_id" name="menu_id">
		<option value="">Please select</option>
		<?php foreach($menu_options as $menu):?>
		<option value="<?=$menu->menu_id?>" <?php echo set_select('menu_id', $menu->menu_id); ?>  ><?=$menu->menu_title?></option>
		<?php endforeach;?>
	</select>
	</div>

	<div>
	<label>Module Name:</label>
	<input type="text" id="module_name" name="module_name" value="<?=set_value('module_name')?>"  />
	</div>

	<div>
	<label>Access Path <em>(class/method)</em>:</label>
	<input type="text" id="access_path" name="access_path" value="<?=set_value('access_path')?>" />
	</div>

    <div>
		<label> Show on menu? </label>

		<label for="show_on_menu1" class="radiolabel">
		<input type="radio" name="show_on_menu" id="show_on_menu1" value="1" <?php echo set_checkbox('show_on_menu', '1'); ?> />
		<img src="<?=base_url()?>/assets/icons/1.png" /> Yes
		</label>

		<label for="show_on_menu0" class="radiolabel">
		<input type="radio" name="show_on_menu" id="show_on_menu0" value="0" <?php echo set_checkbox('show_on_menu', '0'); ?> />
		<img src="<?=base_url()?>/assets/icons/0.png" /> No
		</label>

	</div>

    <div>
		<label> Module Enabled? </label>

		<label for="module_enabled1"  class="radiolabel">
		<input type="radio" name="module_enabled" id="module_enabled1" value="1"  <?php echo set_checkbox('module_enabled', '1'); ?> />
		<img src="<?=base_url()?>/assets/icons/1.png" /> Enabled
		</label>

		<label for="module_enabled0"  class="radiolabel">
		<input type="radio" name="module_enabled" id="module_enabled0" value="0"  <?php echo set_checkbox('module_enabled', '0'); ?> />
		<img src="<?=base_url()?>/assets/icons/0.png" /> Disabled
		</label>

	</div>

	<div>
		<label>Module Description:</label>
		<textarea name="module_description" id="module_description" ></textarea>
	</div>

	<div>
		<label>&nbsp;</label>
		<input name="submit" value="ADD MODULE" type="submit" class="button" />
	</div>

	</fieldset>

</form>