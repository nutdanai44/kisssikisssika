<?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    
    
    use LINE\LINEBot;
    
    
//    require_once __DIR__ . "/vender/autoload.php";
//    $access_token = "http://kisssikisssika.herokuapp.com/config.php";
    $access_token = 'NtUwOPOhEsXR2X/96S2sY25kI1ZB9Kf57jSWfEdApNs6nIzaNr1+Tb+O4tIfKxF28e0GolRIKIXWkLcL3FovLPSjheL6H6Ez+u0U9YLckFV+OX7T27DHqX5oJlilaK5/ou6fSviCF4GCj4wL9U5aCwdB04t89/1O/w1cDnyilFU=';
    $channelSecret = '6ff3fa91e07dac67e9088b03b2486981';
    
    // Get POST body content
    $content = file_get_contents('php://input');
    // Parse JSON
    $events = json_decode($content, true);
    // Validate parsed JSON data
    if (!is_null($events['events'])) {
        
        echo "has data";
        foreach ($events['events'] as $event) {
            
            // Get replyToken
            $replyToken = $event['replyToken'];
            
            // Reply only when message sent is in 'text' format
            
            $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
            $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
            
            if ($event['type'] == 'message') {
                if ($event['message']['type'] == 'text') {

                // Get text sent
                $text = $event['message']['text'];
    
    
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hi_');
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                
                echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
                } else {
                    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder('sticker??');
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                    
                    echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
                }
            } else {
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event['type']);
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                
                echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
            }
        }
//    } else {
//        echo "5555eiei";
    }
    echo "OK";
