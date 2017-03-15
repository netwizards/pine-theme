<?php
/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

require_once locate_template('/inc/global.php');
require_once locate_template('/inc/admin.php');
require_once locate_template('/inc/cleanup.php');
require_once locate_template('/inc/enque.php');
require_once locate_template('/inc/menus.php');
//require_once locate_template('/inc/options.php');

  // apply tags to attachments
function wptp_add_tags_to_attachments() {
  register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}

add_action( 'init' , 'wptp_add_tags_to_attachments' );

function new_excerpt_more($more) {
  global $post;
  //return ' <a class="read-more" href="'. get_permalink($post->ID) . '">Więcej</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function social_encode($content) {
  return htmlspecialchars(urlencode(html_entity_decode($content, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
}
