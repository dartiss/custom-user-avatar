<?php
/**
 * Public user functions.
 * 
 * @package WP User Avatar
 * @version 1.9.13
 */

/**
 * Returns true if user has wp_user_avatar
 * @since 1.8
 * @param int|string $id_or_email
 * @param bool $has_wpua
 * @param object $user
 * @param int $user_id
 * @uses object $wpua_functions
 * @return object has_wp_user_avatar()
 */
function has_wp_user_avatar($id_or_email="", $has_wpua="", $user="", $user_id="") {
  global $wpua_functions;
  return $wpua_functions->has_wp_user_avatar($id_or_email, $has_wpua, $user, $user_id);
}

/**
 * Find WPUA, show get_avatar if empty
 *
 * @param int|string $id_or_email
 * @param int|string $size
 * @param string $align
 * @param string $alt
 * @param array $class
 *
 * @return object get_wp_user_avatar()
 * @since 1.8
 * @uses object $wpua_functions
 */
function get_wp_user_avatar($id_or_email="", $size="", $align="", $alt="",$class=[]) {
  global $wpua_functions;
  return $wpua_functions->get_wp_user_avatar($id_or_email, $size, $align, $alt, $class);
}

/**
 * Return just the image src
 * @since 1.8
 * @param int|string $id_or_email
 * @param int|string $size
 * @param string $align
 * @uses object $wpua_functions
 * @return object get_wp_user_avatar_src()
 */
function get_wp_user_avatar_src($id_or_email="", $size="", $align="") {
  global $wpua_functions;
  return $wpua_functions->get_wp_user_avatar_src($id_or_email, $size, $align);
}

/**
 * Before wrapper for profile
 * @since 1.6
 * @uses do_action()
 */
function wpua_before_avatar() {
  do_action('wpua_before_avatar');
}

/**
 * After wrapper for profile
 * @since 1.6
 * @uses do_action()
 */
function wpua_after_avatar() {
  do_action('wpua_after_avatar');
}

/**
 * Before avatar container
 * @since 1.6
 * @uses apply_filters()
 * @uses bbp_is_edit()
 * @uses wpuf_has_shortcode()
 */
function wpua_do_before_avatar() {
  $wpua_profile_title = '<h3>'.__('Profile Picture','wp-user-avatar').'</h3>';
  /**
   * Filter profile title
   * @since 1.9.4
   * @param string $wpua_profile_title
   */
  $wpua_profile_title = apply_filters('wpua_profile_title', $wpua_profile_title);
?>
  <?php if(class_exists('bbPress') && bbp_is_edit()) : // Add to bbPress profile with same style ?>
    <h2 class="entry-title"><?php _e('Profile Picture','wp-user-avatar'); ?></h2>
    <fieldset class="bbp-form">
      <legend><?php _e('Image','wp-user-avatar'); ?></legend>
  <?php elseif(class_exists('WPUF_Main') && wpuf_has_shortcode('wpuf_editprofile')) : // Add to WP User Frontend profile with same style ?>
    <fieldset>
      <legend><?php _e('Profile Picture','wp-user-avatar') ?></legend>
      <table class="wpuf-table">
        <tr>
          <th><label for="wp_user_avatar"><?php _e('Image','wp-user-avatar'); ?></label></th>
          <td>
  <?php else : // Add to profile without table ?>
    <div class="wpua-edit-container">
      <?php echo $wpua_profile_title; ?>
  <?php endif; ?>
  <?php
}
add_action('wpua_before_avatar', 'wpua_do_before_avatar');

/**
 * After avatar container
 * @since 1.6
 * @uses bbp_is_edit()
 * @uses wpuf_has_shortcode()
 */
function wpua_do_after_avatar() {
?>
  <?php if(class_exists('bbPress') && bbp_is_edit()) : // Add to bbPress profile with same style ?>
    </fieldset>
  <?php elseif(class_exists('WPUF_Main') && wpuf_has_shortcode('wpuf_editprofile')) : // Add to WP User Frontend profile with same style ?>
          </td>
        </tr>
      </table>
    </fieldset>
  <?php else : // Add to profile without table ?>
    </div>
  <?php endif; ?>
  <?php
}
add_action('wpua_after_avatar', 'wpua_do_after_avatar');

/**
 * Before wrapper for profile in admin section
 * @since 1.9.4
 * @uses do_action()
 */
function wpua_before_avatar_admin() {
  do_action('wpua_before_avatar_admin');
}

/**
 * After wrapper for profile in admin section
 * @since 1.9.4
 * @uses do_action()
 */
function wpua_after_avatar_admin() {
  do_action('wpua_after_avatar_admin');
}

/**
 * Before avatar container in admin section
 * @since 1.9.4
 */
function wpua_do_before_avatar_admin() {
?>
  <table class="form-table">
    <tr>
      <th><label for="wp_user_avatar"><?php _e('Profile Picture','wp-user-avatar'); ?></label></th>
      <td>
  <?php
}
add_action('wpua_before_avatar_admin', 'wpua_do_before_avatar_admin');

/**
 * After avatar container in admin section
 * @since 1.9.4
 */
function wpua_do_after_avatar_admin() {
?>
      </td>
    </tr>
  </table>
  <?php
}
add_action('wpua_after_avatar_admin', 'wpua_do_after_avatar_admin');

/**
 * Register widget
 * @since 1.9.4
 * @uses register_widget()
 */
function wpua_widgets_init() {
  register_widget('WP_User_Avatar_Profile_Widget');
}
add_action('widgets_init', 'wpua_widgets_init');
