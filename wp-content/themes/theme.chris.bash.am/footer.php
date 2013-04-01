<div id="footer">
	
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
	
	<ul>

		<li class="separators"><a href="http://creativecommons.org/licenses/by-nc-nd/3.0/" title="Creative Commons Attribution-Noncommercial-No Derivative Works 3.0 Unported">Copyright &copy;</a> 2007-<?php echo date('Y');?> <a href="<?php bloginfo('siteurl'); ?>">Chris Basham</a></li>
		
		<?php
		/*
		<li><a href="http://validator.w3.org/check/referer" title="Check the validity of this site&#8217;s XHTML">XHTML</a></li>
		
		<li><a href="http://jigsaw.w3.org/css-validator/check/referer" title="Check the validity of this site&#8217;s CSS">CSS</a></li>
		*/
		?>
	</ul>
	
	<hr/>
	
</div>

<?php wp_footer(); ?>

</body>

</html>