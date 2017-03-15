<?php
/**
 * Template Name: Archive
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>

<?php require_once('partials/featured-posts-slider.php'); ?>

<?php

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'paged'         => $paged,
    'post_type'     => 'post',
    'post_per_page' => 4,
  );

  $the_query = new WP_Query( $args );
  global $wp_query;
  // Put default query object in a temp variable
  $tmp_query = $wp_query;
  // Now wipe it out completely
  $wp_query = null;
  // Re-populate the global with our custom query
  $wp_query = $the_query;

?>

<?php if( $the_query->have_posts() ) : ?>

  <div class="lb-posts">

    <div class="row">
      <!-- linkedin button js code -->
      <script src="//platform.linkedin.com/in.js" type="text/javascript">
        lang: en_US
      </script>
      <!-- facebook button js code -->
      <div id="fb-root"></div>
      <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s);
          js.id = id;
          js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.8&appId=677730929049163";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>

      <div class="lb-posts__list" id="content">

        <header class="lb-posts__list__header">
          <img src="<?php echo get_stylesheet_directory_uri();?>/img/ico_newspaper.svg" width="142" height="101" alt="">
          <h1 class="lb-posts__list__header__heading">Recent News</h1>
          <?php $args = array('class'=>'lb-posts__list__header__categories', 'show_option_all'=>'Show all');?>
          <?php wp_dropdown_categories( $args ); ?>
          <script type="text/javascript">
            <!--
            var dropdown = document.getElementById("cat");
            function onCatChange() {
              if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+dropdown.options[dropdown.selectedIndex].value;
              }
            }
            dropdown.onchange = onCatChange;
            -->
          </script>
        </header>

<?php   while( $the_query->have_posts() ) : $the_query->the_post(); ?>

          <article class="lb-excerpt">
            <date class="lb-excerpt__date"><?php the_date('M d, Y');?></date>
            <h2 class="lb-excerpt__title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
            <div class="lb-excerpt__tagline">
              <?php the_tags(false,false); ?>
            </div>

            <?php the_excerpt();?>

            <footer class="lb-excerpt__socials">

              <div class="lb-excerpt__socials__item">

                <?php /*<a href="https://twitter.com/intent/tweet?text=<?php echo social_excerpt( 140 ); ?>" data-text="<?php echo social_excerpt( 140 ); ?>" class="twitter-default-button" onclick="window.open('https://twitter.com/share?url=<?php the_permalink();?>&text=<?php echo social_excerpt( 140 ); ?>&via=<?php echo site_url();?>','share','resizable,width=600,height=300'); return false;"><i class="fa fa-twitter"></i>Tweet</a>*/?>
                <a href="https://twitter.com/intent/tweet?text=<?php echo social_excerpt( 140 ); ?>" data-text="<?php echo social_excerpt( 140-strlen(get_the_permalink()) ); ?>" class="twitter-default-button" onclick="window.open('https://twitter.com/share?url=<?php the_permalink();?>&text=<?php echo social_excerpt( 140-strlen(get_the_permalink()) ); ?>','share','resizable,width=600,height=300'); return false;"><i class="fa fa-twitter"></i>Tweet</a>

              </div>
              <!-- .lb-post__socials__item -->

              <div class="lb-excerpt__socials__item">
                <script type="IN/Share" data-url="<?php the_permalink();?>" data-counter="right"></script>
              </div>
              <!-- .lb-post__socials__item -->

              <div class="lb-excerpt__socials__item">
                <div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
              </div>
              <!-- .lb-post__socials__item -->

            </footer>
          </article>

<?php   endwhile; ?>

        <div class="lb-posts__pagination">
<?php
          $big = 999999999; // need an unlikely integer

          echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages
          ) );
?>
        </div>
        <!-- .lb-posts__pagination -->

      </div>
      <!-- .lb-posts__list -->

    </div>
    <!-- .row -->

  </div>
  <!-- .lb-posts -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php get_footer();?>

