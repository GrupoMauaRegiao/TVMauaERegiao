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
    <script src='<?php bloginfo("template_url"); ?>/bower_components/sweetalert/lib/sweet-alert.js'></script>
    <script src='<?php bloginfo("template_url"); ?>/js/scripts.min.js'></script>
    <?php if ((($_GET['canal']) && ($_GET['vid'])) || ($_GET['vid'])) { ?>
    <script>
      <?php // Executa vídeo escolhido pelo usuário ?>
      function executarVideoForaOrdem(){var d,b,c,a,e;
      d=document.querySelectorAll(".clips ul li a");
      b="<?php echo $_GET['vid']; ?>";for(c=0,a=d.length;
      c<a;c+=1){e=d[c];if(e.getAttribute("data-vid")===b){TVMaua.apps.flowPlayer(c);
      }}}$(window).bind("load",function(){executarVideoForaOrdem();
      });
    </script>
    <?php } ?>
    <script>
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-44518641-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol
          ? 'https://ssl'
          : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </body>
</html>
