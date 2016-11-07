<?php
class Twitter{

  function getTweets($user){
    ini_set('display_errors', 1);
    require_once('TwitterAPIExchange.php');

    $settings = array(
        'oauth_access_token' => "90791365-3fruHkZqRdxF83Xy7NGoHzO3jbM6Sd07TcnAomqO8",
        'oauth_access_token_secret' => "EYLspCOJGmBFndxWtbWl0oDGjU8WLnfyZDufHeXN5sWyw",
        'consumer_key' => "dEar1nKJWGcxR2mH7VesbfuZ7",
        'consumer_secret' => "lU6r9uXAt1ZyDLRFoC8lpKteAfVPG5H3FALtyv3ACjxTHluNhU"
    );

    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name='.$user.'&count=5';        
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $json =  $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest();
    return $json;

  }

  function getArrayTweets($jsonraw){
    $rawdata = "";
    $json = json_decode($jsonraw);
    $num_items = count($json);
    for($i=0; $i<$num_items; $i++){

      $user = $json[$i];

      $url_imagen = $user->user->profile_image_url;
      $name = $user->user->name;
      $screen_name = $user->user->screen_name;
      $fecha = $user->created_at;
      $tweet = $user->text;

      $imagen = "<a href='https://twitter.com/".$screen_name."' target=_blank><img src=".$url_imagen."></img></a>";
      $name = "<a href='https://twitter.com/".$screen_name."' target=_blank>".$name."</a>";

      $rawdata[$i]["imagen"]=$imagen;
      $rawdata[$i]["fecha"]=substr($fecha,4,6).', '.substr($fecha,-4,4).' / '.substr($fecha,11,5);
      $rawdata[$i]["name"]=$name;
      $rawdata[$i]["screen_name"]=$screen_name;
      $rawdata[$i]["tweet"]=$tweet;
      
    }
    return $rawdata;
  }

  function displayTable($rawdata){

    for($i=0;$i<count($rawdata);$i++){
    ?>
    <li class="collection-item twit" style="padding: 0px;">
      <div class="row twit-header blue lighten-4">
        <div class="col l4 s3" style="padding:0px;">
          <div class="row twit-image valign-wrapper">
        <?php
          echo $rawdata[$i]["imagen"];
        ?>
          </div>
        </div>
        <div class="col l8 s9" style="padding:0px;">
          <div class="row twit-name">
        <?php
          echo '<b>'.$rawdata[$i]["name"].'</b>';
        ?>
          </div>
          <div class="row twit-username">
        <?php
          echo '@'.$rawdata[$i]["screen_name"];
        ?>
          </div>
          <div class="row twit-date">
        <?php
          echo $rawdata[$i]["fecha"];
        ?>
          </div>
        </div>
      </div>
      <div class="row twit-body">
        <?php
          echo $rawdata[$i]["tweet"];
        ?>
      </div>
    </li>
    <?php
    }
  }
}

$twitterObject = new Twitter();
$jsonraw =  $twitterObject->getTweets("La_Banca_");
$rawdata =  $twitterObject->getArrayTweets($jsonraw);
$twitterObject->displayTable($rawdata);

?>
