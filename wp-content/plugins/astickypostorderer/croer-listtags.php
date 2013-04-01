<?php 
// list choice of tags for which to re arrange posts
?>

<h3><?php _e('Tags') ?></h3>
<table class="widefat">
   <thead>
	<tr>
	  <th scope="col" style="text-align: center" rowspan="2"><?php _e('ID') ?></th>
	  <th scope="col" rowspan="2"><?php _e('Tag Name') ?></th>
	  <th scope="col" colspan="4" style="text-align: center"><?php _e('Meta-stickyness') ?></th>
	  <th scope="col" width="90" style="text-align: center" rowspan="2"><?php _e('sorted / in&nbsp;tag.') ?></th>
	</tr>
	<tr>
	  <th scope="col" style="text-align: center">Super-sticky [Limit]</th>
	  <th scope="col" style="text-align: center">Sub-sticky</th>
	  <th scope="col" style="text-align: center">Default</th>
	  <th scope="col" style="text-align: center">Droppy</th>
	</tr>
  </thead>
  <tbody id="tag-list"><tr><td><?php $croer_tagslist = croer_tag_list(); // was 'croer_cat_rows()' 
  $croer_started = false;
  foreach($croer_tagslist as $croer_tag) {
  	//if ($croer_started) { echo ",&nbsp; "; }
	if ($tr_count%2>0) {
			$c_rowstyle = " class='alternate'";
		} else {
			$c_rowstyle = "";
		}
	$croer_started = true;
  	//http://localhost/wp-test/wp-admin/edit.php?page=astickypostorderer&cat=5
	$croer_tagid = $croer_tag[term_id];
	if((!$meta_old['tag'.$croer_tagid])||($meta_old['tag'.$croer_tagid] == 0)) {	$meta_old['tag'.$croer_tagid]['0'] = 'checked'; }
	if($meta_old['tag'.$croer_tagid]['limit_to'] == '0') { $meta_old['tag'.$croer_tagid]['limit_to'] = ''; }
  	$croer_item = " <tr $c_rowstyle><td>$croer_tagid</td><td>".
		"<a href=\"?page=astickypostorderer&cat=$croer_tagid\" title=\"$croer_tag[slug]\" >$croer_tag[name]</a></td><td style='text-align: center'>".
		//.
		"<input name='tag$croer_tagid' type='radio' value='1' ".$meta_old['tag'.$croer_tagid]['1']." >".
		"<input name='tag_limit$croer_tagid' type='text' size='3' maxlength='3' value='".$meta_old['tag'.$croer_tagid]['limit_to']."'></td><td style='text-align: center'>".
		"<input name='tag$croer_tagid' type='radio' value='2' ".$meta_old['tag'.$croer_tagid]['2']."></td><td style='text-align: center'>".
		"<input name='tag$croer_tagid' type='radio' value='0' ".$meta_old['tag'.$croer_tagid]['0']."></td><td style='text-align: center'>".
		"<input name='tag$croer_tagid' type='radio' value='4' ".$meta_old['tag'.$croer_tagid]['4']."></td><td style='text-align: center'>".
		" $croer_tag[sort_count]/$croer_tag[count]</td></tr>";
		echo $croer_item;
		$tr_count++;
  }
  ?>
  </tbody>
</table>

<?php  
function croer_tag_list() {
	global $wpdb;
	$query= "SELECT *, COUNT(post_rank) FROM $wpdb->term_taxonomy ".
		"LEFT JOIN $wpdb->terms ON ( $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ) ".
		"LEFT JOIN ".$wpdb->prefix."croer_posts ON ( $wpdb->term_taxonomy.term_id =  ".$wpdb->prefix."croer_posts.cat_id) ".
		"WHERE taxonomy = 'post_tag' ".
		//"AND count >1 ".
		"GROUP BY term_taxonomy_id ".
		"ORDER BY $wpdb->terms.name ASC LIMIT 0,100 "; // 
	 
	 $result =  mysql_query($query);
	 $croer_tagslist = array();
	 $croer_tagcount=0;
	 while($row = mysql_fetch_array($result)) {
	 	//print_r($row);
		extract($row);
		//echo $cat_id."-".$name.$count.", ";
		$croer_tagcount++;
		$croer_tagslist[$croer_tagcount]['term_id'] = $term_id;
		$croer_tagslist[$croer_tagcount]['name'] = $name;
		$croer_tagslist[$croer_tagcount]['slug'] = $slug;
		$croer_tagslist[$croer_tagcount]['count'] = $count;
		$croer_tagslist[$croer_tagcount]['sort_count'] = $row['COUNT(post_rank)'];
		//print_r($croer_tagslist[$croer_tagcount]);
	 }
	 return $croer_tagslist;
}
?>
