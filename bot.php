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
    
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hi3');
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                
                echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
                } else {
                    
                }
            } else {
//                $columns = array();
//                $img_url = "http://www.bktube.net/wp-content/uploads/2017/01/XXX003.jpg";
//                for($i=0;$i<5;$i++)
//                {
//                    $actions = array(
//                                     //                                         action
//                                     new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("ปุ่ม1","ปุ่ม11"),
//                                     new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("ปุ่ม2","http://www.google.com")
//                                     );
//                    $column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder("คอลั่ม1".$i, "คอลั่ม2".$i, $img_url , $actions);
//                    $columns[] = $column;
//                }
//                $carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
//                $msg = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("ก็มิรู้สินะ", $carousel);
//                $response = $bot->replyMessage($replyToken,$msg);
//                
//                echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
                $actions = array(
                                 //一般訊息型 action
                                 new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("按鈕1","文字1"),
                                 //網址型 action
                                 new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("Google","http://www.google.com"),
                                 //下列兩筆均為互動型action
                                 new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("下一頁", "page=3"),
                                 new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("上一頁", "page=1")
                                 );
                
                $img_url = "圖片網址，必需為 https (圖片非必填欄位)";
                $button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder("按鈕文字","說明", $img_url, $actions);
                $msg = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("這訊息要用手機的賴才看的到哦", $button);
                $bot->replyMessage($replyToken,$msg);
            }
        }
//    } else {
//        echo "5555eiei";
    }
    echo "OK";
