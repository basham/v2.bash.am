<?
/*
Template Name: 2 Column Page
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	

<h1><?php the_title(); ?></h1>


<div class="body">
				
	<div class="col2-wrap">
	
			
<?php the_content(); ?>
		
		
		<hr/>
	
	</div>
	
</div>


	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
