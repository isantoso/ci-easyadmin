<?php $this->load->view($this->config->item('admin_folder').'/common/header-print');?>

<div class="clear" style="margin-top:10px;"></div>

<div id="content">
	<?php if($template_main && is_array($template_main)):?>
		<?php foreach($template_main as $template):?>
			<?php $this->load->view($this->config->item('admin_folder').'/'.$template);?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>

<div class="clear"></div>

<?php $this->load->view($this->config->item('admin_folder').'/common/footer-print');?>