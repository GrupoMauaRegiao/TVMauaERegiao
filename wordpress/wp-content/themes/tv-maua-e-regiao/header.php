<!doctype html>
<html prefix='og: http://ogp.me/ns#'>
  <head>
    <meta charset='UTF-8'>
    <meta content='tv maua, maua, sp, maua e regiao, grupo maua e regiao, empresas de mauá, ribeirão pires, revista maua, jornal maua, comprar em maua, comprar em rio grande da serra, comprar em ribeirão pires' name='keywords'>
    <meta content='Esta é a Web TV Mauá e Região. Fique à vontade para assistir os vídeos de nossos patrocinadores e compartilhe os nossos programas também.' name='description'>
    <meta content='Grupo Mauá e Região de Comunicaçãotva' name='author'>

    <!-- Open Graph Protocol -->
    <meta property="og:url" content="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />

    <?php if (is_home()) { ?>

      <meta property="og:type" content="website" />
      <meta property="og:title" content="<?php bloginfo('name'); ?>" />
      <meta property="og:description" content="Esta é a Web TV Mauá e Região. Fique à vontade para assistir os vídeos de nossos patrocinadores e compartilhe os nossos programas também." />

    <?php } else if (is_category()) {
      if ($_GET['vid']) { ?>

        <meta property="og:type" content="video" />
        <meta property="og:title" content="<?php echo get_the_title($_GET['vid']); ?>" />
        <meta property="og:description" content="A <?php echo get_the_title($_GET['vid']); ?> tem um vídeo novo na TV Mauá e Região. Não perca tempo, assista-o agora mesmo." />
        <meta property="og:video" content="<?php echo get_post_meta($_GET['vid'], "VÍDEO", true); ?>">
        <meta property="og:video:type" content="application/x-shockwave-flash" />
        <meta property="og:video:width" content="640" />
        <meta property="og:video:height" content="480" />

      <?php } ?>
    <?php } else { ?>

      <meta property="og:type" content="website" />
      <meta property="og:title" content="<?php bloginfo('name'); ?>" />
      <meta property="og:description" content="Esta é a Web TV Mauá e Região. Fique à vontade para assistir os vídeos de nossos patrocinadores e compartilhe os nossos programas também." />

    <?php } ?>
    <!-- # Open Graph Protocol -->

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/imagens/favicon.ico" />
    <link href='<?php bloginfo("template_url"); ?>/js/libs/fancybox/source/jquery.fancybox.css' rel='stylesheet'>
    <!--[if IE]>
      <link href='http://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet'>
    <![endif]-->
    <link href='<?php bloginfo("template_url"); ?>/css/styles.min.css' rel='stylesheet'>
    <title><?php echo definirTitulo(); ?></title>
  </head>
  <body class="<?php if ($_GET["canal"]) { echo "pagina-canal"; } ?><?php echo adicionarClasseHome(); ?>">
    <div class='layout'>
      <div class='cabecalho'>
        <div class='elementos'>
          <a href='<?php bloginfo('url'); ?>' title='TV Mauá e Região'>
            <div class='logotipo'></div>
          </a>
          <?php get_search_form(); ?>
          <div class='menu-categorias'>
            <div class='cabecalho-categorias'>
              <div class='titulo'>
                <p>Categorias</p>
              </div>
              <div class='seta'>
                <p>&#9660;</p>
              </div>
            </div>
            <div class='lista-categorias'>
              <div class='aba'></div>
              <ul>
                <?php echo categoriasSemTitle(); ?>
              </ul>
            </div>
          </div>
        </div>
      </div>