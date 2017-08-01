<?php
add_action('rest_api_init', function() {
  register_rest_route('getlatestvids/v1', '/getlatestvids', array(
    'methods' => 'GET',
    'callback' => 'getlatestvids',
  ));
});

function getlatestvids() {
  $count = 4;
  $channelId = get_field('home-youtube-channel', HOME_PAGE_ID);
  $apiKey = get_field('home-youtube-api', HOME_PAGE_ID);
  $url = "https://www.googleapis.com/youtube/v3/search?key=$apiKey&channelId=$channelId&part=snippet,id&order=date&maxResults=$count";

  $curl = curl_init();
  if (DEBUG_CURL) {
    curl_setopt($curl, CURLOPT_VERBOSE, true);
    $verbose = fopen('php://temp', 'w+');
    curl_setopt($curl, CURLOPT_STDERR, $verbose);
  }
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_URL, $url);
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
