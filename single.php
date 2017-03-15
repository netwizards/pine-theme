<?php
/**
 * The template for displaying all posts.
 *
 */

get_header(); ?>

<?php while(have_posts()) : the_post(); ?>

  <div class="title-top-triangle"></div>
  <section class="title-elements">
    <h3 class="txt-ib-center"><?php the_title();?></h3>
    <?php $podtytul = get_field('podtytul'); if( $podtytul ) : ?><h4 class="txt-ib-center"><?php echo $podtytul;?></h4><?php endif; ?>
  </section>
  <div class="title-bottom-triangle"></div>

  <article class="j-row ib-fix article big-padding-bottom">

    <div class="col23 txt-block-center article-padding-top txt-ib-left">

      <?php the_content();?>

    </div>

  </article>

<?php endwhile; ?>

<?php get_footer(); ?>
