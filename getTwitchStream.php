<?php
add_action('rest_api_init', function() {
  register_rest_route('getTwitchStream/v1', '/getTwitchStream', array(
    'methods' => 'GET',
    'callback' => 'getTwitchStream',
  ));
});


function getTwitchStream($data) {
  $twitch_client_id = get_field('twitch-api-key', HOME_PAGE_ID);
  $curl = curl_init();
  if (DEBUG_CURL) {
    curl_setopt($curl, CURLOPT_VERBOSE, true);
    $verbose = fopen('php://temp', 'w+');
    curl_setopt($curl, CURLOPT_STDERR, $verbose);
  }
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_URL, 'https://api.twitch.tv/kraken/streams/accropolis');
  curl_setopt($curl, CURLOPT_HTTPHEADER, array("Client-ID: $twitch_client_id"));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER , TRUE);
  $res = curl_exec($curl);
  if (DEBUG_CURL) {
    if ($result === FALSE) {
        printf("cUrl error (#%d): %s<br>\n", curl_errno($curl),
              htmlspecialchars(curl_error($curl)));
    }
    rewind($verbose);
    $verboseLog = stream_get_contents($verbose);
    echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";
  }
  curl_close($curl);
  return json_decode($res);
}
