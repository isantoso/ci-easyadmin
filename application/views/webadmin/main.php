<?php $this->load->view($this->config->item('admin_folder').'/common/header');?>

<?php $this->load->view($this->config->item('admin_folder').'/common/top-logo');?>

<div class="clear" style="margin-top:10px;"></div>

<div id="menu" >
<?php $this->load->view($this->config->item('admin_folder').'/common/menu');?>
</div>

<div id="content">

	<?php if($template_main && is_array($template_main)):?>
		<?php foreach($template_main as $template):?>
			<?php $this->load->view($this->config->item('admin_folder').'/'.$template);?>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php /* display any error validation or notice */ ?>
	<?php $this->load->view($this->config->item('admin_folder').'/common/flash_message'); ?>

</div>

<div class="clear"></div>

<?php $this->load->view($this->config->item('admin_folder').'/common/footer');?>
