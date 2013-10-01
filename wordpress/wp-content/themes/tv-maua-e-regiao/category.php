<?php $category = get_the_category(); ?>
<?php get_header(); ?>

<?php // Destaca vídeo por ID recebido pela variável "vid" (via GET)
$query = $_GET["vid"];
$baseQuery = "order=ASC&posts_per_page=20&tag=videos&category_name=" . $category[0]->slug;

if ($query) {
  $query = $baseQuery . "&p=" . $query;
} else {
  $query = $baseQuery;
}
?>
<div class='conteudo'>
  <div class="nome-categoria">
    <h2><?php echo $category[0]->name; ?></h2>
  </div>
  <div class='player individual'>
    <div class='video'>
      <!-- <a href='http://localhost/TVMauaERegiao/wordpress/wp-content/uploads/2013/09/play.flv' id='flv-player'></a> -->
      <a href='http://marcker.net/tv-wp/wp-content/uploads/2013/09/play.flv' id='flv-player'></a>
    </div>
  </div>
  <div class='informacoes-anunciante'>
    <div class='nome-anunciante'></div>
  </div>
  <div class='botao-mais-informacoes'>
    <input type='button' value='Mais Informações'>
  </div>
  <div class='sombra esconder'></div>
</div>
<div class='lista-de-videos esconder'>
  <div class='clips clips-categoria'>
    <div class="cabecalho-lista-de-videos">
      <h2>Anunciantes</h2>
    </div>
    <ul>
      <?php query_posts($query); ?>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
          <?php $category = get_the_category(); ?>
          <a data-categoria='<?php echo $category[0]->cat_name; ?>' href='<?php echo get_post_meta($post->ID, "VÍDEO", true); ?>' title='<?php the_title(); ?>'>
            <img alt='' src='<?php bloginfo("template_url"); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "Miniatura VÍDEO", true); ?>&amp;w=220&amp;h=160'>
          </a>
        </li>
      <?php endwhile; else: ?>
      <?php endif; ?>
    </ul>
  </div>
</div>
<?php get_footer(); ?>