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
            
            if (($event['type'] == 'message') && ($event['message']['type'] == 'text')){
                // Get text sent
                $text = $event['message']['text'];
    
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hi2');
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                
            } else if (($event['type'] == 'message') && ($event['message']['type'] == 'sticker')) {
//                $columns = array();
//                $img_url = 'http://www.bktube.net/wp-content/uploads/2017/01/XXX003.jpg';
//                for($i=0;$i<5;$i++)
//                {
//                    $actions = array(
//                                     //                                         action
//                        new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('ปุ่ม1','a'),
//                        new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder('ปุ่ม2','http://www.google.com')
//                                     );
//                    $column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder('คอลั่ม1', 'คอลั่ม2', $img_url , $actions);
//                    $columns[] = $column;
//                }
//                $carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
//                $msg = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('ก็มิรู้สินะ', $carousel);
//                $response = $bot->replyMessage($replyToken,$msg);
                $actions = array(
                                 new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('aa','ss1'),
                                 new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder('Google','http://www.google.com')
//                                 ,
//                                 new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder('sssdd', 'page=3'),
//                                 new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder('sad', 'page=1')
                                 );
                
                $img_url = 'http://www.bktube.net/wp-content/uploads/2017/01/XXX003.jpg,http://www.bktube.net/wp-content/uploads/2017/01/XXX003.jpg';
                $button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder('ee','rr', $img_url, $actions);
                $msg = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('uiuiui', $button);
                $response = $bot->replyMessage($replyToken,$msg);
            } else {
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event['message']['type']);
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
            }
            echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
        }
    }
    echo "OK";
