  <div class="title-top-triangle"></div>
    <section class="logo-img-container">
      <img class="txt-block-center" src="<?php echo get_stylesheet_directory_uri();?>/img/ico_ukw-footer.png" width="297" height="55" alt="" />
    </section>
    <div class="title-bottom-triangle"></div>
    <footer class="footer">
      <div class="j-row ib-fix">
        <div class="col12">
          <a href="http://netwizards.com.pl/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri();?>/img/ico_netwizards.png" width="102" height="15" alt="" /></a>
        </div>
        <div class="col12 txt-ib-right">
          <?php $email = ot_get_option( 'email_address' ); if( $email) : ?>
            <p>e-mail: <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></p>
          <?php endif; ?>
        </div>
      </div>
    </footer>
    <!-- / footer -->

  </div>
  <!-- / wrapper -->


<?php wp_footer();?>

</body>

</html>


