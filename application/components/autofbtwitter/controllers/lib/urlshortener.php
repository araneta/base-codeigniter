<?php
    /*
      * To use Bit.ly service you need to enter your Username and API Key below
      * To use Adf.ly service you need to enter your User ID and API Key below
      */
     
    // Get the args
    $text = $_POST['text'];
    $shortener = $_GET['shortener'];
     
    // Explode the submited text
    $pieces = explode(" ", $text);
     
    // For each element in array check if it is a link, shorten and replace it in passed text
    foreach ($pieces as $piece) {
    if (preg_match("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", $piece)) {
    $newsmallurl = call_shortener($shortener, $piece);
    $text = str_replace($piece, $newsmallurl, $text);
    }
    }
     
    // Print final text (with shortened URLs) and send it to Twitter as a status
    echo $text . "<br /><br />";
    $textenc = urlencode($text);
    echo "<a href='http://twitter.com/home?status=$textenc'>Tweet this!</a>";
     
    // Choose the correct function based on the passed argument
    function call_shortener($shortener, $passedurl) {
    // Determine which function to call
    if ($shortener == 'tinyurl') {
    $shorturl = shortTinyURL($passedurl);
    } elseif ($shortener == 'bitly') {
    $shorturl = shortBitly($passedurl);
    } elseif ($shortener == 'supr') {
    $shorturl = shortSupr($passedurl);
    } elseif ($shortener == 'isgd') {
    $shorturl = shortIsgd($passedurl);
    } elseif ($shortener == 'l4uin') {
    $shorturl = shortL4uin($passedurl);
    } elseif ($shortener == 'toly') {
    $shorturl = shortToly($passedurl);
    } elseif ($shortener == 'adfly') {
    $shorturl = shortAdfly($passedurl);
    } elseif ($shortener == 'kwnme') {
    $shorturl = shortKwnme($passedurl);
    }
     
    // Return the shortened URL
    return $shorturl;
    }
     
    // TinyURL shortener
    function shortTinyURL($ToConvert) {
    $short_url = file_get_contents('http://tinyurl.com/api-create.php?url=' . $ToConvert);
    return $short_url;
    }
     
    // Bit.ly shortener
    function shortBitly($ToConvert) {
    $bitlylogin = 'YOUR_USERNAME';
    $bitlyapikey = 'YOUR_API_KEY';
    $bitlyurl = file_get_contents('http://api.bit.ly/shorten?version=2.0.1&longUrl=' . $ToConvert . '&login=' . $bitlylogin . '&apiKey=' . $bitlyapikey);
    $bitlycontent = json_decode($bitlyurl,true);
    $bitlyerror = $bitlycontent['errorCode'];
    $short_url = $bitlycontent['results'][$ToConvert]['shortUrl'];
    return $short_url;
    }
     
    // Su.pr shortener
    function shortSupr($ToConvert) {
    $short_url = file_get_contents('http://su.pr/api?url=' . $ToConvert);
    return $short_url;
    }
     
    // Is.gd shortener
    function shortIsgd($ToConvert) {
    $short_url = file_get_contents('http://www.is.gd/api.php?longurl=' . $ToConvert);
    return $short_url;
    }
     
    // L4u.in shortener
    function shortL4uin($ToConvert) {
    $short_url = file_get_contents('http://www.l4u.in/?module=ShortURL&file=Add&mode=API&url=' . $ToConvert);
    return $short_url;
    }
     
    // To.ly shortener
    function shortToly($ToConvert) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://to.ly/api.php?longurl=".urlencode($ToConvert));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $shorturl = curl_exec ($ch);
    curl_close ($ch);
    return $short_url;
    }
     
    // Adf.ly shortener
    function shortAdfly($ToConvert) {
    $APIKey = 'YOUR_API_KEY';
    $UserID = 'YOUR_USER_ID';
    $ShortType = 'int'; // or 'banner'
    $short_url = file_get_contents('http://adf.ly/api.php?key=' . $APIKey . '&uid=' . $UserID . '&advert_type=' . $ShortType . '&url=' . $ToConvert);
    return $short_url;
    }
     
    // Kwn.me shortener
    function shortKwnme($ToConvert) {
    $short_url = file_get_contents('http://kwn.me/t.php?process=1&url=' . $ToConvert);
    return $short_url;
    }
?>
