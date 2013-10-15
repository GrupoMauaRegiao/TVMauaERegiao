      <div class='sombra <?php echo inverterSombra(); ?>'></div>
      <div class='rodape'>
        <div class='elementos'>
          <div class='informacoes'>
            <div class='copyright'>
              <p>&copy; <span><?php date(Y) ?> Grupo Mauá e Região</span>, todos os direitos reservados.</p>
            </div>
            <div class='redes-sociais'>
              <a href='https://www.facebook.com/pages/Web-TV-Mau%C3%A1-e-Regi%C3%A3o/448246115280743' target='_blank'>
                <div class='icone facebook'></div>
              </a>
              <a href='https://www.facebook.com/pages/Web-TV-Mau%C3%A1-e-Regi%C3%A3o/448246115280743' target='_blank'>
                <div class='icone youtube'></div>
              </a>
            </div>
            <div class='links'>
              <ul>
                <?php wp_list_pages('sort_column=menu_order&title_li='); ?>
              </ul>
            </div>
            <a href='http://grupomauaeregiao.com.br' target='_blank'>
              <div class='logotipo' title='Grupo Mauá e Região de Comunicação'></div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php wp_footer(); ?>
    <script src='http://code.jquery.com/jquery-2.0.3.min.js'></script>
    <script src='<?php bloginfo("template_url"); ?>/js/scripts.min.js'></script>
  </body>
</html>