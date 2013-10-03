    <?php get_header(); ?>

      <div class='conteudo'>
        <div class='player'>
          <div class='video'>
            <!-- <a href='http://localhost/TVMauaERegiao/wordpress/wp-content/uploads/2013/09/play.flv' id='flv-player'></a> -->
            <a href='http://marcker.net/tv-wp/wp-content/uploads/2013/09/play.flv' id='flv-player'></a>
          </div>
        </div>
        <div class='publicidade'>

          <?php query_posts('order=ASC&posts_per_page=1&tag=publicidade-home'); ?>
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <a href='<?php echo get_post_meta($post->ID, 'Link Publicidade 180 x 450', true); ?>' target='_blank'>
              <img src="<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, 'Publicidade 180 x 450', true); ?>&amp;w=180&amp;450" alt="">
            </a>
          <?php endwhile; else: ?>
            <img src='<?php bloginfo("template_url"); ?>/imagens/sem-publicidade.jpg' alt=''>
          <?php endif; ?>
        </div>
        <div class="informacoes-anunciante">
          <div class='informacoes-anunciante-nome'>
            <div class='nome-anunciante'></div>
          </div>
          <div class='botao-mais-informacoes'>
            <input type='button' value='Informações'>
          </div>
        </div>
      </div>
      <div class='lista-de-videos'>
        <div class='controles'>
          <input class='anterior' title='Anterior' type='button' value=' '>
          <input class='proximo' title='Próximo' type='button' value=' '>
        </div>
        <div class='clips'>
          <ul>

            <?php query_posts("order=ASC&posts_per_page=20&tag=videos&cat=-12"); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

              <li>
                <?php $categoria = get_the_category(); ?>
                <a data-categoria='<?php echo $categoria[0]->cat_name; ?>' href='<?php echo get_post_meta($post->ID, "VÍDEO", true); ?>' title='<?php the_title(); ?>'>
                  <img alt='' src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=220&amp;h=180'>
                  <p><?php the_title(); ?></p>
                </a>
              </li>

            <?php endwhile; else: ?>
            <?php endif; ?>

          </ul>
        </div>
      </div>
      <div class="lista-de-programas">
        <div class="conteudo-programas">
          <div class="titulo">
            <h2>Programas</h2>
          </div>

          <div class="programas">

            <?php query_posts("order=ASC&posts_per_page=4&category_name=programas"); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <?php $categoria = get_the_category(); ?>

              <div class="programa">
                <div class="imagem">
                  <img src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=240&amp;h=250' alt="">
                </div>
                <div class="aba-imagem"></div>
                <div class="informacoes-programa">
                  <div class="categoria-programa">
                    <span title="<?php echo $categoria[0]->cat_name; ?>"><?php echo $categoria[0]->cat_name; ?></span>
                  </div>
                  <div class="nome-programa">
                    <a href="<?php bloginfo('url'); ?>/categorias/programas/<?php echo $categoria[0]->slug . add_query_arg('canal', 1, ''); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                  </div>
                </div>
              </div>

          <?php endwhile; else: ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  <?php get_footer(); ?>