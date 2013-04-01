
/**
*
* MODIFIED FROM DIGG WIDGET JS SCRIPT
* http://digg.com/tools/widgetjs
*
**/




delicious_id = typeof delicious_id  == 'string' ? ''+delicious_id+''  : 'delicious-widget-container';
delicious_user = "cbasham";



document.write('<script type="text/javascript" src="http://feeds.delicious.com/v2/json/' + delicious_user + '?count=5&callback=delwa"></script>');

document.write('<script type="text/javascript" src="http://feeds.delicious.com/v2/json/userinfo/' + delicious_user + '?callback=delwb"></script>');




function delwa(obj) {

    if (!$) setTimeout(function() { delwa(obj); }, 200); //hack for IE not loading scripts that are included via document.write until it decides too
    $('#' + delicious_id + ' ul').html('');

    if (!obj)
        $('#'  +delicious_id + ' ul').html('<li class="error">We were unable to retrieve matching stories from Digg. Please refresh the page to try again.</li>');
   
	var appender = function( a ) {
		var s = '';
		s += '<li>';
			s += '<a href="' + a.u + '">' + a.d + '</a>';
			s += '<p class="inline">';
				s += 'saved ' + prettyLongDate(a.dt, true, true, 8);
			s += '</p>';
		s += '</li>';
		return s;
	};
	
    for (var i = 0 ; i < obj.length ; i++)
		$('#' + delicious_id + ' ul').append( appender(obj[i]) );
}

function delwb(obj) {

	var delicious_total = 0;

	for ( var i = 0; i < obj.length; i++ )
		if (obj[i].id == "items")
			delicious_total = obj[i].n;

	$('#' + delicious_id + ' p.meta').html( '<a href="http://delicious.com/" class="delicious">Bookmarking</a> <strong>' + delicious_total + '</strong> sites since <strong>April 11, 2008</strong>.<br/>Craving <a href="http://delicious.com/' + delicious_user + '">more delicious bookmarks</a>? Satisfy your hunger.' );
	
	$("#" + delicious_id + " h3").toggleClass("loading");
}
