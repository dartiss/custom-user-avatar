<?php
/**
 * Custom User Avatar
 *
 * @package           custom-user-avatar
 * @author            David Artiss
 * @license           GPL-2.0-or-later
 *
 * Plugin Name:       Custom User Avatar
 * Plugin URI:        https://wordpress.org/support/plugin/custom-user-avatar/
 * Description:       👤 Use any image from your WordPress Media Library as a custom user avatar. Add your own Default Avatar.
 * Version:           1.0
 * Requires at least: 4.0
 * Author:            David Artiss
 * Author URI:        https://artiss.blog
 * Text Domain:       wp-user-avatar
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if(!defined('ABSPATH')) {
  die('You are not allowed to call this page directly.');
}

/**
 * Let's get started!
 */
class WP_User_Avatar_Setup {
  /**
   * Constructor
   */
  public function __construct() {
    $this->_define_constants();
    $this->_load_wp_includes();
    $this->_load_wpua();
  }

  /**
   * Define paths
   */
  private function _define_constants() {
    define('WPUA_VERSION', '2.2.16');
    define('WPUA_FOLDER', basename(dirname(__FILE__)));
    define('WPUA_DIR', plugin_dir_path(__FILE__));
    define('WPUA_INC', WPUA_DIR.'includes'.'/');
    define('WPUA_URL', plugin_dir_url(WPUA_FOLDER).WPUA_FOLDER.'/');
    define('WPUA_INC_URL', WPUA_URL.'includes'.'/');
  }

  /**
   * WordPress includes used in plugin
   * @uses is_admin()
   */
  private function _load_wp_includes() {
    if(!is_admin()) {
      // wp_handle_upload
      require_once(ABSPATH.'wp-admin/includes/file.php');
      // wp_generate_attachment_metadata
      require_once(ABSPATH.'wp-admin/includes/image.php');
      // image_add_caption
      require_once(ABSPATH.'wp-admin/includes/media.php');
      // submit_button
      require_once(ABSPATH.'wp-admin/includes/template.php');
    }
    // add_screen_option
    require_once(ABSPATH.'wp-admin/includes/screen.php');
  }

  /**
   * Load Custom User Avatar
   * @uses bool $wpua_tinymce
   * @uses is_admin()
   */
  private function _load_wpua() {
    global $wpua_tinymce;
    require_once(WPUA_INC.'wpua-globals.php');
    require_once(WPUA_INC.'wpua-functions.php');
    require_once(WPUA_INC.'class-wp-user-avatar-admin.php');
    require_once(WPUA_INC.'class-wp-user-avatar.php');
    require_once(WPUA_INC.'class-wp-user-avatar-functions.php');
    require_once(WPUA_INC.'class-wp-user-avatar-shortcode.php');
    require_once(WPUA_INC.'class-wp-user-avatar-subscriber.php');
    require_once(WPUA_INC.'class-wp-user-avatar-update.php');
    require_once(WPUA_INC.'class-wp-user-avatar-widget.php');
    
    // Load TinyMCE only if enabled
    if((bool) $wpua_tinymce == 1) {
      require_once(WPUA_INC.'wpua-tinymce.php');
    }

  }
}

/**
 * Initialize
 */
new WP_User_Avatar_Setup();
