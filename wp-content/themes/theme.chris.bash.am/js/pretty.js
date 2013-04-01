/*
 * JavaScript Pretty Date
 * Copyright (c) 2008 John Resig (jquery.com)
 * Licensed under the MIT license.
 */

// Takes an ISO time and returns a string representing how
// long ago the date represents.
function prettyDate(time, notUnix){
	var date = !notUnix ? new Date(time * 1000) : new Date((time || "").replace(/-/g,"/").replace(/[TZ]/g," "));
	var	diff = (((new Date()).getTime() - date.getTime()) / 1000),
		day_diff = Math.floor(diff / 86400);
			
	if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 )
		return;
			
	return day_diff == 0 && (
			diff < 60 && "just now" ||
			diff < 120 && "1 minute ago" ||
			diff < 3600 && Math.floor( diff / 60 ) + " minutes ago" ||
			diff < 7200 && "1 hour ago" ||
			diff < 86400 && Math.floor( diff / 3600 ) + " hours ago") ||
		day_diff == 1 && "Yesterday" ||
		day_diff < 7 && day_diff + " days ago" ||
		day_diff < 31 && Math.ceil( day_diff / 7 ) + " weeks ago";
}

// If jQuery is included in the page, adds a jQuery plugin to handle it as well
if ( typeof jQuery != "undefined" )
	jQuery.fn.prettyDate = function(){
		return this.each(function(){
			var date = prettyDate(this.title);
			if ( date )
				jQuery(this).text( date );
		});
	};


function prettyLongDate(time, notUnix, ignoreTime, tzOffset){
	//var date = new Date(time * 1000);
	var date = !notUnix ? new Date(time * 1000) : new Date((time || "").replace(/-/g,"/").replace(/[TZ]/g," "));
	if (tzOffset)
		date.setHours( date.getHours() + tzOffset );
	var	diff = (((new Date()).getTime() - date.getTime()) / 1000),
		day_diff = Math.floor(diff / 86400);
			
	if ( isNaN(day_diff) || day_diff < 0 )
		return;
	
	var h = date.getHours();
	var H = h % 12 == 0 ? 12 : h % 12;
	var am = h < 12;
	var t = H + ':' + date.getMinutes() + ' ' + (am ? "AM" : "PM");
	
	var d = MONTH[date.getMonth()] + ' ' + date.getDate() + ', ' + date.getFullYear();

	return day_diff == 0 && (
			diff < 60 && "just now" ||
			diff < 120 && "<strong>1</strong> minute ago" ||
			diff < 3600 && "<strong>" + Math.floor( diff / 60 ) + "</strong> minutes ago" ||
			diff < 7200 && "<strong>1</strong> hour ago" ||
			diff < 86400 && "<strong>" + Math.floor( diff / 3600 ) + "</strong> hours ago") ||
		day_diff == 1 && "<strong>" + (ignoreTime ? '' : ( t + ' ' ) ) + "Yesterday</strong>" ||
		day_diff > 1 && "<strong>" + (ignoreTime ? '' : ( t + ' ' ) ) + d + "</strong>";
}

var MONTH = [];
MONTH[0] = "January";
MONTH[1] = "February";
MONTH[2] = "March";
MONTH[3] = "April";
MONTH[4] = "May";
MONTH[5] = "June";
MONTH[6] = "July";
MONTH[7] = "August";
MONTH[8] = "September";
MONTH[9] = "October";
MONTH[10] = "November";
MONTH[11] = "December";
