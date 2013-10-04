<div class='conteudo'>
  <div class="titulo-pagina">
    <h2><?php the_title(); ?></h2>
  </div>
  <div class="box">
    <div class="elementos">
      <div class="formulario">
        <form action="enviar-mensagem.php" enctype="multipart/form-data" method="get">
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
          <p>Rua Clodoaldo Portugal<br> 
             Caribé, 276 - Vila Assis<br>
             Mauá - SP. CEP: 09370-620
          </p>
        </div>

        <div class="email">
          <a href="mailto: atendimento@tvmauaeregiao.com.br">atendimento@tvmauaeregiao.com.br</a>
        </div>

      </div>
    </div>
  </div>
</div>