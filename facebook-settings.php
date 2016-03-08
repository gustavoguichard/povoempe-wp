<?php
  if(!session_id()) {
    session_start();
  }
  if(!isset($fb) && current_user_can( 'manage_options' )) {
    require_once(get_template_directory().'/src/facebook-sdk-v5/autoload.php');
    global $fb, $facebook_id, $facebook_secret;
    $facebook_id = get_option('magethemes_zen_facebook_id');
    $facebook_secret = get_option('magethemes_zen_facebook_secret');

    $fb = new Facebook\Facebook([
      'app_id' => $facebook_id,
      'app_secret' => $facebook_secret,
      'default_graph_version' => 'v2.5',
    ]);
  }
?>