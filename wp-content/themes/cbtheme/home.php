<?php get_header(); ?>

<div id="headline">

	<h1>My name is <a href="/about/">Chris Basham</a>.</h1>
	
	<p>I'm a web developer and designer with the <strong>passion</strong> and <strong>knowledge</strong> to create the <strong>extraordinary</strong>.<br/>Though my <a href="/about/">journey</a> has only begun, let me <a href="/">share</a> with you what I've learned along the way.</p>
	
</div>
				
<div class="body">
	
	<div class="col5-3-wrap">
	
			<div class="col5">

				<h4>Featured Project</h4>
				
				<h2><span>January <strong>2008</strong></span><a href="http://chris.bash.am/portfolio/reitz-football-photo-archive/">Reitz Football Photo Archive</a></h2>

					<p><a href="http://chris.bash.am/portfolio/reitz-football-photo-archive/">
					<img src="http://chris.bash.am/wp-content/uploads/2008/12/reitzfootballarchive-main.jpg" alt="Reitz Football Photo Archive" width="560" />
					</a></p>

					<p>The Reitz Football Photo Archive is a Flash-based <strong>interactive CD</strong> containing over 1,100 photographs highlighting the <a href="http://www.reitzfootball.com/results.php?year=2007" onclick="javascript:pageTracker._trackPageview ('/outbound/www.reitzfootball.com');">2007 undefeated football season</a> of <a href="http://www.evscschools.com/reitz" onclick="javascript:pageTracker._trackPageview ('/outbound/www.evscschools.com');">F.J. Reitz High School</a> of Evansville, Indiana, ranging from early summer practices to the <a href="http://www.courierpress.com/news/2007/nov/24/reitz-and-lowell/" onclick="javascript:pageTracker._trackPageview ('/outbound/www.courierpress.com');">IHSAA Class 4A State Championship</a>. Proceeds from the disc sales are donated to the school.</p>
				
				<p class="links"><a href="/portfolio/reitz-football-photo-archive/"><strong>Read More</strong></a></p>

			</div>
			
			<div class="col3">

				<div id="twitter-widget-container" class="widget">
					<h3 class="loading"><small>Recent</small> Twitter Updates</h3>
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
	//$js .= scriptIt( '/js/delicious-widget.js' );
	$js .= scriptIt( '/js/twitter-widget.js' );
	//$js .= scriptIt( '/js/digg-widget.js' );
	echo $js;
}

add_action('wp_footer', 'widgets');

?>

<?php get_footer(); ?>
