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
  $data = file_get_contents($url, false);
  $clean_data = substr($data, 0, strrpos($data, "\n"));
  return json_decode($clean_data);
}
