<?php get_header(); ?>

<h1>My name is <a href="/about/">Chris Basham</a>.<p>I'm a web developer and designer with the <strong>passion</strong> and <strong>knowledge</strong> to create the <strong>extraordinary</strong>. Though my <a href="/about/">journey</a> has only begun, let me <a href="/">share</a> with you what I've learned along the way.</p></h1>
				
<div class="body">
	
	<div class="col5-3-wrap">
	
			<div class="col5">

				<h4>Latest Project</h4>
				
				<h2>Lakeview Church</h2>
				
				<p>Fall 2007, I redesigned the website for <a href="http://www.lakeviewchurch.org/">Lakeview Church</a> of Indianapolis, IN. With the help of Network and System's Manager, <a href="http://infotech.lakeviewchurch.org/">David Szpunar</a>, we converted the site fully to WordPress.</p>
				
				<p><a href="http://www.lakeviewchurch.org/">
					<img src="http://chris.bash.am/wp-content/uploads/2008/09/lvc.jpg" width="560" height="530" alt="Lakeview Church Homepage" title="Lakeview Church Homepage" />
				</a></p>
				
				<p class="links">Project section coming soon. I promise. Crossing fingers as of <em>September 6, 2008</em>.</p>

			</div>
			
			<div class="col3">

				<div id="digg-widget-container" class="widget">
					<h3 class="loading"><small>Recent</small> Digg Stories</h3>
					<div class="widget-body">
						<ul></ul>
						<p class="meta"></p>
					</div>
				</div>
				
				<div id="delicious-widget-container" class="widget">
					<h3 class="loading"><small>Recent</small> Del.icio.us Bookmarks</h3>
					<div class="widget-body">
						<ul></ul>
						<p class="meta"></p>
					</div>
				</div>
				
			</div>
		
		<hr/>
		
	</div>
	
</div>

<?php

function scriptIt($value) {
	$a = '<script type="text/javascript" src="' . get_bloginfo('template_url');
	$b = '"></script>';
	return ( $a . $value . $b );
}

function widgets() {
	$js = '';
	// Helper Scripts
	$js .= scriptIt( '/js/jquery-1.2.6.min.js' );
	$js .= scriptIt( '/js/pretty.js' );
	// Delicious API service is faster, so put it first
	$js .= scriptIt( '/js/delicious-widget.js' );
	$js .= scriptIt( '/js/digg-widget.js' );
	echo $js;
}

add_action('wp_footer', 'widgets');

?>

<?php get_footer(); ?>
