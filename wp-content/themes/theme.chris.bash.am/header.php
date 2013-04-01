<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

    <title><?php wp_title(" | ", true, "right"); ?><?php bloginfo('name'); ?></title>
    
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="distribution" content="global" />
	<meta name="robots" content="follow, all" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
    
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_head(); ?>
	
</head>

<body>

<div id="header">

	<h1><a href="<?php bloginfo('siteurl'); ?>"><strong>chris</strong>.<span>bash</span>.<span>am</span></a></h1>
	
	<ul>
	
		<?php
			$activeClass = " class=\"current_page_item\"";
			$activeLink = is_home() ? $activeClass : "";
		?>

		<li<?php echo $activeLink; ?>><a href="<?php bloginfo('siteurl'); ?>" title="Home">Home</a></li>

		<?php 
			$portfolioCat = get_option('portfoliocategory');
			$portfolioCat = explode(" id:", $portfolioCat);
			$portfolioCat = $portfolioCat[1];
			$activeLink = is_in_category( $portfolioCat ) ? $activeClass : "";
		?>
		
		<?php
		/*
		<li<?php echo $activeLink; ?>><a href="<?php echo get_category_link("$portfolioCat"); ?>" title="Portfolio">Portfolio</a></li> 
		*/
		?>
		
		<?php wp_list_pages('sort_column=menu_order&title_li=&depth=1'); ?>	
			
	</ul>
		
	<hr/>
	
</div>
