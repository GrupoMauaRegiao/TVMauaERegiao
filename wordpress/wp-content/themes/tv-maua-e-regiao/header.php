<?php
function definirTitulo() {
  $arrCategoria = get_the_category();

  function verificaQTDVideos($arrCategoria) {
    $QTDVideos = $arrCategoria[0]->count;
    return $QTDVideos > 1 ? $QTDVideos . " vídeos" : $QTDVideos . " vídeo";
  }

  $categoria = $arrCategoria[0]->cat_name . " (" . verificaQTDVideos($arrCategoria) . ")";

  $nome = get_bloginfo('name');
  $tituloPadrao = "&#9658; " . $nome;
  $titulo = get_the_title();
  $busca = get_search_query();


  if (is_home()) {
    $tituloWebsite = $tituloPadrao;
  } elseif (is_page()) {
    $tituloWebsite = $tituloPadrao . " | " . $titulo;
  } elseif (is_category()) {
    $tituloWebsite = $tituloPadrao . " | " . $categoria;
  } elseif (is_search()) {
    $tituloWebsite = $tituloPadrao . " | Busca por " . $busca;
  } elseif (is_404()) {
    $tituloWebsite = $tituloPadrao . " | Página não encontrada";
  }

  return $tituloWebsite;
}

function categoriasSemTitle() {
  $categories = wp_list_categories('show_count=1&echo=0&orderby=name&title_li&exclude=6');
  $categories = preg_replace('/title=\"(.*?)\"/', '', $categories);
  $categories = str_replace("(", "<i>", $categories);
  $categories = str_replace(")", "</i>  ", $categories);
  return $categories;
}
?>
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
  <body>
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