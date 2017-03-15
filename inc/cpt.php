<?php

/*-------------------------------------------------------------------------------------------*/
/* Popup Post Type */
/*-------------------------------------------------------------------------------------------*/

class popup {

  function popup() {
    add_action('init',array($this,'create_post_type'));
  }

  function create_post_type() {
    $labels = array(
        'name' => 'Popup',
        'singular_name' => 'Popup',
        'add_new' => 'Add new',
        'all_items' => 'All popups',
        'add_new_item' => 'Add new popup',
        'edit_item' => 'Edit popup',
        'new_item' => 'New popup',
        'view_item' => 'View popup',
        'search_items' => 'Search popups',
        'not_found' =>  'Not found.',
        'not_found_in_trash' => 'Not found in trash.',
        'parent_item_colon' => 'Parent',
        'menu_name' => 'Popups'
    );
    $args = array(
      'labels' => $labels,
      'description' => "Popups",
      'public' => false,
      'exclude_from_search' => true,
      'publicly_queryable' => false,
      'show_ui' => true,
      'show_in_nav_menus' => false,
      'show_in_menu' => true,
      'menu_icon' => '',
      'show_in_admin_bar' => true,
      'menu_position' => 5,
      'capability_type' => 'page',
      'hierarchical' => true,
      'supports' => array( 'title', 'editor', 'thumbnail'),
      //'taxonomies' => array('post_tag'),
      'has_archive' => false,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => false

    );
    register_post_type( 'popup', $args);
  }
}

$popup = new popup();

//add_post_type_support('classes', 'page-attributes');

//flush_rewrite_rules();
