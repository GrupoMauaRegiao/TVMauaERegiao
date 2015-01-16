<?php $category = get_the_category(); ?>

<?php get_header(); ?>

<?php if ($_GET["perfil"]) { ?>
  <?php $cat = get_the_category(); ?>

  <?php $query = "order=ASC&posts_per_page=1&child_of=15&category_name=" . $_GET['perfil']; ?>

  <div class="conteudo">

    <?php query_posts($query); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <div class="titulo-perfil">
          <h2><?php the_title(); ?></h2>
        </div>
        <div class="lista-de-informacoes">
          <div class="box">
            <div class="elementos">
              <div class="texto">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>

    <?php endwhile; else: ?>

      <div class="titulo-perfil">
        <h2>Sem perfil por enquanto</h2>
      </div>
      <div class="lista-de-informacoes">
        <div class="box">
          <div class="elementos">
            <div class="texto">
              <p>O perfil para esta empresa ainda não foi criado. Aguarde novidades!</p>
            </div>
          </div>
        </div>
      </div>

    <?php endif; ?>
  </div>
<?php } else { ?>

  <?php
    $baseQuery = "order=DESC&posts_per_page=20&tag=videos&category_name=" . $category[0]->slug;
    $query = $baseQuery;
  ?>

  <?php if ($_GET["canal"]) { ?>
    <div class="cabecalho-canal">
      <div class="nome-categoria-canal">
        <h2><?php echo $category[0]->cat_name; ?></h2>
      </div>
    </div>
  <?php } ?>

  <div class='conteudo'>
    <?php if (!$_GET["canal"]) { ?>
      <div class="nome-categoria">
        <h2><?php echo $category[0]->cat_name; ?></h2>
      </div>
    <?php } ?>
    <div class='player individual <?php if ($_GET["canal"]) { echo "canal"; } ?>'>
      <div class='video'>
        <a href='http://tvmauaeregiao.com.br/wp-content/uploads/2013/10/videocomercial.wmv.flv' id='flv-player'></a>
      </div>
    </div>
    <div class="informacoes-anunciante">
      <div class='informacoes-anunciante-nome'>
        <div class='nome-anunciante'></div>
      </div>
      <?php if (!$_GET["canal"]) { ?>
        <div class="botao-compartilhe">
          <input type="button" value="Compartilhe">
        </div>
        <div class='botao-mais-informacoes'>
          <input type='button' value='Informações'>
        </div>
      <?php } ?>
    </div>

    <?php if ($_GET["canal"]) { ?>
    <div class="informacoes-video-canal">
      <div class="data"></div>
      <div class="descricao-video"></div>
    </div>
    <?php } ?>
    <?php if (!$_GET["canal"]) { ?>
      <div class='sombra'></div>
    <?php } ?>
  </div>

  <div class='lista-de-videos <?php if ($_GET["canal"]) { echo "lista-videos-canal"; } ?>'>
    <div class='clips clips-categoria'>

      <?php if (!$_GET["canal"]) { ?>
        <div class="cabecalho-lista-de-videos">
          <h2>Anunciantes</h2>
        </div>
      <?php } elseif ($_GET["canal"]) { ?>
        <div class="cabecalho-lista-de-videos">
          <h2>Vídeos do canal</h2>
        </div>
      <?php } ?>

      <ul>
        <?php $indexPost = -1; ?>
        <?php query_posts($query); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <li>
            <?php
            $category = get_the_category();
            $nomeEmpresa = sanitize_title(get_post_meta($post->ID, "NOME EMPRESA (cadastro)", true));
            ?>
            <a data-perfil='<?php echo bloginfo("url") . "/categorias/empresas/" . $nomeEmpresa . add_query_arg("perfil", $nomeEmpresa, ""); ?>'
               data-categoria='<?php echo $category[0]->cat_name; ?>'
               data-data-publicacao='<?php echo "Publicado dia " . get_the_date(); ?>'
               data-descricao='<?php echo get_post_meta($post->ID, "Descrição VÍDEO", true); ?>'
               data-permalink='<?php bloginfo("url"); ?>/categorias/<?php echo $category[0]->slug; ?>/?vid=<?php echo $post->ID; ?>'
               data-index='<?php $indexPost += 1; echo $indexPost; ?>'
               data-vid='<?php echo $post->ID; ?>'
               href='<?php echo get_post_meta($post->ID, "VÍDEO", true); ?>'
               title='<?php the_title(); ?>'>
              <img alt='' src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=220&amp;h=160'>

              <?php if ($_GET["canal"]): ?>
                <p class="titulo-video-canal"><?php the_title(); ?></p>
              <?php endif ?>

            </a>
          </li>
        <?php endwhile; else: ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>
<?php } ?>
<?php get_footer(); ?>
