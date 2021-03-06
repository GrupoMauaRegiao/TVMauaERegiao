TVMaua = TVMaua or {}
TVMaua.apps =
  identificarUserAgent: ->
    doc = document.documentElement
    doc.setAttribute 'data-useragent', navigator.userAgent
    return

  path: ->
    'http://tvmauaeregiao.com.br/wp-content/themes/tv-maua-e-regiao/'

  carregarScripts: ->
    scripts = document.getElementsByTagName('script')[0]

    _carregar = (url) ->
      script = document.createElement 'script'
      script.async = true
      script.src = url
      scripts.parentNode.insertBefore script, scripts
      return

    # Scripts
    _carregar TVMaua.apps.path() + 'js/libs/flowplayer-3.2.12.min.js'
    _carregar TVMaua.apps.path() + 'js/libs/jquery.carouFredSel-6.2.1-packed.js'
    _carregar TVMaua.apps.path() + 'js/libs/fancybox/source/jquery.fancybox.js'
    return

  flowPlayer: (indexVideo) ->
    containerPlayer = document.querySelector '#flv-player'

    if containerPlayer
      flashPlayer = TVMaua.apps.path() + 'flv-player/flowplayer-3.2.16.swf'
      a = document.querySelectorAll '.clips ul li a'
      botInformacoes = document.querySelector '.botao-mais-informacoes input[type="button"]'
      botCompartilhe = document.querySelector '.botao-compartilhe input[type="button"]'
      urlPerfil = ''
      urlPermalink = ''
      nomeAnunciante = ''
      inputModal = $ '.sweet-alert input'
      textModal = $ '.sweet-alert h2'
      publicidadeLateral = document.querySelector '.publicidade a img'
      publicidades = []
      linkPublicidadeLateral = document.querySelector '.publicidade a'
      linksPublicidades = []
      nomeAnuncte = document.querySelector '.informacoes-anunciante-nome .nome-anunciante'
      nomes = []
      dataPublicacaoVideo = document.querySelector '.informacoes-video-canal .data'
      dataPublicacao = []
      descricaoVideo = document.querySelector '.informacoes-video-canal .descricao-video'
      descricao = []
      clips = []
      cats = []
      perfis = []
      permalinks = []
      carousel = jQuery '.clips ul'
      Apps = TVMaua.apps

      _listeners = ->
        if botInformacoes and botCompartilhe
          botInformacoes.addEventListener 'click', _alterarLocationParaPerfil
          botCompartilhe.addEventListener 'click', _abrirModal
        else if botCompartilhe
          botCompartilhe.addEventListener 'click', _abrirModal
        containerPlayer.addEventListener 'dragstart', _desativarDragPlayer

      _desativarDragPlayer = (evt) ->
        evt.preventDefault()
        return

      _alterarLocationParaPerfil = ->
        window.location = urlPerfil
        return

      _abrirModal = ->
        swal {
          type: 'info'
          title: 'Copie e cole o link: ' + nomeAnunciante
          text: urlPermalink
        }

        inputModal.on 'click', ->
          $(this).select()

        textModal.html(textModal.text().replace ':', ':<br>')
        inputModal.val(inputModal.val().replace '&amp;', '&')

      _alterarPublicidadeLateral = (imagem, link) ->
        linkPublicidadeLateral.setAttribute 'href', link
        publicidadeLateral.setAttribute 'src', imagem
        return

      _exibirDadosAnuncte = (tipo, nome, container) ->
        if tipo is 'nome'
          tag = 'h1'
        else if tipo is 'categoria'
          tag = 'p'
        else if tipo is 'data'
          tag = 'span'
        else if tipo is 'descricao'
          tag = 'span'

        # Limita tamanho do título do vídeo
        if tipo is 'nome' and nome.length >= 90
          nome = nome.slice(0, 90) + '...'

        container.innerHTML = '<' + tag + '>' + nome + '</' + tag + '>'
        return

      _playerDefault = ->
        $f containerPlayer, {
          src: flashPlayer,
          wmode: 'transparent'
        }, {
          playlist: clips

          onStart: (clip) ->
            carousel.trigger 'slideTo', clip.index
            Apps.scrollTop()
            urlPerfil = perfis[clip.index]
            urlPermalink = permalinks[clip.index]
            nomeAnunciante = nomes[clip.index]

            _exibirDadosAnuncte 'nome', nomeAnunciante, nomeAnuncte

            if dataPublicacaoVideo
              _exibirDadosAnuncte 'data', dataPublicacao[clip.index], dataPublicacaoVideo
              _exibirDadosAnuncte 'descricao', descricao[clip.index], descricaoVideo

            if publicidades[0]
              _alterarPublicidadeLateral publicidades[clip.index], linksPublicidades[clip.index]

            return

          onFinish: ->
            if @.getClip().index + 1 is @.getPlaylist().length
              $f().play 0
            return

          plugins:
            controls:
              buttonColor: 'rgba(150, 150, 150, 0.9)'
              buttonOverColor: 'rgb(255, 255, 255)'
              backgroundColor: 'rgb(97, 108, 112)'
              backgroundGradient: 'none'
              sliderColor: 'rgb(245, 134, 52)'
              progressColor: 'rgb(245, 134, 52)'
              sliderBorder: 'none'
              volumeSliderColor: 'rgb(245, 134, 52)'
              volumeBorder: 'none'
              timeColor: 'rgb(255, 255, 255)'
              durationColor: 'rgb(255, 255, 255)'
        }

        # Define qual vídeo será iniciado de acordo com o parâmetro que o método
        # `TVMaua.apps.flowPlayer()` recebe.
        if indexVideo
          $f().play indexVideo

      _mudarVideo = (evt) ->
        len = clips.length
        index = clips.indexOf(@.getAttribute 'href') + 1
        urlPerfil = perfis[index - 1]
        urlPermalink = permalinks[index - 1]

        # Player utilizado após clique
        $f(containerPlayer, {
          src: flashPlayer,
          wmode: 'transparent'
        }, {
          onStart: ->
            carousel.trigger 'slideTo', index - 1
            Apps.scrollTop()
            nomeAnunciante = nomes[index - 1]

            _exibirDadosAnuncte 'nome', nomeAnunciante, nomeAnuncte

            if dataPublicacaoVideo
              _exibirDadosAnuncte 'data', dataPublicacao[index - 1], dataPublicacaoVideo
              _exibirDadosAnuncte 'descricao', descricao[index - 1], descricaoVideo

            if publicidades[0]
              _alterarPublicidadeLateral publicidades[index - 1], linksPublicidades[index - 1]

            return

          onFinish: ->
            if index isnt len then posicao = index else posicao = 0
            _playerDefault().play posicao
            return

          plugins:
            controls:
              buttonColor: 'rgba(150, 150, 150, 0.9)'
              buttonOverColor: 'rgb(245, 134, 52)'
              backgroundColor: 'rgb(97, 108, 112)'
              backgroundGradient: 'none'
              sliderColor: 'rgb(245, 134, 52)'
              progressColor: 'rgb(245, 134, 52)'
              sliderBorder: 'none'
              volumeSliderColor: 'rgb(245, 134, 52)'
              volumeBorder: 'none'
              timeColor: 'rgb(255, 255, 255)'
              durationColor: 'rgb(255, 255, 255)'
        }).play @.getAttribute 'href'
        evt.preventDefault()
        return

      for item, i in a by 1
        item.addEventListener 'click', _mudarVideo
        clips[i] = item.getAttribute 'href'
        nomes[i] = item.getAttribute 'title'
        cats[i] = item.getAttribute 'data-categoria'
        perfis[i] = item.getAttribute 'data-perfil'
        linksPublicidades[i] = item.getAttribute 'data-pub-link'
        publicidades[i] = item.getAttribute 'data-pub-imagem'
        dataPublicacao[i] = item.getAttribute 'data-data-publicacao'
        descricao[i] = item.getAttribute 'data-descricao'
        permalinks[i] = item.getAttribute 'data-permalink'

      # Player inicial
      do ->
        _listeners()
        _playerDefault()
        return
    return

  menuCategorias: ->
    menuCategorias = document.querySelector '.menu-categorias'

    if menuCategorias
      categoria = document.querySelector '.cabecalho-categorias'
      textoCategoria = document.querySelector '.cabecalho-categorias .titulo p'
      listaCategorias = document.querySelector '.lista-categorias'

      _listeners = ->
        categoria.addEventListener 'mouseover', _exibir
        listaCategorias.addEventListener 'mouseover', _exibir
        menuCategorias.addEventListener 'mouseout', _esconder
        return

      _exibir = (evt) ->
        listaCategorias.style.display = 'block'
        textoCategoria.style.color = 'rgb(127, 137, 139)'
        evt.preventDefault()
        return

      _esconder = (evt) ->
        listaCategorias.style.display = 'none'
        textoCategoria.style.color = 'rgb(255, 255, 255)'
        evt.preventDefault()
        return

      do ->
        _listeners()
        return
    return

  menuCategoriasProgramas: ->
    menuCategoriasProgramas = document.querySelector '.menu-categorias-programas'

    if menuCategoriasProgramas
      categoria = document.querySelector '.cabecalho-categorias-programas'
      textoCategoria = document.querySelector '.cabecalho-categorias-programas .titulo-categorias-programas p'
      listaCategorias = document.querySelector '.lista-categorias-programas'

      _listeners = ->
        categoria.addEventListener 'mouseover', _exibir
        listaCategorias.addEventListener 'mouseover', _exibir
        menuCategoriasProgramas.addEventListener 'mouseout', _esconder
        return

      _exibir = (evt) ->
        listaCategorias.style.display = 'block'
        textoCategoria.style.color = 'rgb(127, 137, 139)'
        evt.preventDefault()
        return

      _esconder = (evt) ->
        listaCategorias.style.display = 'none'
        textoCategoria.style.color = 'rgb(255, 255, 255)'
        evt.preventDefault()
        return

      do ->
        _listeners()
        return
    return

  controlarTamanhoString: (seletor, maxCaract) ->
    tag = document.querySelectorAll seletor

    if tag[0]
      if tag[0].textContent
        for item in tag by 1
          texto = item.textContent
          if texto.length > maxCaract
            item.textContent = texto.slice(0, maxCaract) + '...'
      else
        for item in tag by 1
          texto = item.innerText
          if texto.length > maxCaract
            item.innerText = texto.slice(0, maxCaract) + '...'
    return

  carousel: ->
    carousel = document.querySelector '.clips ul'

    if carousel
      carousel = jQuery '.clips ul'

      _executar = ->
        carousel.carouFredSel({
          auto: false,
          align: false,
          width: '100%',
          scroll: { items: 1 },
          prev: { button: '.controles .anterior' },
          next: { button: '.controles .proximo' }
        })
        return

      _eventosTeclado = ->
        carousel = jQuery '.clips ul'

        controlarCarousel = (evt) ->
          if evt.keyCode is 37
            carousel.trigger 'prev'
          else if evt.keyCode is 39
            carousel.trigger 'next'
          evt.preventDefault()
          return

        window.addEventListener 'keyup', controlarCarousel
        return

      do ->
        _executar()
        _eventosTeclado()
        return
    return

  animacaoCabecalho: ->
    cabecalho = document.querySelector '.cabecalho'

    if cabecalho
      _opacidadeOn = ->
        @.style.opacity = 1
        return

      _animar = ->
        if @.pageYOffset > 100
          cabecalho.style.opacity = 0.7
        else if @.pageYOffset <= 100
          cabecalho.style.opacity = 1
        return
      window.addEventListener 'scroll', _animar
      cabecalho.addEventListener 'mouseover', _opacidadeOn
    return

  enviarEmail: ->
    formulario = document.querySelector '.formulario-fale-conosco form'

    if formulario
      cNome = document.querySelector '#nome'
      cEmail = document.querySelector '#email'
      cMsg = document.querySelector '#mensagem'
      msgSucesso = document.querySelector '.mensagem-sucesso'
      botao = document.querySelector '#enviar'

      botao.addEventListener 'click', (evt) ->
        xhr = new XMLHttpRequest()
        regexEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
        msg = ''

        if cNome.value isnt ''
          if cEmail.value isnt '' and cEmail.value.match(regexEmail) isnt null
            if cMsg.value isnt ''
              msg += 'nome=' + encodeURI(cNome.value)
              msg += '&email=' + encodeURI(cEmail.value)
              msg += '&mensagem=' + encodeURI(cMsg.value)
              xhr.open formulario.method, formulario.action + '?' + msg, true
              xhr.send msg
              xhr.onreadystatechange = ->
                if xhr.readyState is 4 and xhr.status is 200
                  formulario.style.display = 'none'
                  msgSucesso.setAttribute 'class', 'mensagem-sucesso exibir'
                return
            else
              cMsg.focus()
              cMsg.setAttribute 'class', 'erro'
          else
            cEmail.focus()
            cEmail.setAttribute 'class', 'erro'
        else
          cNome.focus()
          cNome.setAttribute 'class', 'erro'

        evt.preventDefault()
        return
    return

  scrollTop: ->
    $('html, body').animate {
      scrollTop: 0
    }, 1000
    return

  obterEnderecosDoTexto: (texto) ->
    enderecos = []
    re = /{([^}]+)}/g
    endereco = ''

    while (endereco = re.exec texto)
      enderecos.push endereco[1]

    enderecos

  removerChavesDoTexto: (texto) ->
    texto = texto.replace /[\{\}']+/g,''
    texto

  criarMapa: ->
    linksMapa = document.querySelectorAll 'a[href="http://mapa"]'

    if linksMapa[0]
      Apps = TVMaua.apps
      enderecos = document.querySelectorAll '.lista-de-informacoes .box .elementos .texto'
      arrEnderecos = Apps.obterEnderecosDoTexto enderecos[0].textContent

      for linkMapa, i in linksMapa
        linkMapa.setAttribute 'class', 'fancybox.iframe'
        linkMapa.setAttribute 'href', 'https://maps.google.com/?output=embed&q=' + arrEnderecos[i] + '&center=' + arrEnderecos[i] + 'hl=pt&t=m&z=16'

      conteudoEnderecos = document.querySelector '.lista-de-informacoes .box .elementos .texto'
      conteudoEnderecos.innerHTML = Apps.removerChavesDoTexto conteudoEnderecos.innerHTML
    return

  criarEfeitoNoMapa: ->
    $('[href^="https://maps.google.com"]').fancybox {
      maxWidth: 960
      maxHeight: 600
      fitToView: true
      width: '70%'
      height: '70%'
      closeClick: false
      iframe:
        preload: false
    }
    return

  coresAleatorias: ->
    cabecalhoCanal = document.querySelector '.cabecalho-canal'

    if cabecalhoCanal
      texto = document.querySelector '.cabecalho-canal .nome-categoria-canal h2'
      coresBg = [
        "rgb(255, 102, 0)",
        "rgb(0, 148, 208)"
      ]
      coresTexto = [
        "rgb(255, 252, 1)",
        "rgb(0, 70, 145)"
      ]
      num = Math.floor Math.random() * coresBg.length
      cabecalhoCanal.style.backgroundColor = coresBg[num]
      texto.style.color = coresTexto[num]
    return

Apps = TVMaua.apps

do ->
  Apps.carregarScripts()
  Apps.identificarUserAgent()
  Apps.menuCategorias()
  Apps.menuCategoriasProgramas()
  Apps.animacaoCabecalho()
  Apps.controlarTamanhoString '.titulo-video-home', 16
  Apps.controlarTamanhoString '.titulo-video-canal', 48
  Apps.controlarTamanhoString '.nome-programa a', 48
  Apps.controlarTamanhoString '.categoria-programa span', 16
  Apps.enviarEmail()
  Apps.criarMapa()
  Apps.coresAleatorias()
  return

window.onload = ->
  Apps.flowPlayer()
  Apps.carousel()
  Apps.criarEfeitoNoMapa()
  return
