<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height,initial-scale=0.5, maximum-scale=1">
	<title><?php print trim(wp_title('', false)); ?><?php if(wp_title('', false)) { echo ' | '; } ?><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<script src="<?php bloginfo('template_directory'); ?>/js/compressed/modernizr.js"></script>
	<?php wp_head(); ?>

	<script>window.jQuery || document.write('<script src="<?php bloginfo('template_directory'); ?>/js/compressed/jquery.min.js"><\/script>')</script>
	<script type='text/javarscript' src='<?php bloginfo('template_directory'); ?>/js/paper.js' ></script>
	<script type='text/javarscript' src='<?php bloginfo('template_directory'); ?>/js/secondary.js' ></script>
	<script type='text/paperscript' src='<?php bloginfo('template_directory'); ?>/js/script.js' canvas='myCanvas'></script>

</head>

<body <?php body_class(); ?>>
    <div id="main" role="main">

			<canvas id='myCanvas' resize></canvas>
				<div id='container'>
