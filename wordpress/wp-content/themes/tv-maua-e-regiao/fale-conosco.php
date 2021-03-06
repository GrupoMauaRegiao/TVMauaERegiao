<div class="banner-pagina-acima banner-fale-conosco"></div>
<div class='conteudo'>
  <div class="titulo-pagina">
    <h2><?php the_title(); ?></h2>
  </div>
  <div class="box">
    <div class="elementos">
      <div class="mensagem-sucesso">
        <p>Mensagem enviada com sucesso.<br> Obrigado!</p>
      </div>
      <div class="formulario-fale-conosco">
        <form action="<?php bloginfo('template_url'); ?>/enviar-mensagem.php" enctype="multipart/form-data" method="get">
          <label for='nome'>Nome <br></label>
          <input id='nome' type='text'>
          <br>
          <label for='email'>E-mail <br></label>
          <input id='email' type='text'>
          <br>
          <label for="mensagem">Mensagem <br></label>
          <textarea name="mensagem" id="mensagem"></textarea>
          <br>
          <input id='enviar' type='button' value='Enviar'>
        </form>
      </div>
      <div class="telefone-endereco">
        <div class="telefone">
          <div class="imagem-telefone"></div>
          <div class="numero">
            <p><i>11</i> 4513-1591</p>
          </div>
        </div>

        <div class="endereco">
          <p>Rua Vitório Veneto, 355<br>
             Vila Vitória - Mauá - SP.
          </p>
        </div>

        <div class="email">
          <a href="mailto: atendimento@tvmauaeregiao.com.br">atendimento@tvmauaeregiao.com.br</a>
        </div>

      </div>
    </div>
  </div>
</div>
