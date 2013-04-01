
/**
*
* MODIFIED FROM DIGG WIDGET JS SCRIPT
* http://digg.com/tools/widgetjs
*
**/




twitter_id = typeof twitter_id  == 'string' ? '' + twitter_id + ''  : 'twitter-widget-container';
twitter_user = "chrisbasham";
twitter_count = 4;


document.write('<script type="text/javascript" src="http://search.twitter.com/search.json?from=' + twitter_user + '&rpp=' + twitter_count + '&callback=twitter_widget"></script>');




function twitter_widget(obj) {

    if (!$) setTimeout(function() { twitter_widget(obj); }, 200); //hack for IE not loading scripts that are included via document.write until it decides too
    $('#' + twitter_id + ' ul').html('');

	profile_url = 'http://twitter.com/' + twitter_user;
	
    if (!obj)
        $('#'  +twitter_id + ' ul').html('<li class="error">Sorry, @<a href="' + profile_url + '">' + twitter_user + '</a>, what were you just saying? I don\'t see your tweets anywhere. [Blackout]</li>');
   
	var appender = function( a, i ) {
		
		var t = a.text;
		// Replace URLs with a link of the URL
		t = t.replace(/([a-zA-Z]+:\/\/[\w.\?\/\%\#]+)/, '<a href="$1">$1</a>');
		// Replace a user reference to a link to the user's profile
		t = t.replace(/@([a-zA-Z0-9]+)/, '@<a href="http://twitter.com/$1">$1</a>');

		var s = '';
		s += '<li' + ( i == 0 ? ' class="first"' : '') + '>';
			s += t;
			s += ' <a href="' + profile_url + '/status/' + a.id + '" class="published-time">';
				s += 'about ' + prettyLongDate(a.created_at, true, true, 0);
			s += '</p>';
		s += '</li>';
		return s;
	};
	
    for (var i = 0 ; i < obj.results.length ; i++)
		$('#' + twitter_id + ' ul').append( appender(obj.results[i], i) );
		
	$('#' + twitter_id + ' p.meta').html( '<a href="' + profile_url + '" class="twitter">Twittering</a> in <= 140 characters since July 2008.' );

	$("#" + twitter_id + " h3").toggleClass("loading");
}
