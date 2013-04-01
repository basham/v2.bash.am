
/**
*
* MODIFIED FROM DIGG WIDGET JS SCRIPT
* http://digg.com/tools/widgetjs
*
**/




digg_id = typeof digg_id  == 'string' ? ''+digg_id+''  : 'digg-widget-container';
digg_total = 0;
digg_user = "chrisbasham";




document.write('<script type="text/javascript" src="http://digg.com/tools/services?type=javascript&callback=diggwa&endPoint=/user/' + digg_user + '/dugg&count=5&size=a"></script>');

document.write('<script type="text/javascript" src="http://digg.com/tools/services?type=javascript&callback=diggwb&endPoint=/user/' + digg_user + '/diggs&count=5"></script>');

document.write('<script type="text/javascript" src="http://digg.com/tools/services?type=javascript&callback=diggwc&endPoint=/user/' + digg_user + '"></script>');




function diggwa(obj) {

    if (!$) setTimeout(function() { diggwb(obj); }, 200); //hack for IE not loading scripts that are included via document.write until it decides too
    $('#'+digg_id+' ul').html('');

	var appender = function( a ) {
		var s = '';
		s += '<li>';
	
			s += '<a href="' + a.href + '?OTC-widget">';
						if (a.thumbnail)
				s += '<img width="' + a.thumbnail.width + '" height="' + a.thumbnail.height + '" src="' + a.thumbnail.src + '" title="' + a.title + '"/>';		
			s += a.title + '</a>';
			s += '<p>';
				s += '<span id="digg-dugg-date-' + a.id + '"></span>';
				s += '<strong>' + a.diggs + '</strong> diggs';
			s += '</p>';
		s += '</li>';
		return s;
	};
	
    if(!obj)
        $('#'+digg_id+' ul').html('<li class="error">We were unable to retrieve matching stories from Digg. Please refresh the page to try again.</li>');

    if(!obj.stories || obj.stories.length == 0)
        $('#' + digg_id + ' ul').html('<li class="error">There are no recent stories on Digg.</li>');

	for (var i = 0 ; i < obj.stories.length ; i++) {
		if(obj.stories[i].diggs > 10000)
			obj.stories[i].diggs = Math.floor(obj.stories[i].diggs/1000) + 'K+';
		$('#' + digg_id + ' ul').append( appender( obj.stories[i] ) );
	}
}

function diggwb(obj) {
	for ( var i = 0; i < obj.diggs.length; i++ )
		$('#digg-dugg-date-' + obj.diggs[i].story).html( 'dugg ' + prettyLongDate(obj.diggs[i].date) + ', ' );
	digg_total = obj.total;
}

function diggwc(obj) {
	var u = obj.users[0];
	$('#' + digg_id + ' p.meta').html( '<a href="http://digg.com/" class="digg">Digging</a> <strong>' + digg_total + '</strong> stories since ' + prettyLongDate(u.registered, false, true) + '.<br/>Appreciating the <strong>' + u.profileviews + '</strong> <a href="http://digg.com/users/' + digg_user + '">profile views</a>. How\'s my left side?' );

	$("#" + digg_id + " h3").toggleClass("loading");
}

