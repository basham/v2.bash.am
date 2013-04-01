<?php

// Theme Name: Portfolio
// Edit this file on your own risk!

add_action('admin_menu', 'portfolio_options'); // Theme Menu "Brightness Settings"
add_action('admin_head', 'portfolio_css'); // CSS For "Brightness Settings" Page


function is_in_category ($category = '') {
	global $wp_query;
	return ( $category == get_cat_ID($wp_query->query_vars["category_name"]) );
}


function pf_image($text) { preg_match("/\[image\](.+?)\[\/image\](.*)/is", $text, $text2); echo $text2[1]; }
function pf_client($text) { preg_match("/\[client\](.+?)\[\/client\](.*)/is", $text, $text2); if ($text2[1] !== NULL) { echo 'Client: <span>'.$text2[1].'</span><br />'; } }
function pf_company($text) { preg_match("/\[company\](.+?)\[\/company\](.*)/is", $text, $text2); if ($text2[1] !== NULL) { echo 'Company: <span>'.$text2[1].'</span><br />'; } }
function pf_work($text) { preg_match("/\[work\](.+?)\[\/work\](.*)/is", $text, $text2); if ($text2[1] !== NULL) { echo 'Work: <span>'.$text2[1].'</span><br />'; } }
function pf_uri($text) { preg_match("/\[link\](.+?)\[\/link\](.*)/is", $text, $text2); if ($text2[1] !== NULL) { echo 'Link: <span>'.$text2[1].'</span><br />'; } }
function pf_description($text) { preg_match("/\[description\](.+?)\[\/description\](.*)/is", $text, $text2); if ($text2[1] !== NULL) { echo $text2[1]	; } }

function portfoliocategory() { // Display Category list on "Portfolio Theme Settings" Page
	$fcat = wp_dropdown_categories('orderby=id&order=ASC&hide_empty=0&echo=0');
	$fcat = str_replace("\n", "", $fcat);
	$fcat = str_replace("\t", "", $fcat);
	$fcat = str_replace("<select name='cat' id='cat' class='postform' ><option value=\"", "", $fcat);
	$fcat = str_replace("</option><option value=\"", "_", $fcat);
	$fcat = str_replace("\">", "-", $fcat);
	$fcat = str_replace("</option></select>", "", $fcat);
	
	echo "<select name=\"portfoliocategory\" id=\"portfoliocategory\">";
	
	$fcat = explode("_", $fcat);
	foreach($fcat as $category)
	{

		$category = explode("-", $category);
		$cat_number = $category[0];
		$cat_name = $category[1];
	
			echo "<option name=\"$cat_number\"";
				if (get_option("portfoliocategory") == "$cat_name id:$cat_number") { echo ' selected="selected"'; }
			echo ">$cat_name id:$cat_number</option>";

	} // End Foreach;

	echo "</select>";
	
}

function portfolio(){ // Updates "Portfolio Theme Settings" Page Form
    if(isset($_POST['submitted']) && $_POST['submitted'] == "yes"){
        //Get form data
		
		$cvemailaddress = stripslashes($_POST['cvemailaddress']);
		$headquote = stripslashes($_POST['headquote']);
		$pflogo = stripslashes($_POST['pflogo']);
		$bgcolor = stripslashes($_POST['bgcolor']);
		$bgimage = stripslashes($_POST['bgimage']);
		$bgrepeat = stripslashes($_POST['bgrepeat']);
		$bgposition = stripslashes($_POST['bgposition']);
		$hqbgcolor = stripslashes($_POST['hqbgcolor']);
		$hqtxtcolor = stripslashes($_POST['hqtxtcolor']);
		$hqhlcolor = stripslashes($_POST['hqhlcolor']);
		$hqfontfamily = stripslashes($_POST['hqfontfamily']);
		$hqfontsize = stripslashes($_POST['hqfontsize']);
		$pfimgbordercolor = stripslashes($_POST['pfimgbordercolor']);
		$pftitlecolor = stripslashes($_POST['pftitlecolor']);
		$pftitlefontfamily = stripslashes($_POST['pftitlefontfamily']);
		$pftitlefontsize = stripslashes($_POST['pftitlefontsize']);
		$pftextcolor = stripslashes($_POST['pftextcolor']);
		$pfhltextcolor = stripslashes($_POST['pfhltextcolor']);
		$portfoliocategory = stripslashes($_POST['portfoliocategory']);
		$pffontfamily = stripslashes($_POST['pffontfamily']);
		$pfbottomborder = stripslashes($_POST['pfbottomborder']);
		$pftextsize = stripslashes($_POST['pftextsize']);
		$cvname = stripslashes($_POST['cvname']);
		$cvnationality = stripslashes($_POST['cvnationality']);
		$cvbirth = stripslashes($_POST['cvbirth']);
		$cvprimaryschool = stripslashes($_POST['cvprimaryschool']);
		$cvhighschool = stripslashes($_POST['cvhighschool']);
		$cvcollege = stripslashes($_POST['cvcollege']);
		$cvtraining = stripslashes($_POST['cvtraining']);
		$cvprimaryschool = stripslashes($_POST['cvprimaryschool']);
		$cvawards = stripslashes($_POST['cvawards']);
		$cvhomeaddress = stripslashes($_POST['cvhomeaddress']);
		$endword = stripslashes($_POST['endword']);
		$cvimage = stripslashes($_POST['cvimage']);
		$describe = stripslashes($_POST['describe']);
		$cvtelephone = stripslashes($_POST['cvtelephone']);
		$cvwork = stripslashes($_POST['cvwork']);
		$cvschool = stripslashes($_POST['cvschool']);
		$title = stripslashes($_POST['title']);

		update_option("cvname", $cvname);
		update_option("title", $title);
		update_option("cvnationality", $cvnationality);
		update_option("cvbirth", $cvbirth);
		update_option("cvhighschool", $cvhighschool);
		update_option("cvcollege", $cvcollege);
		update_option("cvtraining", $cvtraining);
		update_option("cvprimaryschool", $cvprimaryschool);
		update_option("cvawards", $cvawards);
		update_option("pftextsize", $pftextsize);		
		update_option("pfbottomborder", $pfbottomborder);
		update_option("pffontfamily", $pffontfamily); 
		update_option("portfoliocategory", $portfoliocategory);
		update_option("headquote", $headquote);
		update_option("pflogo", $pflogo);
		update_option("bgcolor", $bgcolor);
		update_option("bgimage", $bgimage);
		update_option("bgrepeat", $bgrepeat);
		update_option("bgposition", $bgposition);
		update_option("hqbgcolor", $hqbgcolor);
		update_option("hqtxtcolor", $hqtxtcolor);
		update_option("hqhlcolor", $hqhlcolor);
		update_option("hqfontfamily", $hqfontfamily);
		update_option("hqfontsize", $hqfontsize);
		update_option("pfimgbordercolor", $pfimgbordercolor);
		update_option("pftitlecolor", $pftitlecolor);
		update_option("pftitlefontfamily", $pftitlefontfamily);
		update_option("pftitlefontsize", $pftitlefontsize);
		update_option("pftextcolor", $pftextcolor);
		update_option("pfhltextcolor", $pfhltextcolor);
		update_option("cvemailaddress", $cvemailaddress);
		update_option("cvhomeaddress", $cvhomeaddress);
		update_option("endword", $endword);
		update_option("cvimage", $cvimage);
		update_option("describe", $describe);
		update_option("cvtelephone", $cvtelephone);
		update_option("cvwork", $cvwork);
		update_option("cvschool", $cvschool);


		
		
	
        echo "<div id=\"message\" class=\"updated fade\"><p><strong>Your settings have been saved.</strong></p></div>";
    }
	
		
?>

<div class="wrap">
	
	<form method="post" name="brightness" target="_self">
		
		<h2>Portfolio Category:</h2>
		<p>You have to put your work in a single category. Select it from your categories list.</p>
		<table class="form-table">
			<tr>
				<th>
					Portfolio Category:
				</th>
				<td>
					<?php portfoliocategory(); ?>
				</td>
			</tr>
		</table>

		<div style="height: 15px; display: block; width: 100%;"></div>
		<h2>Head Quote</h2>
		<p>Head Quote is the introductive paragraph displayed on the header of your website. (<a href="<?php bloginfo('template_directory'); ?>/images/help/headquote.jpg" alt="HeadQuote" />see img</a>).
		<table class="form-table">
			<tr>
				<th class="row">
					Head Quote Text
				</th>
				<td>
					<p style="margin: 0px 0px 5px 0px;">
						Use &lt;strong&gt;&lt;/strong&gt; for highlighted words.
					</p>
					<textarea name="headquote" cols="60" rows="7" id="headquote"><?php echo get_option("headquote"); ?></textarea>
				</td>
			</tr>
		</table>
		
		
		<div style="height: 15px; display: block; width: 100%;"></div>
		<h2>Theme Customization</h2>
		<p>Here you can edit colors, images. Make your theme more unique!</p>
		<table class="form-table">
			<tr>
				<th class="row">
					Edit your logo!
				</th>
				<td>
					<p style="margin: 0px 0px 5px 0px;">
						<strong>Image must have: 350px width / 150px height.</strong><br />
						Enter the image url.
					</p>
					<input type="text" name="pflogo" value="<?php echo get_option('pflogo'); ?>" />
				</td>
			</tr>
			<tr>
				<th class="row">
					Edit your theme Colors!
				</th>
				<td>
					<div class="themecolors">
						<div>
							<h3>Background Settings:</h3>
							<p>Edit your background color, image, repeat and position.</p>
							
							<div>
							<strong>Background Color:</strong>
							<input type="text" name="bgcolor" value="<?php echo get_option('bgcolor'); ?>" />
							</div>
							<div>
							<strong>Background Image:</strong>
							<input type="text" name="bgimage" value="<?php echo get_option('bgimage'); ?>" />
							</div>
							<div>
							<strong>Background Repeat:</strong>
							<select name="bgrepeat">
								<option value="no-repeat"<?php if(get_option('bgrepeat') == "no-repeat") { echo ' selected="selected"'; } ?>>no-repeat</option>
								<option value="repeat-x"<?php if(get_option('bgrepeat') == "repeat-x") { echo ' selected="selected"'; } ?>>repeat-x</option>
								<option value="repeat-y"<?php if(get_option('bgrepeat') == "repeat-y") { echo ' selected="selected"'; } ?>>repeat-y</option>
							</select>
							</div>
							<div>
							<strong>Background Position:</strong>
							<input type="text" name="bgposition" value="<?php echo get_option('bgposition'); ?>" />
							</div>
						</div>
						<div>
							<h3>Headquote Settings:</h3>
							<p>Edit your headquote background and colors:</p>
							<div>
							<strong>Headquote Background Color:</strong>
								<input type="text" name="hqbgcolor" value="<?php echo get_option('hqbgcolor'); ?>" />
							</div>
							<div>
							<strong>Headquote Text Color:</strong>
								<input type="text" name="hqtxtcolor" value="<?php echo get_option('hqtxtcolor'); ?>" />
							</div>
							<div>
							<strong>Headquote Highlighted Text Color:</strong>
								<input type="text" name="hqhlcolor" value="<?php echo get_option('hqhlcolor'); ?>" />
							</div>
							<div>
							<strong>Headquote Font Family:</strong>
								<input type="text" name="hqfontfamily" value="<?php echo get_option('hqfontfamily'); ?>" />
							</div>
							<div>
							<strong>Headquote Font Size:</strong>
								<input type="text" name="hqfontsize" value="<?php echo get_option('hqfontsize'); ?>" />
							</div>
						</div>
						<div>
							<h3>Portfolio Items Settings:</h3>
							<p>Edit portfolio image border, text colors and anything else.</p>
							<div>
							<strong>Portfolio Image Border Color:</strong>
								<input type="text" name="pfimgbordercolor" value="<?php echo get_option('pfimgbordercolor'); ?>" />
							</div>
							<div>
								<strong>Portfolio Title Color:</strong>
								<input type="text" name="pftitlecolor" value="<?php echo get_option('pftitlecolor'); ?>" />
							</div>
							<div>
								<strong>Portfolio Title Font Family:</strong>
								<input type="text" name="pftitlefontfamily" value="<?php echo get_option('pftitlefontfamily'); ?>" />
							</div>
							<div>
								<strong>Portfolio Title Font Size:</strong>
								<input type="text" name="pftitlefontsize" value="<?php echo get_option('pftitlefontsize'); ?>" />
							</div>
							<div>
								<strong>Portfolio Text Font Family:</strong>
								<input type="text" name="pffontfamily" value="<?php echo get_option('pffontfamily'); ?>" />
							</div>
							<div>
								<strong>Portfolio Text Color:</strong>
								<input type="text" name="pftextcolor" value="<?php echo get_option('pftextcolor'); ?>" />
							</div>
							<div>
								<strong>Portfolio Text Size:</strong>
								<input type="text" name="pftextsize" value="<?php echo get_option('pftextsize'); ?>" />
							</div>
							<div>
								<strong>Portfolio Hightlighted Text Color:</strong>
								<input type="text" name="pfhltextcolor" value="<?php echo get_option('pfhltextcolor'); ?>" />
							</div>
							<div>
								<strong>Portfolio Item Bottom Border:</strong>
								<input type="text" name="pfbottomborder" value="<?php echo get_option('pfbottomborder'); ?>" />
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
		
		<div style="height: 15px; display: block; width: 100%;"></div>
		<h2>Curriculum Vitae</h2>
		<p>You can add a Curriculum Vitae Page to your Portfolio Blog. Add you Information Here</p>
		<table class="form-table">
			<tr>
				<th class="row">
					About You!
				</th>
				<td>
					<div class="themecolors">
						<div>
							<h3>General Info</h3>
							<p>Your Name, Your Title, just basic info.</p>
							
							<div>
								<strong>Your Name:</strong>
								<input type="text" name="cvname" value="<?php echo get_option('cvname'); ?>" />
							</div>
							<div>
								<strong>Your Title:<br />(e.g.: "Freelance Web Designer, Lover, Football Player")</strong>
								<input type="text" name="title" value="<?php echo get_option('title'); ?>" />
							</div>
							<div>
								<strong>Your Photo:<br />(320px width recommended)</strong>
								<input type="text" name="cvimage" value="<?php echo get_option('cvimage'); ?>" />
							</div>
						</div>
						<div>
							<h3>Describe yourself</h3>
							<p>A short paragraph about yourself.</p>
							<textarea name="describe" cols="52" rows="3"><?php echo get_option('describe'); ?></textarea>
						</div>
						<div>
							<h3>Personal Info</h3>
							<p>Email, Telephone, Home Address..</p>
							
							<div>
								<strong>Email Address:</strong>
								<input type="text" name="cvemailaddress" value="<?php echo get_option('cvemailaddress'); ?>" />
							</div>
							<div>
								<strong>Home Address:</strong>
								<input type="text" name="cvhomeaddress" value="<?php echo get_option('cvhomeaddress'); ?>" />
							</div>
							<div>
								<strong>Telephone:</strong>
								<input type="text" name="cvtelephone" value="<?php echo get_option('cvtelephone'); ?>" />
							</div>
							<div>
								<strong>Nationality:</strong>
								<input type="text" name="cvnationality" value="<?php echo get_option('cvnationality'); ?>" />
							</div>
							<div>
								<strong>Date of Birth:</strong>
								<input type="text" name="cvbirth" value="<?php echo get_option('cvbirth'); ?>" />
							</div>
						</div>
						<div>
							<h3>Education and Training</h3>
							<p>School, Highschool, etc.</p>
							
							<div>
								<strong>Primary School(s):</strong>
								<textarea name="cvschool" cols="50" rows="3"><?php echo get_option('cvschool'); ?></textarea>
							</div>
							<div>
								<strong>High Schools(s):</strong>
								<textarea name="cvhighschool" cols="50" rows="3"><?php echo get_option('cvhighschool'); ?></textarea>
							</div>
							<div>
								<strong>College:</strong>
								<textarea name="cvcollege" cols="50" rows="3"><?php echo get_option('cvcollege'); ?></textarea>
							</div>
							<div>
								<strong>Special Training:</strong>
								<textarea name="cvtraining" cols="50" rows="3"><?php echo get_option('cvtraining'); ?></textarea>
							</div>
						</div>
						<div>
							<h3>Work Experience</h3>
							<p>Where and for how long you have worked.</p>
							<textarea name="cvwork" cols="52" rows="3"><?php echo get_option('cvwork'); ?></textarea>
						</div>
						<div>
							<h3>Awards</h3>
							<p>Oscars, Grammies, you know, regular stuff.</p>
							<textarea name="cvawards" cols="52" rows="3"><?php echo get_option('cvawards'); ?></textarea>
						</div>
						<div>
							<h3>Ending Word</h3>
							<p>Something sweet for your clients.</p>
							<textarea name="endword" cols="52" rows="3"><?php echo get_option('endword'); ?></textarea>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input name="submitted" type="hidden" value="yes" />
			<input type="submit" name="Submit" value="Update &raquo;" />
		</p>
	</form>
	<table class="form-table">
		<tr>
			<th class="row">
				Donate! Help DailyWP.com!
			</th>
			<td>
				<p style="margin: 0px;">Brightness Theme is FREE! Help DailyWP.com to stay alive and provide more and more free stuff!</p>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
</form></p>
			</td>
		</tr>
	</table>
</div>

<?php 
}

function portfolio_options() { // Adds Dashboard Menu Item
	add_menu_page('Portfolio Theme Settings', 'Portfolio Theme Settings', 'edit_themes', __FILE__, 'portfolio');
}

function portfolio_css() { // Adds Dashboard Head Style
	echo "
		<style type=\"text/css\">
			.themecolors div { display: block; background: #ffffff; padding: 15px; margin-bottom: 10px;}
			.themecolors div div { padding: 0px 0px 0px 10px; border-left: solid 4px #CCD9E3; padding-bottom: 15px; }
			.themecolors div div strong { display: block; }
			.themecolors div h3 { margin: 0px 0px 0px 0px; font-size: 20px; }
			.themecolors div p { margin: 3px 0px 20px 0px; }
		</style>
	";
}

?>