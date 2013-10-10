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
  // Destaca vídeo por ID recebido pela variável "vid" (via GET)
  $query = $_GET["vid"];
  $baseQuery = "order=ASC&posts_per_page=20&tag=videos&category_name=" . $category[0]->slug;

  if ($query) {
    $query = $baseQuery . "&p=" . $query;
    $classe = "esconder";
  } else {
    $query = $baseQuery;
    $classe = "exibir";
  }
  ?>

  <div class='conteudo'>
    <div class="nome-categoria">
      <h2><?php echo $category[0]->name; ?></h2>
    </div>
    <div class='player individual <?php if ($_GET["canal"]) { echo "canal"; } ?>'>
      <div class='video'>
        <!-- <a href='http://localhost/TVMauaERegiao/wordpress/wp-content/uploads/2013/09/play.flv' id='flv-player'></a> -->
        <a href='http://marcker.net/tv-wp/wp-content/uploads/2013/09/play.flv' id='flv-player'></a>
      </div>
    </div>
    <div class="informacoes-anunciante">
      <div class='informacoes-anunciante-nome'>
        <div class='nome-anunciante'></div>
      </div>
      <?php if (!$_GET["canal"]) { ?>
        <div class='botao-mais-informacoes'>
          <input type='button' value='Informações'>
        </div>
      <?php } ?>
    </div>
    <div class='sombra <?php echo $classe; ?>'></div>
  </div>
  <div class='lista-de-videos <?php echo $classe; ?>'>
    <div class='clips clips-categoria'>
      <div class="cabecalho-lista-de-videos">
        <?php if ($_GET["canal"]) { ?>
          <h2>Vídeos</h2>
        <?php } else { ?>
          <h2>Anunciantes</h2>
        <?php } ?>
      </div>
      <ul>
        <?php query_posts($query); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <li>
            <?php
            $category = get_the_category();
            $nomeEmpresa = sanitize_title(get_post_meta($post->ID, "NOME EMPRESA (cadastro)", true));
            ?>
            <a data-perfil='<?php echo bloginfo("url") . "/categorias/empresas/" . $nomeEmpresa . add_query_arg("perfil", $nomeEmpresa, ""); ?>'
               data-categoria='<?php echo $category[0]->cat_name; ?>'
               href='<?php echo get_post_meta($post->ID, "VÍDEO", true); ?>'
               title='<?php the_title(); ?>'>
              <img alt='' src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=220&amp;h=160'>
            </a>
          </li>
        <?php endwhile; else: ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>
<?php } ?>
<?php get_footer(); ?>