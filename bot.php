<?php
    
//    require_once "http://kisssikisssika.herokuapp.com/config.php";
//    $access_token = "http://kisssikisssika.herokuapp.com/config.php";
    $access_token = 'NtUwOPOhEsXR2X/96S2sY25kI1ZB9Kf57jSWfEdApNs6nIzaNr1+Tb+O4tIfKxF28e0GolRIKIXWkLcL3FovLPSjheL6H6Ez+u0U9YLckFV+OX7T27DHqX5oJlilaK5/ou6fSviCF4GCj4wL9U5aCwdB04t89/1O/w1cDnyilFU=';
    $channelSecret = '6ff3fa91e07dac67e9088b03b2486981'

    // Get POST body content
    $content = file_get_contents('php://input');
    // Parse JSON
    $events = json_decode($content, true);
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
                
                // Build message to reply back
                $messages = [
                'type' => 'text',
                'text' => $text
                ];
                
                // Make a POST Request to Messaging API to reply to sender
                $url = 'https://api.line.me/v2/bot/message/reply';
                $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
                ];
                $post = json_encode($data);
                $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
                
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $result = curl_exec($ch);
                curl_close($ch);
                
                echo $result . "\r\n";
            }
        }
    }
    echo "OK";
                
//                $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
//                $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
//                
//                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
//                $response = $bot->replyMessage($replyToken, $textMessageBuilder);
//                if ($response->isSucceeded()) {
//                    echo 'Succeeded!';
//                    return;
//                }
//                
//                // Failed
//                echo $response->getHTTPStatus . ' ' . $response->getRawBody();
            
    
