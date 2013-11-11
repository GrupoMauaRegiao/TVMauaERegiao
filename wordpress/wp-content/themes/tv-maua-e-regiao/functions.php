<?php
function mostrarURL() {
  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = str_replace('&', '&amp;', $url);
  return $url;
}

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
    if (in_category('3')) {
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
  # 3 => Empresas
  # 4 => Programas
  $categories = wp_list_categories('show_count=1&echo=0&orderby=name&title_li&exclude=4,3');
  // Remove atributo title
  $categories = preg_replace('/title=\"(.*?)\"/', '', $categories);
  // Adiciona tag i para o número de posts
  $categories = str_replace("(", "<i>", $categories);
  $categories = str_replace(")", "</i>", $categories);
  return $categories;
}

function categoriasProgramas() {
  # 4 => Programas
  $categories = wp_list_categories('show_count=1&echo=0&orderby=name&title_li&child_of=4');
  // Remove atributo title
  $categories = preg_replace('/title=\"(.*?)\"/', '', $categories);
  // Adiciona tag i para o número de posts
  $categories = str_replace("(", "<i>", $categories);
  $categories = str_replace(")", "</i>", $categories);
  // Adiciona parâmetro `?canal=1` a URL
  $categories = preg_replace('/(\<a [^>]*href=")([^"]*)"/i', '${1}${2}?canal=1"', $categories);
  return $categories;
}

function adicionarClasseHome() {
  if (is_home()) {
    $classe = "home";
  } elseif (is_category()) {
    if (in_category('3')) {
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