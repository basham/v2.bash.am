<?php // catreorderer functions
//echo "<!-- catreorderer functions -->";
?>

<?php 
function croer_get_meta() {
	global $wpdb;
 	$meta_result = mysql_query("SELECT * FROM ".$wpdb->prefix."croer_meta  ");
	$meta_old = array();
	if($meta_result) {
		while ($row = mysql_fetch_array($meta_result)) {
			//echo "fetch array:";
			//print_r($row);
			// init
			for($i = 1; $i <= 4; $i++) {
				$meta_old[$row['term_type'].$row['term_id']][$i] = '';
			}
			$meta_old[$row['term_type'].$row['term_id']][$row['term_rank']] = 'checked';
			$meta_old[$row['term_type'].$row['term_id']]['limit_to'] = $row['limit_to']; 
		}
	}
	//echo "meta old<br>";
	//print_r ($meta_old);
 	return $meta_old;
}

function croer_get_sorted($croer_cat) {
	global $wpdb;
	$query= "SELECT * ".
	 "FROM ".$wpdb->prefix."croer_posts ".
	 "LEFT JOIN $wpdb->posts ".
	 "ON ".$wpdb->prefix."croer_posts.post_id = $wpdb->posts.ID ".
	 "WHERE ".$wpdb->prefix."croer_posts.cat_id = $croer_cat ".
	 "ORDER BY ".$wpdb->prefix."croer_posts.post_rank ASC ";
	//echo $query;
	 return mysql_query($query);
}
function croer_get_just_sorted($croer_cat) {
	global $wpdb;
	$query= "SELECT post_id, post_rank ".
	 "FROM ".$wpdb->prefix."croer_posts ".
	 "WHERE cat_id = $croer_cat ".
	 "ORDER BY ".$wpdb->prefix."croer_posts.post_rank ASC ";
	
	 return mysql_query($query);
}


function present_posts($croer_cat) {
	//echo "croer_cat=".$croer_cat;
	$sorts = croer_get_sorted($croer_cat);
	 $placecount = 1;
	 $sorts_list = array();
	  ?>


<form action="?page=astickypostorderer&croer=1&cat=<?php echo $croer_cat; ?>" method="post" target="_self">
	  <table class="widefat">
	    <thead>
	  		<tr>
				<th width="50" scope="col">Position</th>
				<th width="50" style="text-align: center" scope="col">ID</th>
				<th scope="col">Title</th>
				<th width="100" scope="col">Send To</th>
			</tr></thead>
			<tbody id="asc-list">
			<tr><td colspan="4" style='text-align: left'><hr><strong>Sorted:</strong></td>
			</tr> <?php
	 while ($row= mysql_fetch_array($sorts)) {
	 	extract($row);
		showrow($placecount, $ID, $post_title, $post_name, $guid);
		
		$sorts_list[$placecount-1] = $ID;
	 	$placecount++;
	 }
	 // include posts in 'child' categories
	 array();
	$c_cat_and_subcats = "($croer_cat".get_category_children($croer_cat,',','').")";
	global $wpdb;
	if ( $croer_cat != 0) {
		//  Cat
	 	$query= "SELECT * ".
	 	"FROM $wpdb->posts JOIN ($wpdb->term_relationships, $wpdb->term_taxonomy) ".
		"ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id AND $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) ".
		"WHERE  $wpdb->term_taxonomy.term_id IN $c_cat_and_subcats AND post_type = 'post'";
		//echo "br>".$query;
	} else {
		// not cat
		$query= "SELECT * ".
	 	"FROM $wpdb->posts JOIN ($wpdb->term_relationships, $wpdb->term_taxonomy) ".
		"ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id AND $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) ".
		"WHERE  post_type = 'post'";
	}
	 
	 $query.="ORDER BY ID DESC ";
	 //echo "<br>Q:".$query;
	 $result = mysql_query($query);
	 
	 ?><tr><td colspan="4" style='text-align: left'><hr><strong>Un-sorted:</strong></td>
  </tr><?php
  $unsorts_shown = array();
	 while ($row= mysql_fetch_array($result)) {
	 	extract($row);
		
		if ((!in_array($ID, $sorts_list))&&(!in_array($ID, $unsorts_shown))) {
			
			showrow($placecount, $ID, $post_title, $post_name, $guid);
			$unsorts_shown[] = $ID;
			$placecount++;
		} 	
	 } 
	 ?><tr><td colspan="4">
	 <input name="croer_cat" type="hidden" value="<?php echo $croer_cat; ?>">
	 <input name="submit" type="submit" value="Save and Refresh"></td></tr></tbody></table></form>
	 <br><?php
} 
function showrow($placecount, $ID, $post_title, $post_name, $guid) {
	echo "<tr";
	if ($placecount%2>0) {
		echo " class='alternate'";
	}
	echo ">";
	echo "<th scope='row' style='text-align: center'>".$placecount."</th>";
	echo "<td style=\"text-align: center\">".$ID."</td>";
	//echo "<td><a href=\"http://www.davidkrutpublishing.com/dkp/?p=".$ID."\" title=\"".$post_name."\" target=\"_blank\">".$post_title."</a></td>";
	echo "<td><a href=\"".$guid."\" title=\"".$post_name."\" target=\"_blank\">".$post_title."</a></td>";
	echo "<td><input name=\"pid".$ID."\" type=\"text\" size=\"5\" maxlength=\"5\">"."</td>";
	echo "</tr>";
}
//


function c_catname($cat) {/*
	global $wpdb;
	$cat_sql= "SELECT name ".
		"FROM $wpdb->term_taxonomy LEFT JOIN $wpdb->terms ".
		"ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ".
		"WHERE $wpdb->terms.term_id = $cat ";
	
	
	
	$cat_result = mysql_query($cat_sql);
	while ($row= mysql_fetch_array($cat_result)) {
		extract($row);
		return $name;
	}*/
}
?>