<?php
class Twitter{

  function getTweets($user){
    //This is all you need to configure.
    $app_key = 'dEar1nKJWGcxR2mH7VesbfuZ7';
    $app_token = 'lU6r9uXAt1ZyDLRFoC8lpKteAfVPG5H3FALtyv3ACjxTHluNhU';
    //These are our constants.
    $api_base = 'https://api.twitter.com/';
    $bearer_token_creds = base64_encode($app_key.':'.$app_token);
    //Get a bearer token.
    $opts = array(
      'http'=>array(
        'method' => 'POST',
        'header' => 'Authorization: Basic '.'ZEVhcjFuS0pXR2N4UjJtSDdWZXNiZnVaNzpsVTZyOXVYQXQxWnlETFJGb0M4bHBLdGVBZlZQRzVIM0ZBTHR5djNBQ2p4VEhsdU5oVQ=='."\r\n".
                   'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
        'content' => 'grant_type=client_credentials'
      )
    );
    $context = stream_context_create($opts);
    $json = file_get_contents($api_base.'oauth2/token',false,$context);
    $result = json_decode($json,true);
    if (!is_array($result) || !isset($result['token_type']) || !isset($result['access_token'])) {
      die("Something went wrong. This isn't a valid array: ".$json);
    }
    if ($result['token_type'] !== "bearer") {
      die("Invalid token type. Twitter says we need to make sure this is a bearer.");
    }
    //Set our bearer token. Now issued, this won't ever* change unless it's invalidated by a call to /oauth2/invalidate_token.
    //*probably - it's not documentated that it'll ever change.
    $bearer_token = $result['access_token'];
    //Try a twitter API request now.
    $opts = array(
      'http'=>array(
        'method' => 'GET',
        'header' => 'Authorization: Bearer '.$bearer_token
      )
    );
    $context = stream_context_create($opts);
    $json = file_get_contents($api_base.'1.1/statuses/user_timeline.json?count=5&screen_name='.$user,false,$context);
    
    return $json;

  }

  function getArrayTweets($jsonraw){
    $rawdata = "";
    $json = json_decode($jsonraw,true);
    
    $num_items = count($json);
    for($i=0; $i<$num_items; $i++){

      $url_image = $json[$i]["user"]["profile_image_url"];
      $name = $json[$i]["user"]["name"];
      $screen_name = $json[$i]["user"]["screen_name"];
      $fecha = $json[$i]["created_at"];
      $tweet = $json[$i]["text"];


      $imagen = "<a href='https://twitter.com/".$screen_name."' target=_blank><img src=".$url_image ."></img></a>";
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
