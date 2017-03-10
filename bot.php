<?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    
    
    use LINE\LINEBot;
    
    
//    require_once __DIR__ . "/vender/autoload.php";
//    $access_token = "http://kisssikisssika.herokuapp.com/config.php";
    $access_token = 'NtUwOPOhEsXR2X/96S2sY25kI1ZB9Kf57jSWfEdApNs6nIzaNr1+Tb+O4tIfKxF28e0GolRIKIXWkLcL3FovLPSjheL6H6Ez+u0U9YLckFV+OX7T27DHqX5oJlilaK5/ou6fSviCF4GCj4wL9U5aCwdB04t89/1O/w1cDnyilFU=';
    $channelSecret = '6ff3fa91e07dac67e9088b03b2486981';
    
    $data = array(
            'events' => array(array(
                    'replyToken' => 'sss',
                    'type' => 'message',
                    'timestamp' => 'sssssss',
                    'source' => array(
                                'type' => 'user',
                                'userId' => 'sssssss'
                                ),
                    'message' => array('id' => '325708',
                                    'type' => 'text',
                                    'text' => 'eiei'
                                    )
    )));

    echo json_encode($data);
    
//    $content = {
//        "events": [
//        {
//            "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
//            "type": "message",
//            "timestamp": 1462629479859,
//            "source": {
//                "type": "user",
//                "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
//            },
//            "message": {
//                "id": "325708",
//                "type": "text",
//                "text": "Hello, world"
//            }
//        }
//        ]
//    }
    // Get POST body content
//    $content = file_get_contents('php://input');
    // Parse JSON
    $events = json_decode($data,true);
    
    // Validate parsed JSON data
    if (!is_null($events['events'])) {
        // Loop through each event
        foreach ($events['events'] as $event) {
            // Reply only when message sent is in 'text' format
            if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
                // Get text sent
                $text = $event['message']['text'];
                // Get replyToken
                $replyToken = $event['replyToken'];
    
                
                echo "ss";
                
                $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
                $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
                
//                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
                $response = $bot->replyMessage($replyToken, 'uu');
                
                echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
                
                // Build message to reply back
//                $messages = [
//                'type' => 'text',
//                'text' => $text
//                
//                // Make a POST Request to Messaging API to reply to sender
//                $url = 'https://api.line.me/v2/bot/message/reply';
//                $data = [
//                'replyToken' => $replyToken,
//                'messages' => [$messages],
//                ];
//                $post = json_encode($data);
//                $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
//                
//                $ch = curl_init($url);
//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//                $result = curl_exec($ch);
//                curl_close($ch);
//                
//                echo $result . "\r\n";
            }
        }
    } else {
        echo "5555eiei";
    }
    echo "OK";
