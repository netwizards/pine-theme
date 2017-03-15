<?php

function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//add_filter('jpeg_quality', function($arg){return 100;});

if(extension_loaded("zlib") && (ini_get("output_handler") != "ob_gzhandler"))
   add_action('wp', create_function('', '@ob_end_clean();@ini_set("zlib.output_compression", 1);'));


//add_filter('jpeg_quality', function($arg){return 70;});
function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}

function custom_gallery(){
	$argsThumb = array(
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => null
	);
	$attachments = get_posts($argsThumb);
	if ($attachments) {
		foreach ($attachments as $attachment) {
			echo apply_filters('the_title', $attachment->post_title);
			echo '<img src="'.wp_get_attachment_url($attachment->ID, 'thumbnail', false, false).'" />';
		}
	}
}

//add_shortcode( 'custom_gallery', 'custom_gallery' );

function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

function add_slug_body_class( $classes ) {

	global $post;


	$parent = get_post($post->post_parent);
	$parent_slug = $parent->post_name;

	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name . ' ' . $parent_slug;
	}
	return $classes;
}

add_filter( 'body_class', 'add_slug_body_class' );

class Walker_Child_Classes extends Walker_page {
	function start_el( &$output, $page, $depth, $args, $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID, 'page-'.$page->post_name);
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		}
		elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;

			$output .= " " . mysql2date($date_format, $time);
		}
	}
}

function wp_list_pages_filter($output) {
    // modify $output here, it's a string of <li>'s by the looks of source
    //return $output.'<li class="page_item page-get-started"><a href="https://i2.merchenta.com/signup">Get Started</a></li>';
}
//add_filter('wp_list_pages', 'wp_list_pages_filter');

add_shortcode("gmap", "googleMap");

function googleMap($atts) {
  extract(shortcode_atts(array(
    'x'     => 50,
    'y'     => 50,
    'z'     => 6,
    'title' => "Marker"
  ), $atts));

	ob_start();

	?>

	<div class="googlemap" style="width:100%; height:300px;" data-x="<?php echo $x;?>" data-y="<?php echo $y;?>" data-zoom="<?php echo $z;?>" data-title="<?php echo $title;?>"></div>

  <script>

		_divs = $('div[class*="googlemap"]');

    _divs.each(function(index, el){

	    _div=$(this);
	    $x=_div.data('x');
	    $y=_div.data('y');
	    $zoom=_div.data('zoom');
	    $title=_div.data('title');

      if (_div) {

        var myOptions = {
          center: new google.maps.LatLng($x, $y),
          zoom: $zoom,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var markerPos = myOptions.center;
        var map = new google.maps.Map(_div[0], myOptions);
        var marker = new google.maps.Marker({
          position: markerPos,
          map: map,
          title: $title
        });
      }
    });

	</script>

	<?php $output = ob_get_clean();

	return $output;

	// return '<div class="googlemap" style="width:100%; height:300px;" data-x="'. $x .'" data-y="'. $y .'" data-zoom="' . $z . '" data-title="' . $title . '"></div>';
}

add_theme_support('post-thumbnails', array( 'post', 'page' ) );

// jestpack infinite scroll support and config
function mytheme_infinite_scroll_init() {
  add_theme_support( 'infinite-scroll', array(
      'container' => 'infinite',
      'type'  => 'click',
      //'type'      => 'scroll',
      'footer'    => false,
      //'wrapper'   => false
  ));
}
add_action( 'init', 'mytheme_infinite_scroll_init' );

// sanitize file names on upload
function sanitize_file_name_chars( $special_chars = array() ) {
    $special_chars = array_merge( array( ' ', '  ', '’', '‘', '“', '”', '«', '»', '‹', '›', '—', 'æ', 'œ', '€' ), $special_chars );
    return $special_chars;
}

add_filter( 'sanitize_file_name', 'remove_accents', 10, 1 );
add_filter( 'sanitize_file_name_chars', 'sanitize_file_name_chars', 10, 1 );

function is_mobile() {
  $useragent=$_SERVER['HTTP_USER_AGENT'];

  if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
      return true;
    else
      return false;
}
