<?php if($this->session->flashdata('flash_message') <> ''): ?>
<div class="dialog" title="Notice">
	<strong><?php echo $this->session->flashdata('flash_message'); ?></strong>
</div>
<?php endif ?>

<?php if(function_exists('validation_errors') && strlen(validation_errors()) > 0): ?>
	<div class="dialog" title="Uh OH">
		<?php echo validation_errors(); ?>
	</div>
<?php endif;?>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
	
	if($(".dialog").length > 0){
		$(".dialog").dialog({
			'modal':true,
			buttons: {
					Ok: function() {
						$(this).dialog('close');
					}
				},
			hide: 'fade',
			width:420
		});
	}
	
	});

</script>