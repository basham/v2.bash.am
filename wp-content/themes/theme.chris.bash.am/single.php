<?
/*
Template Name: Single Portfolio
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	

<h1><?php the_title(); ?></h1>


<div class="body">
				
	<div class="col5-3-wrap">
	
		<div class="col5">
					<ul class="thumblist">
			
			<li style="margin-right:1.5em"><a href="#">
				<img width="90" height="90" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>PING Plateform</strong>
			</a></li>
			
			<li style="margin-right:1.5em"><a href="#">
				<img width="90" height="90" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>CSS Zen Garden</strong>
			</a></li>

			<li style="margin-right:1.5em"><a href="#">
				<img width="90" height="90" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>Memberbase</strong>
			</a></li>
			
			<li style="margin-right:1.5em"><a href="#">
				<img width="90" height="90" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>PING Plateform</strong>
			</a></li>
			
			<li><a href="#">
				<img width="90" height="90" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>CSS Zen Garden</strong>
			</a></li>
			
			</ul>
			
			<hr/>

			<ul class="thumblist">
			
			<li style="margin-right:2em; width: 9.5em"><a href="#">
				<img width="85" height="85" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>PING Plateform</strong>
			</a></li>
			
			<li style="margin-right:2em; width: 9.5em"><a href="#">
				<img width="85" height="85" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>CSS Zen Garden</strong>
			</a></li>

			<li style="margin-right:2em; width: 9.5em"><a href="#">
				<img width="85" height="85" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>Memberbase</strong>
			</a></li>
			
			<li style="margin-right:2em; width: 9.5em"><a href="#">
				<img width="85" height="85" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>PING Plateform</strong>
			</a></li>
			
			<li style="width: 9.5em"><a href="#">
				<img width="85" height="85" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>CSS Zen Garden</strong>
			</a></li>
			
			</ul>
			
			<hr/>
			
<?php the_content(); ?>
		
		</div>
		
		<div class="col3">
		
			<h3><small>More</small> Projects</h3>

			<ul class="thumblist">
			
			<li><a href="#">
				<img width="90" height="60" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>PING Plateform</strong>
			</a></li>
			
			<li style="margin-right:1em"><a href="#">
				<img width="90" height="60" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>CSS Zen Garden</strong>
			</a></li>

			<li><a href="#">
				<img width="90" height="60" title="Reitz Journalism Homepage" alt="Reitz Journalism Homepage" src="http://localhost:8888/wp-content/uploads/2008/08/rj-screenshot-01.jpg"/>
				<strong>Memberbase</strong>
			</a></li>
			
			</ul>
			
			<hr/>
			
			<p class="links"><a href="#"><strong>View All Projects</strong></a></p>
		
		</div>
		
		<hr/>
	
	</div>
	
</div>


	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
