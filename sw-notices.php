<?php
/*
Plugin Name: SW Notices Custom Post Type
Description: Creates a custom post type 'SW Notices' with custom taxonomies and icons.
Version: 1.0
Author: Your Name
*/

// Register the custom post type 'SW Notices'
function sw_notices_custom_post_type() {
    $labels = array(
        'name'               => 'SW Notices',
        'singular_name'      => 'SW Notice',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New SW Notice',
        'edit_item'          => 'Edit SW Notice',
        'new_item'           => 'New SW Notice',
        'view_item'          => 'View SW Notice',
        'search_items'       => 'Search SW Notices',
        'not_found'          => 'No SW Notices found',
        'not_found_in_trash' => 'No SW Notices found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'SW Notices'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'sw-notices'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-megaphone', // Custom icon for the menu
        'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );

    register_post_type('sw_notices', $args);
}

add_action('init', 'sw_notices_custom_post_type');

// Register custom taxonomies for 'SW Notices'
function sw_notices_taxonomies() {
    register_taxonomy('sw_notice_tags', 'sw_notices', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => 'Notice Tags',
            'singular_name' => 'Notice Tag',
            'menu_name' => 'Tags',
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'notice-tags'),
    ));

    register_taxonomy('sw_notice_categories', 'sw_notices', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Notice Categories',
            'singular_name' => 'Notice Category',
            'menu_name' => 'Categories',
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'notice-categories'),
    ));
}

add_action('init', 'sw_notices_taxonomies');

// Activation Hook
function sw_notices_plugin_activation() {
    // Flush the rewrite rules to create the 'SW Notices' post type
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'sw_notices_plugin_activation');

// Deactivation Hook
function sw_notices_plugin_deactivation() {
    // Flush the rewrite rules when deactivating the plugin
    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'sw_notices_plugin_deactivation');
