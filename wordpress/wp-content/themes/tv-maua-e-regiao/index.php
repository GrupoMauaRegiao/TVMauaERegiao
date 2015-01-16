    <?php get_header(); ?>

      <div class='conteudo'>
        <div class='player'>
          <div class='video'>
            <a href='http://tvmauaeregiao.com.br/wp-content/uploads/2013/10/videocomercial.wmv.flv' id='flv-player'></a>
          </div>
        </div>
        <div class='publicidade'>
          <a href='http://grupomauaeregiao.com.br' target='_blank'>
            <img src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php bloginfo("template_url"); ?>/imagens/sem-publicidade.jpg&amp;w=180&amp;h=450' alt=''>
          </a>
        </div>
        <div class="informacoes-anunciante">
          <div class='informacoes-anunciante-nome'>
            <div class='nome-anunciante'></div>
          </div>
          <div class="botao-compartilhe">
              <input type="button" value="Compartilhe">
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

            <?php query_posts("orderby=rand&posts_per_page=20&tag=videos&cat=-4"); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

              <li>
                <?php
                $categoria = get_the_category();
                $nomeEmpresa = sanitize_title(get_post_meta($post->ID, "NOME EMPRESA (cadastro)", true));
                ?>
                <a data-perfil='<?php echo bloginfo("url") . "/categorias/empresas/" . $nomeEmpresa . add_query_arg("perfil", $nomeEmpresa, ""); ?>'
                   data-categoria='<?php echo $categoria[0]->cat_name; ?>'
                   data-pub-imagem='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Publicidade IMAGEM (180 X 450)", true); ?>&amp;w=180&amp;h=450&amp;q=100'
                   data-pub-link='<?php echo get_post_meta($post->ID, "Publicidade LINK", true); ?>'
                   data-data-publicacao='<?php echo "Publicado dia " . get_the_date(); ?>'
                   data-descricao='<?php echo get_post_meta($post->ID, "Descrição VÍDEO", true); ?>'
                   data-permalink='<?php bloginfo("url"); ?>/categorias/<?php echo $categoria[0]->slug; ?>/?vid=<?php echo $post->ID; ?>'
                   href='<?php echo get_post_meta($post->ID, "VÍDEO", true); ?>'
                   title='<?php the_title(); ?>'>
                  <img alt='' src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=220&amp;h=180&amp;q=100'>
                  <p class="titulo-video-home"><?php the_title(); ?></p>
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

          <div class="menu-categorias-programas">
            <div class='cabecalho-categorias-programas'>
              <div class='titulo-categorias-programas'>
                <p>Categorias</p>
              </div>
              <div class='seta'>
                <p>&#9660;</p>
              </div>
            </div>
            <div class='lista-categorias-programas'>
              <div class='aba'></div>
              <ul>
                <?php echo categoriasProgramas(); ?>
              </ul>
            </div>
          </div>

          <div class="programas">

            <?php query_posts("order=DESC&posts_per_page=4&category_name=programas"); ?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <?php $categoria = get_the_category(); ?>

              <div class="programa">
                <a href="<?php bloginfo('url'); ?>/categorias/programas/<?php echo $categoria[0]->slug . add_query_arg('canal', 1, ''); ?>&amp;vid=<?php echo $post->ID; ?>" title="<?php echo $categoria[0]->cat_name; ?>">
                  <div class="imagem">
                    <img src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=240&amp;h=250' alt="">
                  </div>
                </a>
                <div class="aba-imagem"></div>
                <div class="informacoes-programa">
                  <div class="categoria-programa">
                    <a href="<?php bloginfo('url'); ?>/categorias/programas/<?php echo $categoria[0]->slug . add_query_arg('canal', 1, ''); ?>" title="<?php echo $categoria[0]->cat_name; ?>"><?php echo $categoria[0]->cat_name; ?></a>
                  </div>
                  <div class="nome-programa">
                    <a href="<?php bloginfo('url'); ?>/categorias/programas/<?php echo $categoria[0]->slug . add_query_arg('canal', 1, ''); ?>&amp;vid=<?php echo $post->ID; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                  </div>
                </div>
              </div>

          <?php endwhile; else: ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  <?php get_footer(); ?>
