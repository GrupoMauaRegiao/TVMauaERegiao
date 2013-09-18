      <?php get_header(); ?>

      <div class='conteudo'>
        <div class='player'>
          <div class='video'>
            <a href='http://localhost/TVMauaERegiao/wordpress/wp-content/uploads/2013/09/play.flv' id='flv-player'></a>
          </div>
        </div>
        <div class='publicidade'></div>
        <div class='informacoes-anunciante'>
          <div class='nome-anunciante'></div>
          <div class='categoria'></div>
        </div>
        <div class='botao-mais-informacoes'>
          <input type='button' value='Mais Informações'>
        </div>
      </div>
      <div class='lista-de-videos'>
        <div class='controles'>
          <input class='anterior' title='Anterior' type='button' value=' '>
          <input class='proximo' title='Próximo' type='button' value=' '>
        </div>
        <div class='clips'>
          <ul>
            <?php query_posts('order=ASC&posts_per_page=20&tag=videos'); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <li>
                <a data-categoria='<?php echo get_the_category()[0]->cat_name; ?>' href='<?php echo get_post_meta($post->ID, 'VÍDEO', true); ?>' title='<?php the_title(); ?>'>
                  <img alt='' src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, 'Miniatura VÍDEO', true); ?>&amp;w=220&amp;h=180'>
                  <p><?php the_title(); ?></p>
                </a>
              </li>
            <?php endwhile; else: ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
      <div class='box'>
        <div class='elementos'>
          <p>Aqui serão publicados novos conteúdos lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, reprehenderit laboriosam nobis dolor minima eaque obcaecati! Tenetur, non, eum perspiciatis alias deleniti illo quo pariatur. Nesciunt, eos velit optio laborum!</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, consectetur alias soluta assumenda molestiae facilis at iusto aut harum porro saepe architecto quidem omnis accusantium eius neque dolores illo adipisci! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, pariatur voluptatibus blanditiis dicta mollitia nesciunt vero modi cupiditate consectetur dignissimos ea nemo consequatur ad animi natus deleniti corrupti quo explicabo!</p>
        </div>
      </div>

      <?php get_footer(); ?>