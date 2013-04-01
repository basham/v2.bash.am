<?php get_header(); ?>

<?php 
$portfoliocategory = get_option('portfoliocategory');
$portfoliocategory = explode("id:", $portfoliocategory);
$portfoliocategory = $portfoliocategory[1];
if (is_category("$portfoliocategory")) { ?>

<div id="headline">
	<h1><?php echo $wp_query->queried_object->name ?></h1>
</div>
					
<div class="body">

	<div class="col5-3">
	
		<div class="col5 archive">
		
	<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
			
		<?php
			$link = get_post_custom_values("project-link");
			$link = $link != NULL ? $link[0] : NULL;
			$image = get_post_custom_values("image-preview");
			$image = $image != NULL ? $image[0] : NULL;
		?>
		
		<h2><span><?php the_time('F'); ?> <strong><?php the_time('Y'); ?></strong></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<?php if ($image) : ?>
		<p><a href="<?php the_permalink(); ?>">
			<img src="<?=$image?>" alt="<?php the_title(); ?>" width="560" />
		</a></p>
		<?php endif; ?>
		
		<p><?php the_excerpt(); ?></p>

		<hr/>
		
		<?php endwhile; ?>
			
	<?php endif; ?>
		
		</div>
	
		<hr/>
		
	</div>
	
</div>

<?php } ?>

<?php get_footer(); ?>
