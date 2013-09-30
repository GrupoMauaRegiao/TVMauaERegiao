<?php get_header(); ?>
  <?php // Obter somente posts com a tag 'video' no resultado. ?>
  <?php
    if (!$wp_query){
      global $wp_query;
    }
    $args = array( 'tag' => 'videos' );
    $args = array_merge( $args , $wp_query->query );
    query_posts( $args );
  ?>

  <?php if ( have_posts() ) : ?>
  <div class='conteudo'>
    <div class="icone-lupa"></div>
    <div class="mensagem-busca">
      <h2>Resultados para <i><?php echo get_search_query(); ?></i></h2>
    </div>
    <div class="box">
      <div class="elementos">
        <?php while ( have_posts() ) : the_post(); ?>
          <?php $category = get_the_category(); ?>
          <div class="sugestoes">
          <a href="<?php bloginfo('url'); ?>/categorias/<?php echo $category[0]->slug; ?>">
            <div class="sugestao">
              <div class="imagem">
                <img alt='' src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=120&amp;h=100' />
              </div>
              <div class="categoria">
                <span>
                  <?php the_title(); ?> &raquo; <i><?php echo $category[0]->cat_name; ?></i>
                </span>
              </div>
            </div>
          </a>
          </div>
        <?php endwhile; else : ?>

          <div class='conteudo'>
            <div class="icone-lupa"></div>
            <div class="mensagem-busca">
              <h2>Busca por <i><?php echo get_search_query(); ?></i></h2>
            </div>
            <div class="box">
              <div class="elementos">
                <div class="busca-por-videos">
                  <p>Infelizmente sua busca por <i><?php echo get_search_query(); ?></i> não obteve resultados.
                  <br />
                  Por favor, procure com outros termos ou assista as sugestões:</p>
                </div>
                <div class="sugestoes">
                  <?php query_posts("orderby=rand&posts_per_page=5&tag=videos"); ?>
                  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php $category = get_the_category(); ?>
                      <a href="<?php bloginfo('url'); ?>/categorias/<?php echo $category[0]->slug; ?>">
                        <div class="sugestao">
                          <div class="imagem">
                            <img alt='' src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=120&amp;h=100' />
                          </div>
                          <div class="categoria">
                            <span>
                              <?php the_title(); ?> &raquo; <i><?php echo $category[0]->cat_name; ?></i>
                            </span>
                          </div>
                        </div>
                      </a>

                  <?php endwhile; else: ?>
                  <?php endif; ?>
                </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php get_footer(); ?>