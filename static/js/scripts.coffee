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
    flashPlayer = 'flv-player/flowplayer-3.2.16.swf'
    a = document.querySelectorAll '.clips a'
    nomeAnuncte = document.querySelector '.informacoes-anunciante .nome-anunciante'
    catAnuncte = document.querySelector '.informacoes-anunciante .categoria'
    clips = []
    nomes = []
    cats = []

    _playerDefault = ->
      $f containerPlayer, flashPlayer, {
        playlist: clips

        onStart: (clip) ->
          _exibirDadosAnuncte 'nome', nomes[clip.index], nomeAnuncte
          _exibirDadosAnuncte 'categoria', cats[clip.index], catAnuncte
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

Apps = TVMaua.apps
do ->
  Apps.carregarScripts()
  return

window.onload = ->
  Apps.flowPlayer()
  return