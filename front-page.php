<?php get_header(); ?>

<div class="title-top-triangle"></div>
<section class="title-elements">
  <h3 class="txt-ib-center">Zaproszenie</h3>
  <?php $podtytul = get_field('podtytul'); if( $podtytul ) : ?><h4 class="txt-ib-center"><?php echo $podtytul;?></h4><?php endif; ?>
</section>
<div class="title-bottom-triangle"></div>

<article class="j-row ib-fix article big-padding-bottom">

  <div class="col13">

  <?php $args = array(
          'category_name' => 'aktualnosci',
          'posts_per_page' => 3
        );

        $aktualnosci = new WP_Query($args);

        if($aktualnosci->have_posts()) :
          while($aktualnosci->have_posts()) :
             $aktualnosci->the_post();

  ?>

            <a href="<?php the_permalink();?>" class="news-container txt-ib-left excerpt">
              <h5><?php echo get_the_date('d');?><span>/<?php echo get_the_date('m');?></span></h5>
              <?php the_excerpt();?>
            </a>

          <?php endwhile; ?>

        <?php endif; ?>

  </div>

  <div class="col23 txt-ib-left article-padding-top">

  <?php while(have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; ?>

  </div>

</article>

<?php get_footer(); ?>
