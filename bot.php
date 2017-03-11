<?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    
    
    use LINE\LINEBot;
    
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
    
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hi6');
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                
            } else if (($event['type'] == 'message') && ($event['message']['type'] == 'sticker')) {
                $actions = array(
                                 //一般訊息型 action
                                 new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("按鈕1","文字1"),
                                 //網址型 action
                                 new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("Google","http://www.google.com"),
                                 //下列兩筆均為互動型action
                                 new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("下一頁", "page=3"),
                                 new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("上一頁", "page=1")
                                 );
                
                $img_url = "https://f.ptcdn.info/646/048/000/ojwkqtow6zfH0HGvS6q-o.jpg";
                $button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder("按鈕文字","說明", $img_url, $actions);
                $msg = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("這訊息要用手機的賴才看的到哦", $button);
                $bot->replyMessage($replyToken,$msg);
//                $response = $bot->replyMessage($replyToken,$msg);
//                $actions = array(
//                                 new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("ตกลง", "ans=Y"),
//                                 new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("ยกเลิก", "ans=N")
//                                 );
//                $button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("ตอบๆมาเหอะ", $actions);
//                $msg = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("ตามนั้น", $button);
//                $response = $bot->replyMessage($replyToken,$msg);
            } else {
                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event['message']['type']);
                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
            }
            echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
        }
    }
    echo "OK";
