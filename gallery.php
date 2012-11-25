<?php

/*
  Plugin Name: Image Slideshows & Galleries
  Description: Full Screen Image Slideshow is a cool slideshow that uses jQuery and PHP to display large images from a directory automatically and using the entire browser window as its canvas! Thumbnails of every image is shown at the bottom of the slideshow for easy viewing on demand.
  Version: 1.0
  Author: objects
  Author URI: http://objects.ws
 */

/* Runs when plugin is activated */
register_activation_hook(__FILE__, 'my_plugin_install');

/* Runs on plugin deactivation */
register_deactivation_hook(__FILE__, 'my_plugin_remove');

function my_plugin_install() {

    global $wpdb;

    $the_page_title = 'images gallery';
    $the_page_name = 'images-gallery';

    // the menu entry...
    delete_option("my_plugin_page_title");
    add_option("my_plugin_page_title", $the_page_title, '', 'yes');
    // the slug...
    delete_option("my_plugin_page_name");
    add_option("my_plugin_page_name", $the_page_name, '', 'yes');
    // the id...
    delete_option("my_plugin_page_id");
    add_option("my_plugin_page_id", '0', '', 'yes');

    $the_page = get_page_by_title($the_page_title);

    if (!$the_page) {

        // Create post object
        $_p = array();
        $_p['post_title'] = $the_page_title;
        $_p['post_content'] = "";
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = 'closed';
        $_p['post_category'] = array(1); // the default 'Uncatrgorised'
        // Insert the post into the database
        $the_page_id = wp_insert_post($_p);
    } else {
        // the plugin may have been previously active and the page may just be trashed...

        $the_page_id = $the_page->ID;

        //make sure the page is not trashed...
        $the_page->post_status = 'publish';
        $the_page_id = wp_update_post($the_page);
    }

    delete_option('my_plugin_page_id');
    add_option('my_plugin_page_id', $the_page_id);
}

function my_plugin_remove() {

    global $wpdb;

    $the_page_title = get_option("my_plugin_page_title");
    $the_page_name = get_option("my_plugin_page_name");

    //  the id of our page...
    $the_page_id = get_option('my_plugin_page_id');
    if ($the_page_id) {

        wp_delete_post($the_page_id); // this will trash, not delete
    }

    delete_option("my_plugin_page_title");
    delete_option("my_plugin_page_name");
    delete_option("my_plugin_page_id");
}

add_filter('page_template', 'wpa3396_page_template');

function wpa3396_page_template($page_template) {
    if (is_page('images-gallery')) {
        $page_template = dirname(__FILE__) . '/gallery_show.php';
    }
    return $page_template;
}

function getGalleryUrl($postId) {
    global $wpdb;
// get page id using custom query
    $page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'images-gallery' and post_status = 'publish' and post_type='page' ");
    $pageUrl = get_page_link($page_id);
    if (strpos($pageUrl, '?')) {
        $pageUrl = $pageUrl . "&post_id=$postId";
    } else {
        $pageUrl = $pageUrl . "?post_id=$postId";
    }
    return $pageUrl;
}