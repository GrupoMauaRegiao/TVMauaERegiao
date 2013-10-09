<?php
function definirTitulo() {
  $arrCategoria = get_the_category();
  $nome = get_bloginfo('name');
  $nomeCategoria = $arrCategoria[0]->cat_name;
  $tituloPadrao = "&#x25B6; " . $nome;
  $titulo = get_the_title();
  $busca = get_search_query();

  function verificaQTDVideos($arrCategoria) {
    $QTDVideos = $arrCategoria[0]->count;
    return $QTDVideos > 1 ? $QTDVideos . " vídeos" : $QTDVideos . " vídeo";
  }

  if ($nomeCategoria) {
    $categoria = $arrCategoria[0]->cat_name . " (" . verificaQTDVideos($arrCategoria) . ")";
  } else {
    $categoria = "Perfil não publicado";
  }

  if (is_home()) {
    $tituloWebsite = $tituloPadrao;
  } elseif (is_page()) {
    $tituloWebsite = $tituloPadrao . " | " . $titulo;
  } elseif (is_category()) {
    if (in_category('15')) {
      $tituloWebsite = $tituloPadrao . " | Perfil: " . $titulo;
    } else {
      $tituloWebsite = $tituloPadrao . " | " . $categoria;
    }
  } elseif (is_search()) {
    $tituloWebsite = $tituloPadrao . " | Busca por " . $busca;
  } elseif (is_404()) {
    $tituloWebsite = $tituloPadrao . " | Página não encontrada";
  } 

  return $tituloWebsite;
}

function categoriasSemTitle() {
  $categories = wp_list_categories('show_count=1&echo=0&orderby=name&title_li&exclude=6,12,15');
  $categories = preg_replace('/title=\"(.*?)\"/', '', $categories);
  $categories = str_replace("(", "<i>", $categories);
  $categories = str_replace(")", "</i>  ", $categories);
  return $categories;
}

function adicionarClasseHome() {
  if (is_home()) {
    $classe = "home";
  } elseif (is_category()) {
    if (in_category('15')) {
      $classe = "perfil";
    }
  } else {
    $classe = "";
  }
  return $classe;
}

function inverterSombra() {
  wp_reset_query();
  if (is_home()) {
    $classe = "invertida";
  } else {
    $classe = "";
  }
  return $classe;
}
?>