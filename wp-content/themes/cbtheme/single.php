<?
/*
Template Name: Single Portfolio
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	
<?php

$content = get_the_content();
//$content = apply_filters('the_content', $content);
//$content = str_replace(']]>', ']]&gt;', $content);

$columns = explode('<!--column-->', $content);

$col1 = $columns[0];
$col2 = $columns[1];

?>

<div id="headline">
	<h1><?php the_title(); ?></h1>
</div>

<div class="body">
	
	<div class="col1 image-header">
		<img src="<?php echo get_post_meta($post->ID, 'image-header', true); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	</div>
	
	<div class="col2-wrap">
	
		<div class="col2">
			
			<p class="lead"><?php the_excerpt(); ?></p>
		
			<?php echo $col1; ?>
		
		</div>
		
		<div class="col2">
			
			<h3>Summary</h3>
			
			<?php echo get_post_meta($post->ID, 'summary', true); ?>
			
			<?php echo $col2; ?>
			
		</div>
		
		<hr/>
	
	</div>
	
</div>


	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
