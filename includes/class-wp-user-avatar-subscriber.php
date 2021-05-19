<?php
/**
 * Settings only for subscribers and contributors.
 *
 * @package WP User Avatar
 * @version 1.9.13
 */

class WP_User_Avatar_Subscriber {
  /**
   * Constructor
   * @since 1.8
   * @uses object $wp_user_avatar
   * @uses bool $wpua_allow_upload
   * @uses add_action()
   * @uses current_user_can()
   * @uses wpua_is_author_or_above()
   */
  public function __construct() {
    global $wpua_allow_upload;
    if((bool) $wpua_allow_upload == 1) {
      add_action('user_edit_form_tag', array($this, 'wpua_add_edit_form_multipart_encoding'));
    }
    add_action('admin_init', array($this, 'wpua_subscriber_capability'));
  }

  /**
   * Allow multipart data in form
   * @since 1.4.1
   */
  public function wpua_add_edit_form_multipart_encoding() {
    echo ' enctype="multipart/form-data"';
  }

  /**
   * Give subscribers edit_posts capability
   * @since 1.8.3
   * @uses int $blog_id
   * @uses object $wpdb
   * @uses bool $wpua_allow_upload
   * @uses bool $wpua_edit_avatar
   * @uses get_blog_prefix()
   * @uses get_option()
   * @uses update_option()
   */
  public function wpua_subscriber_capability() {
    global $blog_id, $wpdb, $wpua_allow_upload, $wpua_edit_avatar;
    $wp_user_roles = $wpdb->get_blog_prefix($blog_id).'user_roles';
    $user_roles = get_option($wp_user_roles);
     if(isset($user_roles['subscriber']['capabilities']['edit_posts'])){
     	unset($user_roles['subscriber']['capabilities']['edit_posts']);
    }
    update_option($wp_user_roles, $user_roles);
  }
}

/**
 * Initialize
 * @since 1.9.5
 */
function wpua_subscriber_init() {
  global $wpua_subscriber;
  $wpua_subscriber = new WP_User_Avatar_Subscriber();
}
add_action('init', 'wpua_subscriber_init');
