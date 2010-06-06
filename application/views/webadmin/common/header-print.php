<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php if(isset($meta_title)) echo $meta_title; ?></title>
	<link rel="stylesheet" href="<?=base_url();?>assets/css/admin.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?=base_url();?>assets/css/admin-print.css" type="text/css" media="print" />
	<link rel="stylesheet" href="<?=base_url();?>assets/css/admin.form.css" type="text/css" media="screen" />

	<?php
	/* additional css */
	if(isset($css_file) && is_array($css_file)):
	
		foreach($css_file as $css):
	?>
<link rel="stylesheet" href="<?=base_url();?>assets/css/<?=$css?>" type="text/css" media="screen" />
	<?php
		endforeach;

	endif;
	?>
	<?php
	/* additional javascripts */
	if(isset($javascript_file) && is_array($javascript_file)):
	
		foreach($javascript_file as $js):
	?>
<script language="JavaScript" type="text/javascript" src="<?=base_url();?>assets/javascripts/<?=$js?>"></script>
	<?php
		endforeach;

	endif;
	?>

</head>
<body>

<div id="wrapper">
