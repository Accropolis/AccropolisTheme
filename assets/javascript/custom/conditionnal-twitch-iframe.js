function isStreamLive(stream_data) {
  return !!stream_data.stream;
}

function makeElementDisapear(dom_element) {
  dom_element.style.display = 'none';
}

function makeElementAppear(dom_element) {
  dom_element.style.display = 'inline';
}

function makeTwitchAppear() {
  makeElementAppear(document.getElementById('home--iframe-twitch'));
  makeElementAppear(document.getElementById('chat_embed_medium'));
  makeElementAppear(document.getElementById('chat_embed'));
  makeElementDisapear(document.getElementById('home--programmation-planning'));
}

function createStreamIframe() {
  var iframe = document.createElement('iframe');
  iframe.id = 'home--iframe-twitch';
  iframe.className = 'column small-12 large-8 twitch-integration';
  iframe.frameBorder = '0';
  iframe.allowFullscreen = 'true';
  iframe.scrolling = 'no';
  iframe.src = 'https://player.twitch.tv/?channel=accropolis';
  iframe.muted = "true";
  iframe.style.display = 'none';
  return iframe;
}

function createChatIframeMedium() {
  var iframe = document.createElement('iframe');
  iframe.id = 'chat_embed_medium';
  iframe.className = 'column show-for-medium-only medium-4 twitch-integration-medium';
  iframe.frameBorder = '0';
  iframe.scrolling = 'no';
  iframe.src = 'https://www.twitch.tv/accropolis/chat';
  iframe.style.display = 'none';
  return iframe;
}

function createChatIframeLarge() {
  var iframe = document.createElement('iframe');
  iframe.id = 'chat_embed';
  iframe.className = 'column show-for-large large-4 twitch-integration-large';
  iframe.frameBorder = '0';
  iframe.scrolling = 'no';
  iframe.src = 'https://www.twitch.tv/accropolis/chat';
  iframe.style.display = 'none';
  return iframe;
}

function appendTwitchElement(dom_element) {
  dom_element.append(createStreamIframe());
  dom_element.append(createChatIframeMedium());
  dom_element.append(createChatIframeLarge());
}

function createLiveTwitchButton(dom_element) {
  var button = document.createElement('div');
  button.id = "home--button-twitch-desktop";
  button.className = "button home--button-twitch";
  button.style = "width: 100%; margin-top: 10px;";
  var i = document.createElement('i');
  i.className = "fa fa-twitch";
  var text = document.createTextNode(' Rejoindre le live');
  button.appendChild(i);
  button.appendChild(text);
  button.onclick = makeTwitchAppear;
  return button;
}

fetch(templateUrl+'/wp-json/getTwitchStream/v1/getTwitchStream')
  .then(function(data) { return data.json(); })
  .then(function(data) {
    if (isStreamLive(data) || true) {
      var planningContainer = document.getElementById('home--programmation-planning');
      var liveContainer = document.getElementById('home--live');
      planningContainer.prepend(createLiveTwitchButton());
      appendTwitchElement(liveContainer);
    }
  })
  .catch(function(err) { console.error('ERROR:', err); });
