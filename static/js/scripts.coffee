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

    # Lista de scripts
    _carregar 'js/libs/flowplayer-3.2.12.min.js'
    return

  flowPlayer: ->
    containerPlayer = 'flv-player'
    flashPlayer = 'http://localhost/TVMauaERegiao/static/flv-player/flowplayer-3.2.16.swf'
    a = document.querySelectorAll '.clips a'
    clips = []

    _mudarVideo = (evt) ->
      len = clips.length
      index = clips.indexOf(@.getAttribute 'href') + 1

      $f(containerPlayer, flashPlayer, {
        onFinish: ->
          if index isnt len then posicao = index else posicao = 0
          $f(containerPlayer, flashPlayer, {
            playlist: clips
          }).play posicao
          return
      }).play @.getAttribute 'href'

      evt.preventDefault()
      return

    for item, i in a
      item.addEventListener 'click', _mudarVideo
      clips[i] = item.getAttribute 'href'

    $f containerPlayer, flashPlayer, {
      playlist: clips

      onFinish: ->
        $().play 0
        return
    }
    return

Apps = TVMaua.apps
do ->
  Apps.carregarScripts()
  return

window.onload = ->
  Apps.flowPlayer()
  return