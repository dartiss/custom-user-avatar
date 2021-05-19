=== Custom User Avatar ===
Contributors: dartiss, properfraction, collizo4sky
Tags: user profile, avatar, gravatar, author image, author photo, author avatar, bbPress, profile avatar, profile image, user avatar, user image, user photo, widget
Requires at least: 4.0
Tested up to: 5.7
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

👤 Use any image from your WordPress Media Library as a custom user avatar or user profile picture. Add your own Default Avatar.

== Description ==

WordPress currently only allows you to use custom avatars that are uploaded through [Gravatar](http://gravatar.com/). **Custom User Avatar** enables you to use any photo uploaded into your Media Library as an avatar. This means you use the same uploader and library as your posts. No extra folders or image editing functions are necessary.

**This is a fork of the popular WP User Avatar plugin, before it became ProfilePress, and is free of all advertising. For details of what is different, please see the first item in the FAQ.**

**Custom User Avatar** lets you:

* Upload your own Default Avatar in your Custom User Avatar settings.
* Show the user's [Gravatar](http://gravatar.com/) avatar or Default Avatar if the user doesn't have a Custom User Avatar image.
* Disable [Gravatar](http://gravatar.com/) avatars and use only local avatars.
* Use the <code>[avatar_upload]</code> shortcode to add a standalone uploader to a front page or widget. This uploader is only visible to logged-in users.
* Use the <code>[avatar]</code> shortcode in your posts. These shortcodes will work with any theme, whether it has avatar support or not.
* Allow Contributors and Subscribers to upload their own avatars.
* Limit upload file size and image dimensions for Contributors and Subscribers.

👉 Please visit the [Github page](https://github.com/dartiss/custom-user-avatar "Github") for the latest code development, planned enhancements and known issues 👈

== Installation ==

1. Download, install, and activate the Custom User Avatar plugin.
2. On your profile edit page, click "Edit Image".
3. Choose an image, then click "Select Image".
4. Click "Update Profile".
5. Upload your own Default Avatar in your Custom User Avatar settings (optional). You can also allow Contributors & Subscribers to upload avatars and disable Gravatar.
6. Choose a theme that has avatar support. In your theme, manually replace <code>get_avatar</code> with <code>get_wp_user_avatar</code> or leave <code>get_avatar</code> as-is. [Read about the differences here](http://wordpress.org/extend/plugins/custom-user-avatar/faq/).
7. You can also use the <code>[avatar_upload]</code> and <code>[avatar]</code> shortcodes in your posts. These shortcodes will work with any theme, whether it has avatar support or not.

**Example Usage**

= Posts =

Within [The Loop](http://codex.wordpress.org/The_Loop), you may be using:

`<?php echo get_avatar(get_the_author_meta('ID'), 96); ?>`

Replace this function with:

`<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 96); ?>`

You can also use the values "original", "large", "medium", or "thumbnail" for your avatar size:

`<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'medium'); ?>`

You can also add an alignment of "left", "right", or "center":

`<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 96, 'left'); ?>`

= Author Page =

On an author page outside of [The Loop](http://codex.wordpress.org/The_Loop), you may be using:

`<?php
  $user = get_user_by('slug', $author_name); 
  echo get_avatar($user->ID, 96);
?>`

Replace this function with:

`<?php
  $user = get_user_by('slug', $author_name);
  echo get_wp_user_avatar($user->ID, 96);
?>`

If you leave the options blank, Custom User Avatar will detect whether you're inside [The Loop](http://codex.wordpress.org/The_Loop) or on an author page and return the correct avatar in the default 96x96 size:

`<?php echo get_wp_user_avatar(); ?>`

The function <code>get_wp_user_avatar</code> can also fall back to <code>get_avatar</code> if there is no Custom User Avatar image. For this to work, "Show Avatars" must be checked in your Custom User Avatar settings. When this setting is enabled, you will see the user's [Gravatar](http://gravatar.com/) avatar or Default Avatar.

= Comments =

For comments, you might have in your template:

`<?php echo get_avatar($comment, 32); ?>`

Replace this function with:

`<?php echo get_wp_user_avatar($comment, 32); ?>`

For comments, you must specify the $comment variable.

**Other Available Functions**

= [avatar_upload] shortcode =

You can use the <code>[avatar_upload]</code> shortcode to add a standalone uploader to a front page or widget. This uploader is only visible to logged-in users. If you want to integrate the uploader into a profile edit page, see [Other Notes](http://wordpress.org/plugins/wp-user-avatar/other_notes/).

You can specify a user with the shortcode, but you must have <code>edit_user</code> capability for that particular user.

`[avatar_upload user="admin"]`

= [avatar] shortcode =

You can use the <code>[avatar]</code> shortcode in your posts. It will detect the author of the post or you can specify an author by username. You can specify a size, alignment, and link, but they are optional. For links, you can link to the original image file, attachment page, or a custom URL.

`[avatar user="admin" size="medium" align="left" link="file" /]`

You can also add a caption to the shortcode:

`[avatar user="admin" size="medium" align="left" link="file"]Photo Credit: Your Name[/avatar]`

**Note:** If you are using one shortcode without a caption and another shortcode with a caption on the same page, you must close the caption-less shortcode with a forward slash before the closing bracket: <code>[avatar /]</code> instead of <code>[avatar]</code>

= get_wp_user_avatar_src =

Works just like <code>get_wp_user_avatar</code> but returns just the image src. This is useful if you would like to link a thumbnail-sized avatar to a larger version of the image:

`<a href="<?php echo get_wp_user_avatar_src($user_id, 'large'); ?>">
  <?php echo get_wp_user_avatar($user_id, 'thumbnail'); ?>
</a>`

= has_wp_user_avatar =

Returns true if the user has a Custom User Avatar image. You must specify the user ID:

`<?php
  if ( has_wp_user_avatar($user_id) ) {
    echo get_wp_user_avatar($user_id, 96);
  } else {
    echo '<img src="my-alternate-image.jpg" />';
  }
?>`

== Frequently Asked Questions ==

= Why this was forked from WP User Avatar and what is different? =

The original WP User Avatar, popular amongst users wishing to simple manager their site avatars, was renamed to ProfilePress at version 3.0 and made into a full membership plugin. A lot of users, however, didn't want the new functionality. On top of this, some people reported increasing errors and decreasing site speed as a result. Indeed, the resulting up-roar even made [WP Tavern](https://wptavern.com/profilepress-rebrands-and-repurposes-wp-user-avatar-now-a-membership-plugin-users-revolt-via-the-wordpress-review-system).

This, therefore, is a fork of the plugin before all that occurred, at version 2.2.16.

What has changed from that? Apart from renaming it, all advertising has been removed (and will remain removed), along with some redundant files. It also now uses the automatic translation service which comes as being part of the plugin directory. Other than that, a few minor tweaks have been made, but nothing you are likely to (yet) notice.

What has been retained is the old naming of functions and settings - what this means is that if you used WP User Avatar before, your existing configuration will automatically work with this plugin as well. Shortcodes and functions calls too remain exactly the same too.

= What are the future plans for this plugin? =

Please see the [Github issues page](https://github.com/dartiss/custom-user-avatar/issues "Github") for full details, but essentially

* Tidy up the existing code, including code quality
* Compression of the plugin scripts
* Improving the images being used by the plugin

If you're aware of any bugs, please let me know, as I also want to get rid of many of those as possible.

What you may notice is a lack of new features - that's not to say that won't happen, but I want to ensure stability. Let's improve the robustness of the code and consider new, shiny things after that.

= How do I use Custom User Avatar? =

First, choose a theme that has avatar support. In your theme, you have a choice of manually replacing <code>get_avatar</code> with <code>get_wp_user_avatar</code>, or leaving <code>get_avatar</code> as-is. Here are the differences:

= get_wp_user_avatar =

1. Allows you to use the values "original", "large", "medium", or "thumbnail" for your avatar size.
2. Doesn't add a fixed width and height to the image if you use the aforementioned values. This will give you more flexibility to resize the image with CSS.
3. Allows you to use custom image sizes registered with [<code>add_image_size</code>](http://codex.wordpress.org/Function_Reference/add_image_size) (fixed width and height are added to the image).
4. Optionally adds CSS classes "alignleft", "alignright", or "aligncenter" to position your avatar.
5. Shows nothing if the user has no Custom User Avatar image.
6. Shows the user's [Gravatar](http://gravatar.com/) avatar or Default Avatar only if "Show Avatars" is enabled in your Custom User Avatar settings.

= get_avatar =

1. Requires you to enable "Show Avatars" in your Custom User Avatar settings to show any avatars.
2. Accepts only numeric values for your avatar size.
3. Always adds a fixed width and height to your image. This may cause problems if you use responsive CSS in your theme.
4. Shows the user's [Gravatar](http://gravatar.com/) avatar or Default Avatar if the user doesn't have a Custom User Avatar image. (Choosing "Blank" as your Default Avatar still generates a transparent image file.)
5. Requires no changes to your theme files if you are currently using <code>get_avatar</code>.

[Read more about get_avatar in the WordPress Function Reference](http://codex.wordpress.org/Function_Reference/get_avatar).

= Can I create a custom Default Avatar? =
In your Custom User Avatar settings, you can upload your own Default Avatar.

= Can I disable all Gravatar avatars? =

In your Custom User Avatar settings, you can select "Disable Gravatar — Use only local avatars" to disable all [Gravatar](http://gravatar.com/) avatars on your site and replace them with your Default Avatar. This will affect your registered users and non-registered comment authors.

= Can Contributors or Subscribers choose their own Custom User Avatar image? =
Yes, if you enable "Allow Contributors & Subscribers to upload avatars" in the Custom User Avatar settings. These users will see a slightly different interface because they are allowed only one image upload.

= Will Custom User Avatar work with comment author avatars? =

Yes, for registered users. Non-registered comment authors will show their [Gravatar](http://gravatar.com/) avatars or Default Avatar.

= Will Custom User Avatar work with bbPress? =

Yes!

= Will Custom User Avatar work with BuddyPress? =

No, BuddyPress has its own custom avatar functions and Custom User Avatar will override only some of them. It's best to use BuddyPress without Custom User Avatar.

= How can I see which users have an avatar? =

For Administrators, Custom User Avatar adds a column with avatar thumbnails to your Users list table. If "Show Avatars" is enabled in your Custom User Avatar settings, you will see avatars to the left of each username instead of in a new column.

= Can I use the Custom User Avatar uploader in a front page or widget? =

Yes, you can use the <code>[avatar_upload]</code> shortcode to put a standalone uploader in a front page or widget. This uploader is only visible to logged-in users. If you want to integrate the uploader into a profile edit page, see [Other Notes](http://wordpress.org/plugins/wp-user-avatar/other_notes/).

You can specify a user with the shortcode, but you must have <code>'edit_user'</code> capability to change the user's avatar.

`[avatar_upload user="admin"]`

= Can I insert Custom User Avatar directly into a post? =

You can use the <code>[avatar]</code> shortcode in your posts. It will detect the author of the post or you can specify an author by username. You can specify a size, alignment, and link, but they are optional. For links, you can link to the original image file, attachment page, or a custom URL.

`[avatar user="admin" size="96" align="left" link="file" /]`

Outputs:

`<a href="{fileURL}" class="wp-user-avatar-link wp-user-avatar-file">
  <img src="{imageURL}" width="96" height="96" class="wp-user-avatar wp-user-avatar-96 alignleft" />
</a>`

If you have a caption, the output will be similar to how WordPress adds captions to other images.

`[avatar user="admin" size="96" align="left" link="file"]Photo Credit: Your Name[/avatar]`

Outputs:

`<div style="width: 106px" class="wp-caption alignleft">
  <a href="{fileURL}" class="wp-user-avatar-link wp-user-avatar-file">
    <img src="{imageURL}" width="96" height="96" class="wp-user-avatar wp-user-avatar-96" />
  </a>
  <p class="wp-caption-text">Photo Credit: Your Name</p>
</div>`

**Note:** If you are using one shortcode without a caption and another shortcode with a caption on the same page, you must close the caption-less shortcode with a forward slash before the closing bracket: <code>[avatar /]</code> instead of <code>[avatar]</code>

= What CSS can I use with Custom User Avatar? =

Custom User Avatar will add the CSS classes "wp-user-avatar" and "wp-user-avatar-{size}" to your image. If you add an alignment, the corresponding alignment class will be added:

`<?php echo get_wp_user_avatar($user_id, 96, 'left'); ?>`

Outputs:

`<img src="{imageURL}" width="96" height="96" class="wp-user-avatar wp-user-avatar-96 alignleft" />`

**Note:** "alignleft", "alignright", and aligncenter" are common WordPress CSS classes, but not every theme supports them. Contact the theme author to add those CSS classes.

If you use the values "original", "large", "medium", or "thumbnail", no width or height will be added to the image. This will give you more flexibility to resize the image with CSS:

`<?php echo get_wp_user_avatar($user_id, 'medium'); ?>`

Outputs:

`<img src="{imageURL}" class="wp-user-avatar wp-user-avatar-medium" />`

**Note:** WordPress adds more CSS classes to the avatar not listed here.

If you use the <code>[avatar]</code> shortcode, Custom User Avatar will add the CSS class "wp-user-avatar-link" to the link. It will also add CSS classes based on link type.

* Image File: wp-user-avatar-file
* Attachment: wp-user-avatar-attachment
* Custom URL: wp-user-avatar-custom

`[avatar user="admin" size="96" align="left" link="attachment" /]`

Outputs:

`<a href="{attachmentURL}" class="wp-user-avatar-link wp-user-avatar-attachment">
  <img src="{imageURL}" width="96" height="96" class="wp-user-avatar wp-user-avatar-96 alignleft" />
</a>`

= What other functions are available for Custom User Avatar? =
* <code>get_wp_user_avatar_src</code>: retrieves just the image URL
* <code>has_wp_user_avatar</code>: checks if the user has a Custom User Avatar image
* [See example usage here](http://wordpress.org/extend/plugins/wp-user-avatar/installation/)

== Advanced Settings ==

Visit [Custom User Avatar](http://wpuseravatar.com/) for more information and documentation.

= Add Custom User Avatar to your own profile edit page =

You can use the [avatar_upload] shortcode to add a standalone uploader to any page. It's best to use this uploader by itself and without other profile fields.

If you're building your own profile edit page with other fields, Custom User Avatar is automatically added to the [show_user_profile](http://codex.wordpress.org/Plugin_API/Action_Reference/show_user_profile) and [edit_user_profile](http://codex.wordpress.org/Plugin_API/Action_Reference/show_user_profile) hooks. If you'd rather have Custom User Avatar in its own section, you could add another hook:

`do_action('edit_user_avatar', $current_user);`

Then, to add Custom User Avatar to that hook and remove it from the other hooks outside of the administration panel, you would add this code to the <code>functions.php</code> file of your theme:

`function my_avatar_filter() {
  // Remove from show_user_profile hook
  remove_action('show_user_profile', array('wp_user_avatar', 'wpua_action_show_user_profile'));
  remove_action('show_user_profile', array('wp_user_avatar', 'wpua_media_upload_scripts'));

  // Remove from edit_user_profile hook
  remove_action('edit_user_profile', array('wp_user_avatar', 'wpua_action_show_user_profile'));
  remove_action('edit_user_profile', array('wp_user_avatar', 'wpua_media_upload_scripts'));

  // Add to edit_user_avatar hook
  add_action('edit_user_avatar', array('wp_user_avatar', 'wpua_action_show_user_profile'));
  add_action('edit_user_avatar', array('wp_user_avatar', 'wpua_media_upload_scripts'));
}

// Loads only outside of administration panel
if(!is_admin()) {
  add_action('init','my_avatar_filter');
}`

= HTML Wrapper =

You can change the HTML wrapper of the Custom User Avatar section by using the functions <code>wpua_before_avatar</code> and <code>wpua_after_avatar</code>. By default, the avatar code is structured like this:

`<div class="wpua-edit-container">
  <h3>Avatar</h3>
  <input type="hidden" name="wp-user-avatar" id="wp-user-avatar" value="{attachmentID}" />
  <p id="wpua-add-button">
    <button type="button" class="button" id="wpua-add" name="wpua-add">Edit Image</button>
  </p>
  <p id="wpua-preview">
    <img src="{imageURL}" alt="" />
    Original Size
  </p>
  <p id="wpua-thumbnail">
    <img src="{imageURL}" alt="" />
    Thumbnail
  </p>
  <p id="wpua-remove-button">
    <button type="button" class="button" id="wpua-remove" name="wpua-remove">Default Avatar</button>
  </p>
  <p id="wpua-undo-button">
    <button type="button" class="button" id="wpua-undo" name="wpua-undo">Undo</button>
  </p>
</div>`

To strip out the div container and h3 heading, you would add the following filters to the <code>functions.php</code> file in your theme:

`remove_action('wpua_before_avatar', 'wpua_do_before_avatar');
remove_action('wpua_after_avatar', 'wpua_do_after_avatar');`

To add your own wrapper, you could create something like this:

`function my_before_avatar() {
  echo '<div id="my-avatar">';
}
add_action('wpua_before_avatar', 'my_before_avatar');

function my_after_avatar() {
  echo '</div>';
}
add_action('wpua_after_avatar', 'my_after_avatar');`

This would output:

`<div id="my-avatar">
  <input type="hidden" name="wp-user-avatar" id="wp-user-avatar" value="{attachmentID}" />
  <p id="wpua-add-button">
    <button type="button" class="button" id="wpua-add" name="wpua-add">Edit Image</button>
  </p>
  <p id="wpua-preview">
    <img src="{imageURL}" alt="" />
    <span class="description">Original Size</span>
  </p>
  <p id="wpua-thumbnail">
    <img src="{imageURL}" alt="" />
    <span class="description">Thumbnail</span>
  </p>
  <p id="wpua-remove-button">
    <button type="button" class="button" id="wpua-remove" name="wpua-remove">Default Avatar</button>
  </p>
  <p id="wpua-undo-button">
    <button type="button" class="button" id="wpua-undo" name="wpua-undo">Undo</button>
  </p>
</div>`

== Screenshots ==

1. Custom User Avatar admin settings.
2. Custom User Avatar lets you upload your own Default Avatar.
3. Custom User Avatar adds a field to your profile edit page.
4. After you've chosen a Custom User Avatar image, you will see the option to remove it.

== Changelog ==

I use semantic versioning, with the first release being 1.0.

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0 =
* Initial release