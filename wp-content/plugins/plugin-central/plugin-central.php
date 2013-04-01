<?php
  /*
   Plugin Name: Plugin Central
   Plugin URI: http://www.prelovac.com/vladimir/wordpress-plugins/plugin-central
   Description: <strong>Wordpress 2.5+ only.</strong> Automatically installs and updates WordPress plugins.
   Version: 1.52
   Author: Vladimir Prelovac
   Author URI: http://www.prelovac.com/vladimir/
   
   Copyright 2008  Vladimir Prelovac
   
   */
  $plugincentral_localversion = "1.52";
  $plugincentral_plugin_url = trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
  
  function apu_handle_download($plugin_name, $package)
  {
      apu_update_plugin_advanced($plugin_name, $package);
      //apu_update_plugin( $plugin_name, $package);
  }
  function apu_row($file, $p, $update = 0)
  {
      $current = get_option('update_plugins');
      $options = get_option('pc_ignored_plugins');
      
      if (!isset($current->response[$file]) || ($options && in_array($file, $options)))
          return 0;
      
      
      $r = $current->response[$file];
      
      
      if (empty($r->package))
          printf(__('<li>%1$s %3$s <a href="%2$s">download</a> <em>(automatic update unavailable)</em>.</li>'), $p['Name'], $r->url, $r->new_version);
      else {
          if ($update == 1) {
              //Check now, It'll be deactivated by the next line if it is,
              $was_activated = is_plugin_active($file);
              
              echo "<li><b>" . $p['Name'] . "</b>";
              echo '<iframe style="border:0" width="100%" height="170px" src="' . wp_nonce_url("update.php?action=upgrade-plugin&amp;plugin=$file", 'upgrade-plugin_' . $file) . '"></iframe>';
              
              echo "</li>";
              $return = 2;
          } else {
              if (!in_array($file, get_option('active_plugins'))) {
                  printf(__('<li>%1$s %3$s - <a href="%2$s">download</a>, <a href="%4$s">update</a>, <a href="javascript:verifyPlugin(\'%5$s\', \'Are you sure you want to ignore future updates of this plugin?\')">ignore</a> or <a href="javascript:verifyPlugin(\'index.php?action=pc_delete&file=' . $file . '\', \'Are you sure you want to delete this plugin? Do this at your own risk!\')">delete</a></li>'), $p['Name'], $r->url, $r->new_version, wp_nonce_url("update.php?action=upgrade-plugin&amp;plugin=$file", 'upgrade-plugin_' . $file), urlencode("index.php?action=pc_ignore&file=" . $file . "&name=" . $p["Name"]));
              } else
                  printf(__('<li><strong>%1$s %3$s</strong> - <a href="%2$s">download</a>, <a href="%4$s">update</a> or <a href="javascript:verifyPlugin(\'%5$s\', \'Are you sure you want to ignore future updates of this plugin?\')">ignore</a></li>'), $p['Name'], $r->url, $r->new_version, wp_nonce_url("update.php?action=upgrade-plugin&amp;plugin=$file", 'upgrade-plugin_' . $file), urlencode("index.php?action=pc_ignore&file=" . $file . "&name=" . $p["Name"]));
          }
      }
      
      return 1;
  }
  
  function apu_dash_install()
  {
      echo '<p><a id="extra-toggle" href="#">Install new plugin</a></p>';
?>
  <div id="extra">
  
  
  <form name="form_apu" method="post" action="plugins.php?page=plugin-central/plugin-central.php">
  <?php
      wp_nonce_field('plugin-central');
?>
  <div class="submit">
  <p>Enter the plugin Name or URL to the plugin zip installation file:<br>
  <input id="multi_plugins"  name="multi_plugins" value="" size="70"/>     
  <input type="submit" name="apu_update" value="Install Plugin &raquo;" />
  <p><a href="index.php?page=plugin-central/plugin-central.php">Install multiple plugins</a></p>
  </div>
  </p>
  
  </form>
  </p>
  </div> <?php
  }
  
  function apu_dash()
  {
      if (!current_user_can('edit_plugins')) {
          return;
      }
      echo '<br /><h4>Plugin Central</h4>';
      
      if ('upgrade-plugins' == $_GET['action']) {
          $plugins = get_plugins();
          
          echo "<p>";
          echo "<ul>";
          foreach ($plugins as $file => $p) {
              $result += apu_row($file, $p, 1);
          }
          echo "</ul></p>";
          
          if ($result == 0) {
              echo "<p>All plugins are up to date.</p>";
          }
          
          apu_dash_install();
          
          return;
      }
      
      if ('pc_delete' == $_GET['action']) {
          $file = $_GET['file'];
          
          echo "<p>";
          delete_plugin($file);
          echo "</p>";
      }
      if ('pc_ignore' == $_GET['action']) {
          $file = $_GET['file'];
          $name = $_GET['name'];
          
          
          $options = get_option('pc_ignored_plugins');
          if ($options && !array_search($file, $options))
              $options = array_merge($options, array($file));
          elseif (!$options)
              $options = array($file);
          
          update_option(pc_ignored_plugins, $options);
          
          echo "<p>$name added to ignore list.</p>";
      }
              
      wp_update_plugins();
      
      $plugins = get_plugins();
      
      $result = 0;
      echo "<p><ul>";
      
      foreach ($plugins as $file => $p) {
          $result += apu_row($file, $p);
      }
      echo "</ul></p>";
      
      if ($result == 0) {
          echo "<p>All plugins are up to date.</p>";
      } else {
          echo '<p><a href="index.php?action=upgrade-plugins">Update All</a><p>';
      }
                  
      apu_dash_install();
  }
  
  
  function apu_head()
  {
     ?>
<script type="text/javascript">

function verifyPlugin(url, text){
    if (confirm(text)){
      document.location = url;
    }
    return void(0);
  }


jQuery(document).ready( function() {
   jQuery("#extra").css("display","none");
  
   jQuery("#extra-toggle").click(function(){
       jQuery("#extra").toggle("fast");
  });

});
</script>
<?php
  }
  
  global $wp_version;
  if (version_compare($wp_version, "2.5", "<"))
      exit(sprintf(__('Plugin Central requires WordPress 2.5 or newer. <a href="%s" target="_blank">Please update first!</a>', 'dashspam'), 'http://codex.wordpress.org/Upgrading_WordPress'));
  
  add_action('admin_head', 'apu_head');
  
  add_action('activity_box_end', 'apu_dash');
  
  
  function apu_get_plugin($plugin_name)
  {
      $name = $plugin_name;
      $plugin = $plugin_name;
      $description = "";
      $author = "";
      $version = "0.1";
      
      $plugin_file = $name . ".php";
      
      
      return array('Name' => $name, 'Title' => $plugin, 'Description' => $description, 'Author' => $author, 'Version' => $version);
  }
  
  function apu_get_packages($plugins_arr)
  {
      global $wp_version;
      
      if (!function_exists('fsockopen'))
          return false;
      
      //send=0;
      foreach ($plugins_arr as $val) {
          $val = trim($val);
          
          if (end(explode(".", $val)) == 'zip')
              apu_handle_download("temp", $val);
          else {
              $plugins[plugin_basename($val . ".php")] = apu_get_plugin($val);
              $send = 1;
          }
      }
      
      //$plugins = get_plugins();
      
      if ($send) {
          $to_send->plugins = $plugins;
          
          $send = serialize($to_send);
          
          $request = 'plugins=' . urlencode($send);
          $http_request = "POST /plugins/update-check/1.0/ HTTP/1.0\r\n";
          $http_request .= "Host: api.wordpress.org\r\n";
          $http_request .= "Content-Type: application/x-www-form-urlencoded; charset=" . get_option('blog_charset') . "\r\n";
          $http_request .= "Content-Length: " . strlen($request) . "\r\n";
          $http_request .= 'User-Agent: WordPress/' . $wp_version . '; ' . get_bloginfo('url') . "\r\n";
          $http_request .= "\r\n";
          $http_request .= $request;
          
          //echo $http_request."<br><br>";
          
          $response = '';
          if (false != ($fs = @fsockopen('api.wordpress.org', 80, $errno, $errstr, 3)) && is_resource($fs)) {
              fwrite($fs, $http_request);
              
              while (!feof($fs))
                  // One TCP-IP packet
                  $response .= fgets($fs, 1160);
              fclose($fs);
              //echo $response;
              $response = explode("\r\n\r\n", $response, 2);
          }
          
          
          $response = unserialize($response[1]);
          
          foreach ($plugins_arr as $val) {
              if ($plugins[plugin_basename($val . ".php")]) {
                  if ($response) {
                      $r = $response[plugin_basename($val . ".php")];
                      if (!$r) {
                          echo '<strong><em>' . $val . ' not found</em></strong>. Try <a href="http://google.com/search?q=' . $val . ' +wordpress">manual</a> install.<br>';
                      } elseif ($r->package) {
                          echo "<br><strong>Found " . $r->slug . " " . $r->new_version . "!</strong><br>";
                          apu_handle_download($r->slug, $r->package);
                      } else
                          echo 'Package for <strong><em>' . $val . '</em></strong> not found. Try <a href="' . $r->url . '">manual</a> install.<br>';
                  } else
                      echo '<strong><em>' . $val . ' not found</em></strong>. Try <a href="http://google.com/search?q=' . $val . ' +wordpress">manual</a> install.<br>';
              }
          }
      }
  }
  
  function apu_unzip($file, $dir)
  {
      if (!current_user_can('edit_files')) {
          echo 'Oops, sorry you are not authorized to do this';
          return false;
      }
      if (!class_exists('PclZip')) {
          require_once(ABSPATH . 'wp-admin/includes/class-pclzip.php');
      }
      
      
      $unzipArchive = new PclZip($file);
      $list = $unzipArchive->properties();
      if (!$list['nb'])
          return false;
      //echo "Number of files in archive : ".$list['nb']."<br>";
      
      echo "Copying the files<br>";
      $result = $unzipArchive->extract(PCLZIP_OPT_PATH, $dir);
      if ($result == 0) {
          echo 'Could not unarchive the file: ' . $unzipArchive->errorInfo(true) . ' <br />';
          return false;
      } else {
          //print_r($result);
          foreach ($result as $item) {
              if ($item['status'] != 'ok')
                  echo $item['stored_filename'] . ' ... ' . $item['status'] . '<br>';
          }
          return true;
      }
  }
  
  
  function apu_copyFiles($dirFrom, $dirTo, $includeSubDirs = true)
  {
      if (!current_user_can('edit_files')) {
          echo 'Oops sorry you are not authorized to do this';
          return false;
      }
      
      //check if we have both the directories
      //older versions may now have new dirs so create them
      if (!$dir = opendir($dirTo)) {
          mkdir($dirTo . "/", 0757);
          //chmod($dirTo, 0757);
          closedir($dirTo);
      }
      
      if ($sourceFiles = opendir($dirFrom)) {
          //echo '<br /><strong>Copying over files</strong> from '.$dirFrom.' to '.$dirTo.'<br />';
          closedir($dirFrom);
          $dir = dir($dirFrom);
          chmod($dirFrom, 0757);
          
          while ($item = $dir->read()) {
              if ((is_dir($dirFrom . "/" . $item) && $item != "." && $item != "..") && $includeSubDirs) {
                  apu_copyFiles($dirFrom . "/" . $item, $dirTo . "/" . $item, $includeSubDirs);
              } else {
                  if ($item != "." && $item != ".." && !is_dir($dirFrom . "/" . $item)) {
                      echo "Copying " . $item . "<br>";
                      if (copy($dirFrom . "/" . $item, $dirTo . "/" . $item)) {
                          echo 'Overwriting file ' . $item . ' to ' . $dirTo . '<br/>';
                      } else {
                          echo 'ERROR -> Could not copy ' . $dirFrom . "/" . $item . ' to ' . $dirTo . "/" . '<br />';
                          return false;
                      }
                  }
              }
          }
      } else {
          echo 'ERROR -> Could not read either the source directory ' . $dirFrom . ' or the target directory ' . $dirTo . '<br />';
          return false;
      }
      return true;
  }
  
  
  
  function apu_update_plugin_advanced($plugin_name, $package)
  {
      echo "Downloading update from " . $package . "<br>";
      $file = download_url($package);
      
      if (is_wp_error($file)) {
          echo 'Download failed: ' . $file->get_error_message();
          return;
      }
      
      
      
      echo "Unpacking the plugin<br>";
      
      //plugin dir
      $result = apu_unzip($file, ABSPATH . PLUGINDIR . '/');
      
      // Once extracted, delete the package
      unlink($file);
      
      if ($result)
          echo "<br><strong>Plugin installed successfully.</strong><br><br>";
      else {
          echo "<br>Error installing the plugin.<br><br>You can try installing the plugin manually: <a href=\"$package\">$package</a><br><br>";
      }
      
      return;
  }
  
  
  function apu_update_plugin($plugin_name, $package)
  {
      global $wp_filesystem;
      
      
      
      
      if (!$wp_filesystem || !is_object($wp_filesystem))
          WP_Filesystem($credentials);
      
      
      if (!is_object($wp_filesystem)) {
          echo '<strong><em>Could not access filesystem.</strong></em><br><br>';
          return;
      }
      
      
      
      if ($wp_filesystem->errors->get_error_code()) {
          echo '<strong><em>Filesystem error ' . $wp_filesystem->errors->get_error_message() . '</strong></em><br><br>';
          return;
      }
      
      //Get the Base folder
      $base = $wp_filesystem->get_base_dir();
      
      if (empty($base)) {
          echo '<strong><em>Unable to locate WordPress directory.</strong></em><br><br>';
          return;
      }
      
      
      
      echo "Downloading file from " . $package . "<br>";
      $file = download_url($package);
      
      if (is_wp_error($file)) {
          echo '<strong><em>Download failed : ' . $file->get_error_message() . '</strong></em><br><br>';
          return;
      }
      
      //$working_dir = $base . 'wp-content/upgrade/' . basename($plugin, '.php');
      $working_dir = $base . 'wp-content/upgrade/' . $plugin_name;
      
      // Clean up working directory
      if ($wp_filesystem->is_dir($working_dir))
          $wp_filesystem->delete($working_dir, true);
      
      
      echo "Unpacking the plugin<br>";
      // Unzip package to working directory
      $result = unzip_file($file, $working_dir);
      if (is_wp_error($result)) {
          unlink($file);
          $wp_filesystem->delete($working_dir, true);
          echo '<strong><em>Unpack failed : ' . $result->get_error_message() . '</strong></em><br><br>';
          return;
      }
      
      // Once extracted, delete the package
      unlink($file);
      
      echo "Installing the plugin<br>";
      // Copy new version of plugin into place.
      if (!copy_dir($working_dir, $base . PLUGINDIR)) {
          //TODO: Uncomment? This DOES mean that the new files are available in the upgrade folder if it fails.
          $wp_filesystem->delete($working_dir, true);
          echo '<strong><em>Installation failed (plugin already installed?)</strong></em><br><br>';
          return;
      }
      
      //Get a list of the directories in the working directory before we delete it, We need to know the new folder for the plugin
      $filelist = array_keys($wp_filesystem->dirlist($working_dir));
      
      // Remove working directory
      $wp_filesystem->delete($working_dir, true);
      
      
      echo "<strong>Plugin installed successfully!</strong><br><br>";
      return;
  }
  
  function deltree($directory)
  {
      if (substr($directory, -1) == '/') {
          $directory = substr($directory, 0, -1);
      }
      if (!file_exists($directory) || !is_dir($directory)) {
          echo "'$directory' : Path doesn't exist or isn't a directory!<br>";
          return false;
      } else {
          //echo "Processing directory '$directory'...<br>";
          $handle = opendir($directory);
          while (false !== ($item = readdir($handle))) {
              if (($item != '.') && ($item != '..')) {
                  //$path = $directory . DIRECTORY_SEPARATOR . $item; //this just causes trouble
                  $path = $directory . '/' . $item;
                  if (is_dir($path) && !is_link($path)) {
                      if (!deltree($path)) {
                          return false;
                      }
                  } else {
                      //  echo "Deleting file $path<br>";
                      if (!unlink($path)) {
                          echo "Can't delete file '$path'<br>";
                          return false;
                      }
                  }
              }
          }
          closedir($handle);
          //  echo "Deleting directory $directory<br>" ;
          if (!rmdir($directory)) {
              echo "Can't delete directory '$directory'<br>";
              return false;
          }
          return true;
      }
  }
  
  
  function delete_plugin($plugin_file)
  {
      if (empty($plugin_file)) {
          return;
      }
      $plugin_dir = realpath(ABSPATH . PLUGINDIR . '/');
      //It seems that on some systems realpath() will strip out the last slash, so I'll add it here. 
      if ((substr($plugin_dir, -1) != '/') && (substr($plugin_dir, -1) != '\\')) {
          $plugin_dir .= '/';
      }
      
      //  echo "Deleting the plugin '$plugin_file'<br>";
      
      $parts = preg_split('/[\\/]/', $plugin_file);
      $parts = array_filter($parts);
      if (count($parts) > 1) {
          //the plugin is in a subfolder, so kill the folder
          $directory = $plugin_dir . $parts[0];
          //  echo "Deleting directory '$directory'...<br>";
          if (!deltree($directory)) {
              echo "Can't delete the directory <strong>$parts[0]</strong><br>";
          } else
              echo "Plugin deleted successfully.";
      } else {
          //it seems to be a single file inside wp-content/plugins
          //  echo "Deleting file '$plugin_file'<br>" ;
          if (!unlink($plugin_dir . $plugin_file)) {
              //error!
              echo "Failed.";
              echo "Can't delete <strong>$plugin_file</strong><br>";
          }
          echo "Plugin deleted successfully.<br>";
      }
      
      //  wp_redirect(get_option('siteurl').'/wp-admin/plugins.php');
      
      
      
  }
  
  
  
  // Admin Panel
  
  function apu_add_pages()
  {
      add_submenu_page('plugins.php', 'Plugin Central', 'Plugin Central', 10, __file__, 'apu_options_page');
  }
  
  
  
  // Options Page
  function apu_options_page()
  {
      global $plugincentral_plugin_url;
      
      $imgpath = $plugincentral_plugin_url . '/i';
      $action_url = $_SERVER['REQUEST_URI'];	
?>  
  <div class="wrap" style="max-width:950px !important;">
  <h2>Plugin Central</h2>
        
  <div id="poststuff" style="margin-top:10px;">
  
  <div id="sideblock" style="float:right;width:220px;margin-left:10px;"> 
     <h3>Information</h3>
     <div id="dbx-content" style="text-decoration:none;">
       <img src="<?php
      echo $imgpath
?>/home.png"><a style="text-decoration:none;" href="http://www.prelovac.com/vladimir/wordpress-plugins/plugin-central"> Plugin Central Home</a><br /><br />
       <img src="<?php
      echo $imgpath
?>/help.png"><a style="text-decoration:none;" href="http://www.prelovac.com/vladimir/forum"> Plugin Forums</a><br /><br />
       <img src="<?php
      echo $imgpath
?>/rate.png"><a style="text-decoration:none;" href="http://wordpress.org/extend/plugins/plugin-central/"> Rate Pluign Central</a><br /><br />
       <img src="<?php
      echo $imgpath
?>/more.png"><a style="text-decoration:none;" href="http://www.prelovac.com/vladimir/wordpress-plugins"> My WordPress Plugins</a><br /><br />
       <br />
    
       <p align="center">
       <img src="<?php
      echo $imgpath
?>/p1.png"></p>
      
       <p> <img src="<?php
      echo $imgpath
?>/idea.png"><a style="text-decoration:none;" href="http://www.prelovac.com/vladimir/services"> Need a WordPress Expert?</a></p>
     </div>
   </div>
  
   <div id="mainblock" style="width:710px">
   
    <div class="dbx-content">
       <form name="form_apu" method="post" action="<?php
      echo $action_url
?>">
       <?php
      wp_nonce_field('plugin-central');
      
      
      if (!current_user_can('edit_plugins')) {
          echo "You do not have sufficient permissions to manage plugins on this blog.<br>";
          return;
      }
      
      $result = '';
      // If form was submitted
      if (!defined('PHP_EOL'))
          define('PHP_EOL', strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? "\r\n" : "\n");
      
      if (isset($_POST['apu_update'])) {
          check_admin_referer('plugin-central');
          
          echo '<h3>Plugin installation</h3>';
          
          
          $plugin_install = !isset($_POST['multi_plugins']) ? '' : $_POST['multi_plugins'];
          
          if ($plugin_install != '') {
              $plugin_install = str_replace(array("\r\r\r", "\r\r", "\r\n", "\n\r", "\n\n\n", "\n\n"), "\n", $plugin_install);
              $options = explode("\n", $plugin_install);
              
              apu_get_packages($options);
          }
          echo '<br><br>';
      } elseif (isset($_POST['apu_all'])) {
          check_admin_referer('plugin-central');
          $active = get_option('active_plugins');
          $plugins = get_plugins();
          
          
          $result = "<p>";
          
          foreach ($plugins as $file => $p) {
              if (!in_array($file, $active))
                  // todo read readme.txt and extract correct plugin name!!
                  $result .= $p['Name'] . '<br>';
              else
                  // todo read readme.txt and extract correct plugin name!!
                  $result .= '<strong>' . $p['Name'] . '</strong><br>';
          }
          $result .= "</p>";
      } elseif (isset($_POST['apu_active'])) {
          check_admin_referer('plugin-central');
          $plugins = get_plugins();
          $active = get_option('active_plugins');
          
          
          $result = "<p>";
          
          foreach ($plugins as $file => $p) {
              if (in_array($file, $active))
                  $result .= $p['Name'] . '<br>';
          }
          $result .= "</p>";
      } elseif (isset($_GET['pc_no_ignore'])) {
          check_admin_referer('plugin-central');
          $options = get_option("pc_ignored_plugins");
          
          if ($options) {
              unset($options[array_search($_GET['pc_no_ignore'], $options)]);
              update_option('pc_ignored_plugins', $options);
          }
      }
      
      
      $options = get_option("pc_ignored_plugins");
      
      $ignored = '';
      
      if ($options)
          foreach ($options as $item) {
              $ignored .= "<a href=\"plugins.php?page=plugin-central/plugin-central.php&pc_no_ignore=$item\">$item</a><br>";
          }
      
      
      ?>
 
 <h3>Options</h3>
                            
<input class="button" type="submit" name="apu_all" value="List all plugins" class="button-primary"/>
<input class="button" type="submit" name="apu_active" value="List active plugins" class="button-primary"/>
 <?php echo $result ?>

<p class="submit">  
  <h3>Easy plugin Installation</h3>
  Enter the list of plugins to install.<br>You can specify either the Name or URL of the plugin zip installation file.<br>
  <textarea style="border:1px solid #D1D1D1;width:600px;" name="multi_plugins" id="multi_plugins" cols="40" rows="10"></textarea>
  <br>
  <input class="button" type="submit" name="apu_update" value="Install plugins &raquo;" class="button-primary"/>
</p>

<p>  
  <h3>Ignored Plugins</h3>
  This is the list of currently ignored plugins for update checks. 
  Click the link to restore normal status.<br><br>
  <?php echo  $ignored ?>
</p>


</form>

 

</div>
</div>



</div>


<h4>a plugin by <a href="http://www.prelovac.com/vladimir/">Vladimir Prelovac</a></h4>
</div>

<?php
  }
  
  // Add Options Page
  add_action('admin_menu', 'apu_add_pages');
?>