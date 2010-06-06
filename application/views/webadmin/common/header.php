<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php if(isset($meta_title)) echo $meta_title; ?></title>
	<link rel="stylesheet" href="<?=base_url();?>assets/css/admin.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?=base_url();?>assets/css/admin.form.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?=base_url();?>assets/css/jquery-ui-1.8.2.custom.css" type="text/css" media="screen" />
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

<script type="text/javascript" language="JavaScript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" language="JavaScript">
	google.load("jquery", "1.4.2");
	google.load("jqueryui", "1.8.2");
</script>

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
