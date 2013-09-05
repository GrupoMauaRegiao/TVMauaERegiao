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
    return

  flowPlayer: ->
    containerPlayer = 'flv-player'
    flashPlayer = 'http://localhost/TVMauaERegiao/static/flv-player/flowplayer-3.2.16.swf'
    a = document.querySelectorAll '.clips a'
    nomeAnuncte = document.querySelector '.nome-anunciante'
    descrAnuncte = document.querySelector '.informacoes-anunciante'
    clips = []
    titulos = []
    descr = []

    _playerDefault = ->
      $f containerPlayer, flashPlayer, {
        playlist: clips

        onStart: (clip) ->
          _exibirDadosAnuncte 'titulo', titulos[clip.index], nomeAnuncte
          _exibirDadosAnuncte 'descricao', descr[clip.index], descrAnuncte
          return

        onFinish: ->
          if @.getClip().index + 1 is @.getPlaylist().length
            $f().play 0
          return
      }

    _exibirDadosAnuncte = (tipo, texto, container) ->
      if tipo is 'titulo'
        tag = 'h1'
      else if tipo is 'descricao'
        tag = 'p'
      container.innerHTML = '<' + tag + '>' + texto + '</' + tag + '>'
      return

    _mudarVideo = (evt) ->
      len = clips.length
      index = clips.indexOf(@.getAttribute 'href') + 1

      # Player utilizado após clique
      $f(containerPlayer, flashPlayer, {
        onStart: ->
          _exibirDadosAnuncte 'titulo', titulos[index - 1], nomeAnuncte
          _exibirDadosAnuncte 'descricao', descr[index - 1], descrAnuncte
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
      titulos[i] = item.getAttribute 'title'
      descr[i] = item.getAttribute 'data-descricao'

    # Player inicial
    do ->
      _playerDefault()

Apps = TVMaua.apps
do ->
  Apps.carregarScripts()
  return

window.onload = ->
  Apps.flowPlayer()
  return