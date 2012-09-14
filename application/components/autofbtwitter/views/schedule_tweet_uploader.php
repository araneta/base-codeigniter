<?php
function image_upload(){    

    define( 'YOUR_CONSUMER_KEY' , 'your twitter app consumer key');
    define( 'YOUR_CONSUMER_SECRET' , 'your twitter app consumer key secret');

    require ('twitt/tmhOAuth.php');
    require ('twitt/tmhUtilities.php');

    $tmhOAuth = new tmhOAuth(array(
             'consumer_key'    => "YOUR_CONSUMER_KEY",
             'consumer_secret' => "YOUR_CONSUMER_SECRET",
             'user_token'      => "YOUR_OAUTH_TOKEN",
             'user_secret'     => "YOUR_OAUTH_TOKEN_SECRET",
    ));

    $image = 'image.jpg';

    $code = $tmhOAuth->request( 'POST','https://upload.twitter.com/1/statuses/update_with_media.json',
       array(
            'media[]'  => "@{$image};type=image/jpeg;filename={$image}",
            'status'   => 'message text written here',
       ),
        true, // use auth
        true  // multipart
    );

    if ($code == 200){
       tmhUtilities::pr(json_decode($tmhOAuth->response['response']));
    }else{
       tmhUtilities::pr($tmhOAuth->response['response']);
    }
    return tmhUtilities;
}
?>
