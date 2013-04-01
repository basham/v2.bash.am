<div class="footer"><div class="col1">
	
	<h3><small>More</small> Projects</h3>

	<ul class="thumblist">
	
	<?php

		$portfolioCat = get_cat_id('portfolio');
		$posts = get_posts('numberposts='.$postsPerCat.'&category='.$portfolioCat);

		$i = 0;

		foreach($posts as $post) {
			$t = the_title('', '', false);
			$img = get_post_meta($post->ID, 'image-thumbnail', true);

			//if ($i % 2 == 0)
			//	echo '<ul class="thumblist">';

			echo '<li><a href="'.get_permalink().'">';
				echo '<img width="120" height="65" title="'.$t.'" alt="'.$t.'" src="'.$img.'"/>';
				echo '<strong>'.$t.'</strong>';
			echo '</a></li>';

			//if ($i % 2 == 1)
			//	echo '</ul><hr/>';

			$i++;
		}

	?>

	</ul>
	
	<hr/>
	
	<p class="links"><a href="<?php echo get_category_link($portfolioCat); ?>"><strong>All Projects &raquo;</strong></a></p>
				
	<hr/>
	
</div></div>
	
<div class="footer"><div class="col1">
	
	<ul>

		<li class="separator"><a href="http://creativecommons.org/licenses/by-nc-nd/3.0/" title="Creative Commons Attribution-Noncommercial-No Derivative Works 3.0 Unported">Copyright &copy;</a> 2007-<?php echo date('Y');?> <a href="<?php bloginfo('siteurl'); ?>">Chris Basham</a></li>
		
		<li><a href="http://validator.w3.org/check/referer" title="Check the validity of this site's XHTML">XHTML</a></li>
		
		<li class="separator"><a href="http://jigsaw.w3.org/css-validator/check/referer" title="Check the validity of this site's CSS">CSS</a></li>
		
		<li<?php echo $activeLink; ?>><a href="<?php bloginfo('siteurl'); ?>" title="Home">Home</a></li>

		<?php 
		
			$portfolioCat = get_cat_id('portfolio');
			
		?>
		
		<li><a href="<?php echo get_category_link($portfolioCat); ?>" title="Portfolio">Portfolio</a></li>
		
		<?php wp_list_pages('sort_column=menu_order&title_li=&depth=1'); ?>	

	</ul>
	
	<hr/>
	
</div></div>

<?php wp_footer(); ?>

</body>

</html>