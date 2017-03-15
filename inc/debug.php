<?php
/*
add_action('wp_print_scripts','head_files');
function head_files(){

    global $wp_scripts, $auto_compress_scripts;

    print 'print out head.js';  

    $queue = $wp_scripts->queue;
        $wp_scripts->all_deps($queue);
        $to_do = $wp_scripts->to_do;
    $headArray = array();
        foreach ($to_do as $key => $handle) {
            $src = $wp_scripts->registered[$handle]->src;
        $headArray[] = $src;
    }

    //print 'print out head.js("'.implode("'",$headArray.'")';
}
*/

function list_hooked_functions($tag=false){
 global $wp_filter;
 if ($tag) {
  $hook[$tag]=$wp_filter[$tag];
  if (!is_array($hook[$tag])) {
  trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);
  return;
  }
 }
 else {
  $hook=$wp_filter;
  ksort($hook);
 }
 echo '<pre>';
 foreach($hook as $tag => $priority){
  echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";
  ksort($priority);
  foreach($priority as $priority => $function){
  echo $priority;
  foreach($function as $name => $properties) echo "\t$name<br />";
  }
 }
 echo '</pre>';
 return;
}
//list_hooked_functions();
//wp print styles
//wp print scripts
//get header

function performance( $visible = false ) {

    $stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
        get_num_queries(),
        timer_stop( 0, 3 ),
        memory_get_peak_usage() / 1024 / 1024
        );

    echo $visible ? $stat : "<!-- {$stat} -->" ;
}
//add_action( 'admin_footer_text', 'performance', 20 );

?>