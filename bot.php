<?php
    
    require_once __DIR__ . "/vender/autoload.php";
//    $access_token = "http://kisssikisssika.herokuapp.com/config.php";
    $access_token = 'NtUwOPOhEsXR2X/96S2sY25kI1ZB9Kf57jSWfEdApNs6nIzaNr1+Tb+O4tIfKxF28e0GolRIKIXWkLcL3FovLPSjheL6H6Ez+u0U9YLckFV+OX7T27DHqX5oJlilaK5/ou6fSviCF4GCj4wL9U5aCwdB04t89/1O/w1cDnyilFU=';
    $channelSecret = '6ff3fa91e07dac67e9088b03b2486981'
    
    
    $content = file_get_contents('php://input');
    // Parse JSON
    $events = json_decode($content, true);
    $replyToken = $event['replyToken'];
    
    
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
    
    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
    $response = $bot->pushMessage($replyToken, $textMessageBuilder);
    
    echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
