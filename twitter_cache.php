<?php
error_reporting( 0 ); // don't let any php errors ruin the feed
if (    !isset($_GET['username'])   )  header ('Location: gather.php');
$username = (isset($_GET['username'])) ? $_GET['username'] : $_GET['term'] ;

$number_tweets = 10;
if (isset($_GET['max_id']) & $_GET['max_id'] != 0) {
    $max_id = (int)($_GET['max_id']);
    $max_id = $max_id - 1;
    $feed = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name={$username}&count={$number_tweets}&include_rts=1&max_id=$max_id";

}
else {
    $feed = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name={$username}&count={$number_tweets}&include_rts=1";
}

$cache_file = dirname(__FILE__).'/cache/'.'twitter-cache';
$modified = filemtime( $cache_file );
$now = time();
$interval = 5; // ten minutes
// check the cache file
if ( !$modified || ( ( $now - $modified ) > $interval ) ) {
  $bearer = '#'; /*Your Bearer*/
  $context = stream_context_create(array(
    'http' => array(
      'method'=>'GET',
      'header'=>"Authorization: Bearer " . $bearer
      )
  ));

  $json = file_get_contents( $feed, false, $context );

  if ( $json ) {
    $cache_static = fopen( $cache_file, 'w' );
    fwrite( $cache_static, $json );
    fclose( $cache_static );
  }
}
header( 'Cache-Control: no-cache, must-revalidate' );
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Content-type: application/json' );
$json = file_get_contents( $cache_file );
echo ($json);
?>
