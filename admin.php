<?php

function GDPlayer_enqueue_color_picker() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'GDPlayer-admin', plugins_url('admin.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action('load-settings_page_GDPlayer-settings', 'GDPlayer_enqueue_color_picker');

function GDPlayer_menu() {
	global $GDPlayer_admin;
	$GDPlayer_admin = add_options_page('GD Player Settings', 'GD Player Settings', 'manage_options', 'GDPlayer-settings', 'GDPlayer_settings');
}
add_action('admin_menu', 'GDPlayer_menu');

/* Contextual Help */
function GDPlayer_help($contextual_help, $screen_in, $screen) {
	global $GDPlayer_admin;
	if ($screen_in == $GDPlayer_admin) {
		$contextual_help = <<<_end_
		<strong>GD Player Help</strong>
<p><strong>For more info about GD Player, please visit this Page. <a href="https://ingolin.com/gd-player-self-hosting-mp4-google-drive-videos-wordpress-plugin/" target="_blank" rel="nofollow noopener">GD Player WordPress Plugin</a></strong></p>
<p><strong>If you need help, please visit our website <a href="https://ingolin.com/gd-player-self-hosting-mp4-google-drive-videos-wordpress-plugin/" target="_blank" rel="nofollow noopener">Click Here</a></strong></p>
<p><strong>For more Shortcodes please visit this page <a href="https://ingolin.com/shortcodes-for-gd-player-wordpress-plugin/" target="_blank" rel="nofollow noopener">Click Here</a></strong></p>
_end_;
	}
	return $contextual_help;
}
add_filter('contextual_help', 'GDPlayer_help', 10, 3);


function GDPlayer_settings() {
    
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	?>
	
<div class="update-nag">
<a href="https://ingolin.com" target="_blank"><img src="<?php echo plugins_url('/GDPlayerPro.jpg', __FILE__ ) ?>" alt="GD Player" style="width:80px;height:80px; float:left;margin-right: 15px;"></a>
<h3 style="margin: 0 0 8px 0;"><a href="https://ingolin.com" target="_blank" rel="noopener">You Are Using GD Player Free!</a> <span style="color: #eb0000;"><strong> <span style="background-color: #ffff00;"> To Play Google Drive Videos You Need <a href="https://ingolin.com" target="_blank" rel="noopener"><span style="color: #0000ff;">(GD Player Pro)</span></a> </span></strong></span></h3>
With <strong>GD Player Free</strong> You Can Play Self-Hosting Videos, MP4, OGG, WebM With Subtitles, Skins-Two Types Of Player Style You Can Choose Openload Player Style Or JWPlayer Style (Skin) With GD Player Free You Can Set All Players Colors. &amp; if<strong> </strong>You Want To Play Google Drive Videos with <strong>Subtitles</strong>. You Need<a href="https://ingolin.com/" target="_blank" rel="noopener"><strong> GD Player Pro</strong></a> The Best Video Player WordPres Plugin.
<a href="https://ingolin.com/gd-player-self-hosting-mp4-google-drive-videos-wordpress-plugin/" target="_blank" rel="noopener">More info...</a>
</div>    

<div class="wrap">

<!--
<table class="wp-list-table widefat fixed bookmarks">
  <tr>
    <th>Table two columns th</th>    
    <th>Used by millions, Akismet is quite possibly the best way in the world to protect your blog from spam. It keeps your site protected even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) Sign up for an Akismet plan to get an API key, and 3) Go to your Akismet configuration page, and save your API key.</th>

  </tr>

</table>        
-->
        
        
        
<!--	<h2>Video.js Settings</h2>-->
        <h2><span class="dashicons dashicons-admin-generic" style="line-height: inherit;"></span> <?php echo NAME ?>
        Settings</h2>

	
	<form method="post" action="options.php">

<!--    <form action="" method="post">-->
  <input name="action" type="hidden" value="update">

  <table class="wp-list-table widefat fixed bookmarks">
    <thead>
      <tr>
        <th>
        <?php echo NAME ?> ( version: 1.1.1 ) <?php 
        
        $options = get_option('GDPlayer_options');
        if($options['GDPlayer_skins'] === 'on') { 
            echo "JW Player Style"; 
        } 
        else {
            echo "Openload Player Style"; 
        }
        ?>
          </th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
<!--
................
        </td>
      </tr>
    </tbody>
  </table>
</form>
-->

        
	<?php
	settings_fields( 'GDPlayer_options' );
	do_settings_sections( 'GDPlayer-settings' );
	?>
	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
    <hr>
<center><h2>Using GD Player</h2></center>
	<?php echo file_get_contents(plugin_dir_path( __FILE__ ) . 'help.html'); ?>
        
<!-- CLOSE TABLE-->
        </td>
      </tr>
    </tbody>
  </table>
            
	</form>
</div> <!--	WRAP END-->
	<?php
	
}
add_action('admin_init', 'register_GDPlayer_settings');

function register_GDPlayer_settings() {
	register_setting('GDPlayer_options', 'GDPlayer_options', 'GDPlayer_options_validate');
	add_settings_section('GDPlayer_defaults', 'Default Settings', 'defaults_output', 'GDPlayer-settings');
	
	add_settings_field('GDPlayer_width', 'Width', 'width_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	add_settings_field('GDPlayer_height', 'Height', 'height_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_preload', 'Preload', 'preload_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	add_settings_field('GDPlayer_autoplay', 'Autoplay', 'autoplay_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_color_one', 'Control Bar/Buttons/Time & Icon Color', 'color_one_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_hover_color_one', 'Control Bar/Buttons & Icon Color Hover', 'hover_color_one_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_bicon_color', 'Icon Background Color', 'bicon_color_output', 'GDPlayer-settings', 'GDPlayer_defaults');

	add_settings_field('GDPlayer_hover_bicon_color', 'Icon Background Color Hover', 'hover_bicon_color_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_color_two', 'Progress Color', 'color_two_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	
	add_settings_field('GDPlayer_color_three', 'Control Bar (Background Color)', 'color_three_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_skins', 'Check Box To Enable <h3>JW Player Style</h3> Uncheck To Enable <h3>Openload Player Style</h3> ', 'skins_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_responsive', 'Check Box To Enable <h3>Responsive Video </h3> Uncheck To Disable.', 'responsive_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_video_shortcode', 'Check Box To Enable <h3>[GDEmbed] shortcode </h3> Uncheck To Disable. ', 'video_shortcode_output', 'GDPlayer-settings', 'GDPlayer_defaults');
	
	add_settings_field('GDPlayer_reset', 'Restore Defaults', 'reset_output', 'GDPlayer-settings', 'GDPlayer_defaults');
}

/* Validate our inputs */

function GDPlayer_options_validate($input) {
	$newinput['GDPlayer_height'] = $input['GDPlayer_height'];
	$newinput['GDPlayer_width'] = $input['GDPlayer_width'];
	$newinput['GDPlayer_preload'] = $input['GDPlayer_preload'];
	$newinput['GDPlayer_autoplay'] = $input['GDPlayer_autoplay'];
	$newinput['GDPlayer_responsive'] = $input['GDPlayer_responsive'];
	$newinput['GDPlayer_skins'] = $input['GDPlayer_skins'];
	$newinput['GDPlayer_color_one'] = $input['GDPlayer_color_one'];
	$newinput['GDPlayer_color_two'] = $input['GDPlayer_color_two'];
	$newinput['GDPlayer_color_three'] = $input['GDPlayer_color_three'];
	
	$newinput['GDPlayer_hover_color_one'] = $input['GDPlayer_hover_color_one'];
	
	$newinput['GDPlayer_bicon_color'] = $input['GDPlayer_bicon_color'];
	$newinput['GDPlayer_hover_bicon_color'] = $input['GDPlayer_hover_bicon_color'];
	
	$newinput['GDPlayer_reset'] = $input['GDPlayer_reset'];
	$newinput['GDPlayer_video_shortcode'] = $input['GDPlayer_video_shortcode'];
	
	if(!preg_match("/^\d+$/", trim($newinput['GDPlayer_width']))) {
		 $newinput['GDPlayer_width'] = '';
	 }
	 
	 if(!preg_match("/^\d+$/", trim($newinput['GDPlayer_height']))) {
		 $newinput['GDPlayer_height'] = '';
	 }
	 
	 if(!preg_match("/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/", trim($newinput['GDPlayer_color_one']))) {
		 $newinput['GDPlayer_color_one'] = '#ffffff';
	 }
	 
	 if(!preg_match("/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/", trim($newinput['GDPlayer_hover_color_one']))) {
		 $newinput['GDPlayer_hover_color_one'] = '#cccccc';
	 }
	 
	 if(!preg_match("/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/", trim($newinput['GDPlayer_bicon_color']))) {
		 $newinput['GDPlayer_bicon_color'] = '#000000';
	 }
	 
	 if(!preg_match("/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/", trim($newinput['GDPlayer_hover_bicon_color']))) {
		 $newinput['GDPlayer_hover_bicon_color'] = '#00aaff';
	 }
	 
	 if(!preg_match("/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/", trim($newinput['GDPlayer_color_two']))) {
		 $newinput['GDPlayer_color_two'] = '#00aaff';
	 }
	 
	 if(!preg_match("/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/", trim($newinput['GDPlayer_color_three']))) {
		 $newinput['GDPlayer_color_three'] = '#000000';
	 }
	
	return $newinput;
}

/* Display the input fields */

function defaults_output() { //Layout
	//echo '';
}

function height_output() {
	$options = get_option('GDPlayer_options');
	echo "<input id='GDPlayer_height' name='GDPlayer_options[GDPlayer_height]' size='40' type='text' value='{$options['GDPlayer_height']}' />";
}

function width_output() {
	$options = get_option('GDPlayer_options');
	echo "<input id='GDPlayer_width' name='GDPlayer_options[GDPlayer_width]' size='40' type='text' value='{$options['GDPlayer_width']}' />";
}

function preload_output() {
	$options = get_option('GDPlayer_options');
	if($options['GDPlayer_preload']) { $checked = ' checked="checked" '; } else { $checked = ''; }
	echo "<input ".$checked." id='GDPlayer_preload' name='GDPlayer_options[GDPlayer_preload]' type='checkbox' />";
}

function autoplay_output() {
	$options = get_option('GDPlayer_options');
	if($options['GDPlayer_autoplay']) { $checked = ' checked="checked" '; } else { $checked = ''; }
	echo "<input ".$checked." id='GDPlayer_autoplay' name='GDPlayer_options[GDPlayer_autoplay]' type='checkbox' />";
}

function responsive_output() {
	$options = get_option('GDPlayer_options');
	if($options['GDPlayer_responsive']) { $checked = ' checked="checked" '; } else { $checked = ''; }
	echo "<input ".$checked." id='GDPlayer_responsive' name='GDPlayer_options[GDPlayer_responsive]' type='checkbox' />";
}

function skins_output() {
	$options = get_option('GDPlayer_options');
	if($options['GDPlayer_skins']) { $checked = ' checked="checked" '; } else { $checked = ''; }
	echo "<input ".$checked." id='GDPlayer_skins' name='GDPlayer_options[GDPlayer_skins]' type='checkbox' />";
}

function color_one_output() {
	$options = get_option('GDPlayer_options');
	echo "<input id='GDPlayer_color_one' name='GDPlayer_options[GDPlayer_color_one]' size='40' type='text' value='{$options['GDPlayer_color_one']}' data-default-color='#ffffff' class='GDPlayer-color-field' />";
}

function hover_color_one_output() {
	$options = get_option('GDPlayer_options');
	echo "<input id='GDPlayer_hover_color_one' name='GDPlayer_options[GDPlayer_hover_color_one]' size='40' type='text' value='{$options['GDPlayer_hover_color_one']}' data-default-color='#cccccc' class='GDPlayer-color-field' />";
}

function bicon_color_output() {
	$options = get_option('GDPlayer_options');
	echo "<input id='GDPlayer_bicon_color' name='GDPlayer_options[GDPlayer_bicon_color]' size='40' type='text' value='{$options['GDPlayer_bicon_color']}' data-default-color='#000000' class='GDPlayer-color-field' />";
}

function hover_bicon_color_output() {
	$options = get_option('GDPlayer_options');
	echo "<input id='GDPlayer_hover_bicon_color' name='GDPlayer_options[GDPlayer_hover_bicon_color]' size='40' type='text' value='{$options['GDPlayer_hover_bicon_color']}' data-default-color='#00aaff' class='GDPlayer-color-field' />";
}

function color_two_output() {
	$options = get_option('GDPlayer_options');
	echo "<input id='GDPlayer_color_two' name='GDPlayer_options[GDPlayer_color_two]' size='40' type='text' value='{$options['GDPlayer_color_two']}' data-default-color='#00aaff' class='GDPlayer-color-field' />";
}

function color_three_output() {
	$options = get_option('GDPlayer_options');
	echo "<input id='GDPlayer_color_three' name='GDPlayer_options[GDPlayer_color_three]' size='40' type='text' value='{$options['GDPlayer_color_three']}' data-default-color='#000000' class='GDPlayer-color-field' />";
}

function video_shortcode_output() {
	$options = get_option('GDPlayer_options');
	if(array_key_exists('GDPlayer_video_shortcode', $options)){
		if($options['GDPlayer_video_shortcode']) { $checked = ' checked="checked" '; } else { $checked = ''; }
	} else { $checked = ' checked="checked" '; }
	echo "<input ".$checked." id='GDPlayer_video_shortcode' name='GDPlayer_options[GDPlayer_video_shortcode]' type='checkbox' />";
}

function reset_output() {
	$options = get_option('GDPlayer_options');
	if($options['GDPlayer_reset']) { $checked = ' checked="checked" '; } else { $checked = ''; }
	echo "<input ".$checked." id='GDPlayer_reset' name='GDPlayer_options[GDPlayer_reset]' type='checkbox' />";
}


/* Set Defaults */
register_activation_hook(plugin_dir_path( __FILE__ ) . 'GDPlayer.php', 'add_defaults_fn');

function add_defaults_fn() {
	$tmp = get_option('GDPlayer_options');
    if(($tmp['GDPlayer_reset']=='on')||(!is_array($tmp))) {
		$arr = array("GDPlayer_height"=>"420","GDPlayer_width"=>"720","GDPlayer_preload"=>"","GDPlayer_autoplay"=>"","GDPlayer_responsive"=>"on","GDPlayer_skins"=>"on","GDPlayer_color_one"=>"","GDPlayer_hover_color_one"=>"","GDPlayer_bicon_color"=>"","GDPlayer_hover_bicon_color"=>"","GDPlayer_color_two"=>"","GDPlayer_color_three"=>"","GDPlayer_video_shortcode"=>"on","GDPlayer_reset"=>"");
		update_option('GDPlayer_options', $arr);
		update_option("GDPlayer_db_version", "1.0");
	}
}


/* Plugin Updater */
function update_GDPlayer() {
	$GDPlayer_db_version = "1.0";
	
	if( get_option("GDPlayer_db_version") != $GDPlayer_db_version ) { //We need to update our database options
		$options = get_option('GDPlayer_options');
		
		//Set the new options to their defaults
		$options['GDPlayer_color_one'] = "#ffffff";
		$options['GDPlayer_hover_color_one'] = "#cccccc";
		$options['GDPlayer_bicon_color'] = "#000000";
		$options['GDPlayer_hover_bicon_color'] = "#00aaff";	
		$options['GDPlayer_color_two'] = "#00aaff";
		$options['GDPlayer_color_three'] = "#000000";
		$options['GDPlayer_video_shortcode'] = "on";
		
		update_option('GDPlayer_options', $options);
		
		update_option("GDPlayer_db_version", $GDPlayer_db_version); //Update the database version setting
	}
}
add_action('admin_init', 'update_GDPlayer');
?>