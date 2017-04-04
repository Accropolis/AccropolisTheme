function isStreamLive(stream_data) {
  return !!stream_data.stream;
}

function makeElementDisapear(dom_element) {
  dom_element.style.display = 'none';
}

function createStreamIframe() {
  var iframe = document.createElement('iframe');
  iframe.id = 'home--iframe-twitch';
  iframe.className = 'column small-12 large-8 twitch-integration';
  iframe.frameBorder = '0';
  iframe.allowFullscreen = 'true';
  iframe.scrolling = 'no';
  iframe.src = 'https://player.twitch.tv/?channel=accropolis';
  return iframe;
}

function createChatIframeMedium() {
  var iframe = document.createElement('iframe');
  iframe.id = 'chat_embed';
  iframe.className = 'column show-for-medium-only medium-4 twitch-integration-medium';
  iframe.frameBorder = '0';
  iframe.scrolling = 'no';
  iframe.src = 'https://www.twitch.tv/accropolis/chat';
  return iframe;
}

function createChatIframeLarge() {
  var iframe = document.createElement('iframe');
  iframe.id = 'chat_embed';
  iframe.className = 'column show-for-large large-4 twitch-integration-large';
  iframe.frameBorder = '0';
  iframe.scrolling = 'no';
  iframe.src = 'https://www.twitch.tv/accropolis/chat';
  return iframe;
}

function appendTwitchElement(dom_element) {
  dom_element.append(createStreamIframe());
  dom_element.append(createChatIframeMedium());
  dom_element.append(createChatIframeLarge());
}

function joinLiveAction() {
  var planningContainer = document.getElementById('home--programmation-planning');
  makeElementDisapear(planningContainer);
  var liveContainer = document.getElementById('home--live');
  appendTwitchElement(liveContainer);
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
  button.onclick = joinLiveAction;
  return button;
}

fetch(templateUrl+'/wp-json/getTwitchStream/v1/getTwitchStream')
  .then(function(data) { return data.json(); })
  .then(function(data) {
    if (isStreamLive(data)) {
      var planningContainer = document.getElementById('home--programmation-planning');
      planningContainer.prepend(createLiveTwitchButton());
    }
  })
  .catch(function(err) { console.error('ERROR:', err); });
