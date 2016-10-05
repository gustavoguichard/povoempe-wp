<?php
/**
 * @package WordPress
 * @subpackage Zen

 Template Name: Facebook Login

*/
get_header(); ?>
<?php
global $fb;

function write_data_to_file( $data, $filename ) {
  $fileUrl = get_template_directory().'/data/'.$filename.'.json';
  $myFile = fopen($fileUrl, 'w') or die('Unable to open file: '.$fileUrl);
  fwrite($myFile, $data) or die('Unable to write file: '.$fileUrl);
  fclose($myFile) or die('Unable to close file: '.$fileUrl);
}


if(isset($fb) && current_user_can( 'publish_posts' ) && isset($_REQUEST['code'])) {
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
    $pageUrl = 'povoempepoa';
    $eventsResponse = $fb->get($pageUrl.'?fields=events{start_time,end_time,name,id,cover{id,source,offset_y},description}', $token);
    write_data_to_file($eventsResponse->getGraphNode(), 'events');

    $albumsResponse = $fb->get($pageUrl.'?fields=albums{photos{name,images},name,location,cover_photo}', $token);
    write_data_to_file($albumsResponse->getGraphNode(), 'albums');
    echo '<meta http-equiv="refresh" content="0;url='.get_option("siteurl").'?facebook_data=updated">';
  }
}

/*

  location == "Espaço Povo Em Pé - Belem Novo"
  name = Nome do album
  photos->data = [{name, images = [{height, source, width}], id}]
  source /p320x320/ para média
  source /p480x480/ (ou 600 ou 720) para Aberta
  source /p130x130/ para thumb
  cover_photo = {created_time,name,id} ID deve ser o mesmo do array
}
*/
?>