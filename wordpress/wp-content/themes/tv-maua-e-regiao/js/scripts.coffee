TVMaua = TVMaua or {}
TVMaua.apps =
  carregarScripts: ->
    scripts = document.getElementsByTagName('script')[0]

    _carregar = (url) ->
      script = document.createElement 'script'
      script.async = true
      script.src = url
      scripts.parentNode.insertBefore script, scripts
      return

    # Scripts
    _carregar 'js/libs/flowplayer-3.2.12.min.js'
    _carregar 'js/libs/jquery.carouFredSel-6.2.1-packed.js'
    return

  flowPlayer: ->
    containerPlayer = 'flv-player'

    if containerPlayer
      flashPlayer = 'flv-player/flowplayer-3.2.16.swf'
      a = document.querySelectorAll '.clips ul li a'
      nomeAnuncte = document.querySelector '.informacoes-anunciante .nome-anunciante'
      catAnuncte = document.querySelector '.informacoes-anunciante .categoria'
      clips = []
      nomes = []
      cats = []
      carousel = jQuery '.clips ul'
      Apps = TVMaua.apps

      _playerDefault = ->
        $f containerPlayer, {
          src: flashPlayer,
          wmode: 'transparent'
        }, {
          playlist: clips

          onStart: (clip) ->
            _exibirDadosAnuncte 'nome', nomes[clip.index], nomeAnuncte
            _exibirDadosAnuncte 'categoria', cats[clip.index], catAnuncte
            Apps.controlarTamanhoString '.nome-anunciante h1', 20
            Apps.controlarTamanhoString '.categoria p', 30
            carousel.trigger 'slideTo', clip.index
            return

          onFinish: ->
            if @.getClip().index + 1 is @.getPlaylist().length
              $f().play 0
            return
        }

      _exibirDadosAnuncte = (tipo, nome, container) ->
        if tipo is 'nome'
          tag = 'h1'
        else if tipo is 'categoria'
          tag = 'p'
        container.innerHTML = '<' + tag + '>' + nome + '</' + tag + '>'
        return

      _mudarVideo = (evt) ->
        len = clips.length
        index = clips.indexOf(@.getAttribute 'href') + 1

        # Player utilizado após clique
        $f(containerPlayer, flashPlayer, {
          onStart: ->
            _exibirDadosAnuncte 'nome', nomes[index - 1], nomeAnuncte
            _exibirDadosAnuncte 'categoria', cats[index - 1], catAnuncte
            Apps.controlarTamanhoString '.nome-anunciante h1', 20
            Apps.controlarTamanhoString '.categoria p', 30
            carousel.trigger 'slideTo', index - 1
            return

          onFinish: ->
            if index isnt len then posicao = index else posicao = 0
            _playerDefault().play posicao
            return
        }).play @.getAttribute 'href'
        evt.preventDefault()
        return

      for item, i in a by 1
        item.addEventListener 'click', _mudarVideo
        clips[i] = item.getAttribute 'href'
        nomes[i] = item.getAttribute 'title'
        cats[i] = item.getAttribute 'data-categoria'

      # Player inicial
      do ->
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
    carousel = jQuery '.clips ul'

    if carousel
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
      _animar = ->
        if @.pageYOffset > 100
          cabecalho.style.opacity = 0.9
        else if @.pageYOffset <= 100
          cabecalho.style.opacity = 1
        return
      window.addEventListener 'scroll', _animar
    return

Apps = TVMaua.apps
do ->
  Apps.carregarScripts()
  return

window.onload = ->
  Apps.flowPlayer()
  Apps.menuCategorias()
  Apps.animacaoCabecalho()
  Apps.carousel()
  Apps.controlarTamanhoString '.clips ul li a p', 16
  return