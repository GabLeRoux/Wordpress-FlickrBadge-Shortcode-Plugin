<?php
/*
Plugin Name: FlickrBadge Shortcode
Plugin URI: http://www.gableroux.com/
Description: Embed Flickr Badges using shortcodes
Version: 1.0.0
Author: Gabriel Le Breton
Author URI: http://www.gableroux.com
License: GPL2

Copyright 2011-2012  Gabriel Le Breton  (email : lebreton.gabriel@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('FlickrBadgeShortcode')):

class FlickrBadgeShortcode 
{
	// Constructor
	public function __construct() 
	{
		// Adds Translation support
		load_plugin_textdomain( 'flickrbadge', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		// Load defaults on plugin activation
		register_activation_hook(__FILE__, array($this, 'FlickrBadgeShortcode_add_defaults'));
		
		// When uninstalling plugin
		register_uninstall_hook(__FILE__, array($this, 'FlickrBadgeShortcode_delete_plugin_options'));
		
		// Register Settings
		add_action('admin_init', array($this, 'FlickrBadgeShortcode_register_settings'));
		
		// Create Settings Page
		add_action('admin_menu', array($this, 'FlickrBadgeShortcode_add_options_page'));

		// Adds link to configs before plugin desactivation link (still messed up) :/
		add_filter( 'plugin_action_links', array($this, 'FlickrBadgeShortcode_plugin_action_links'), 10, 2 );

		// Create shortcode
        add_shortcode('flickrbadge', array($this, 'FlickrBadgeShortcode_output_script'));
	}

	// Define default option settings
	function FlickrBadgeShortcode_add_defaults() 
	{
		$tmp = get_option('FlickrBadgeShortcode_options');
	    if(($tmp['chk_restore_default_on_install']=='1')||(!is_array($tmp)))
	    {
			delete_option('FlickrBadgeShortcode_options');
			$arr = array(
				"flickrbadge_id" => "48389960@N05",
				"flickrbadge_layout" => "x",
				"flickrbadge_size" => "m",
				"chk_restore_default_on_install" => 0
				);
			update_option('FlickrBadgeShortcode_options', $arr);
		}
	}

	// Register settings
	function FlickrBadgeShortcode_register_settings()
	{
		// Register our settings
		register_setting('FlickrBadgeShortcode_options_group', 'FlickrBadgeShortcode_options', array($this, 'FlickrBadgeShortcode_validate_options'));
	}
	
	// Delete options when uninstalling plugin
	function FlickrBadgeShortcode_delete_plugin_options()
	{
		delete_option('FlickrBadgeShortcode_options');
	}

	// Add menu page
	function FlickrBadgeShortcode_add_options_page() 
	{
		add_options_page('FlickrBadge Shortcode Options', 'FlickrBadge Shortcode Options', 'manage_options', 'flickrbadge_shortcode', array($this, 'FlickrBadgeShortcode_render_form'));
	}

	// Render the Plugin options form
	function FlickrBadgeShortcode_render_form() 
	{
		?>

		<div class="wrap">
			
			<div class="icon32" id="icon-options-general"><br></div>
			<h2><?php _e('FkickrBadge Plugin Options', 'flickrbadge') ?></h2>
			<p><?php _e('Complete those fields as you wish!', 'flickrbadge') ?></p>

				<!-- Options Form -->
			<form method="post" action="options.php">
				<?php settings_fields('FlickrBadgeShortcode_options_group'); ?>
				<?php $options = get_option('FlickrBadgeShortcode_options'); ?>
				<table class="form-table">
					<tr>
						<th scope="row"><?php _e('Default Flickr ID for shortcodes', 'flickrbadge') ?><br /><span class="description"><?php _e('To get your Flickr ID, simply use', 'flickrbadge') ?> <a href="http://idgettr.com/" target="_blank()">idGettr</a>.</span></th>
						<td>
							<input type="text" name="flickrbadge_options[flickrbadge_id]" value="<?php echo $options['flickrbadge_id'] ?>" size="12" >
						</td>
					</tr>

					<tr>
						<th scope="row"><?php _e('Default layout', 'flickrbadge') ?><br /><span class="description"><?php _e('Layout used for displaying pictures', 'flickrbadge') ?></span></th>
						<td>
							<select name='flickrbadge_options[flickrbadge_layout]'>
								<option value='h' <?php selected('h', $options['flickrbadge_layout']); ?>>h <?php _e('(horizontally)', 'flickrbadge') ?></option>
								<option value='v' <?php selected('v', $options['flickrbadge_layout']); ?>>v <?php _e('(vertically)', 'flickrbadge') ?></option>
								<option value='x' <?php selected('x', $options['flickrbadge_layout']); ?>>x <?php _e('(none)', 'flickrbadge') ?></option>
							</select>
						</td>
					</tr>

					<tr>
						<th scope="row"><?php _e('Default size', 'flickrbadge') ?><span class="description"><br /><?php _e('Size of each pictures', 'flickrbadge') ?></span></th>
						<td>
							<select name='flickrbadge_options[flickrbadge_layout]'>
								<option value='s' <?php selected('s', $options['flickrbadge_size']); ?>>s <?php _e('(square)', 'flickrbadge') ?></option>
								<option value='t' <?php selected('t', $options['flickrbadge_size']); ?>>t <?php _e('(thumbnail)', 'flickrbadge') ?></option>
								<option value='m' <?php selected('m', $options['flickrbadge_size']); ?>>m <?php _e('(medium)', 'flickrbadge') ?></option>
							</select>
						</td>
					</tr>

					<tr><td colspan="2"><div style="margin-top:10px;"></div></td></tr>
					<tr valign="top" style="border-top:#dddddd 1px solid;">
						<th scope="row"><?php _e('Database options', 'flickrbadge') ?></th>
						<td>
							<label><input name="flickrbadge_options[chk_restore_default_on_install]" type="checkbox" value="1" <?php if (isset($options['chk_restore_default_on_install'])) { checked('1', $options['chk_restore_default_on_install']); } ?> /> <?php _e('Restore defaults upon plugin deactivation/reactivation', 'flickrbadge') ?></label>
							<br /><span class="description"><?php _e('Only check this if you want to reset plugin settings upon Plugin reactivation', 'flickrbadge') ?></span>
						</td>
					</tr>
				</table>
				<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>

			<!-- Options result -->
			<div id="icon-plugins" class="icon32"><br></div>
			<h2><?php _e('Actual result with default options', 'flickrbadge') ?></h2>
			<?php echo do_shortcode('[flickrbadge]'); ?>
			<span class="description"><?php _e('Simply use ', 'flickrbadge') ?> [flickrbadge] <?php _e('anywhere in a post or a page to obtain this result.', 'flickrbadge') ?></span>

		</div>
		<?php	
	}

	// Sanitize and validate input. Accepts an array, return a sanitized array.
	function FlickrBadgeShortcode_validate_options($input) 
	{
		 // strip html from textboxes
		$input['flickrbadge_id'] =  wp_filter_nohtml_kses($input['flickrbadge_id']); // Sanitize textbox input (strip html tags, and escape characters)
		return $input;
	}
	
	function FlickrBadgeShortcode_output_script($atts, $content = null)
	{
		$options = get_option('FlickrBadgeShortcode_options');

		// Defaults attributes
		$query_atts = shortcode_atts(array(
			'count' => '10',
			'display' => 'random',
			'source' => 'user',
			'size' => $options['flickrbadge_m'],
			'layout' => $options['flickrbadge_layout'],
			'user' => $options['flickrbadge_id'],
			'api_key' => ''
			), $atts);
		
		$format = '<div class="flickr_badge"><script src="http://www.flickr.com/badge_code_v2.gne?%s" type="text/javascript"></script></div>';
	 	return sprintf($format, http_build_query($query_atts));
	}

		// Display a Settings link on the main Plugins page
	function FlickrBadgeShortcode_plugin_action_links( $links, $file )
	{

		if ( $file == plugin_basename( __FILE__ ) ) 
		{
			$FlickrBadgeShortcode_links = '<a href="'.get_admin_url().'options-general.php?page=flickrbadge_shortcode">'.__('Settings').'</a>';
			// make the 'Settings' link appear first
			array_unshift( $links, $FlickrBadgeShortcode_links );
		}

		return $links;
	}
}

// Create just one instance per request
new FlickrBadgeShortcode();

endif;
?>