<?php
/**
 * @package WordPress
 * @subpackage Zen

 Template Name: Facebook Login

*/
get_header(); ?>
<?php
global $fb;
if(isset($fb) && current_user_can( 'manage_options' ) && isset($_REQUEST['code'])) {
  try {
    $token = $fb->getRedirectLoginHelper()->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (isset($token)) {
    $response = $fb->get('EspacoPovoEmPe?fields=events{start_time,end_time,name,id,cover{id,source,offset_y}}', $token);
    $graphNode = $response->getGraphNode();
    $fileUrl = get_template_directory().'/data/events.json';
    $myfile = fopen($fileUrl, 'w') or die("Unable to open file!");
    fwrite($myfile, $graphNode) or die("Unable to write file!");
    fclose($myfile) or die("Unable to close file!");
    echo '<meta http-equiv="refresh" content="0;url='.get_option("siteurl").'?agenda=updated">';
  }
}

?>