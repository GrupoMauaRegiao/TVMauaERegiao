<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <meta content='tv maua, maua, sp, maua e regiao, gerupo maua e regiao, empresas de mauá, ribeirão pires, revista maua, jornal maua, comprar em maua, comprar em rio grande da serra, comprar em ribeirão pires' name='keywords'>
    <meta content='Esta é a Web TV Mauá e Região. Fique à vontade para assistir os vídeos de nossos patrocinadores e compartilhe.' name='description'>
    <meta content='Grupo Mauá e Região de Comunicaçãotva' name='author'>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/imagens/favicon.ico" />
    <link href='<?php bloginfo("template_url"); ?>/css/styles.min.css' rel='stylesheet'>
    <title><?php echo definirTitulo(); ?></title>
  </head>
  <body class="<?php echo adicionarClasse(); ?>">
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