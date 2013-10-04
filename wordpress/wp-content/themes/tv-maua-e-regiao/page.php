<?php get_header(); ?>
  <?php
  if (is_page("anuncie")) {
    include "anuncie.php";
  } elseif (is_page("sobre-nos")) {
    include "sobre-nos.php";
  } elseif (is_page("fale-conosco")) {
    include "fale-conosco.php";
  }
  ?>
<?php get_footer(); ?>