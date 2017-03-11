<?php

$api_key = "AIzaSyAl5oFXk9k__21zVBynetHIaf_LD0utaf0";
    
//$api_key = "";
$cvurl = "https://vision.googleapis.com/v1/images:annotate?key=" . $api_key;
$type = "TEXT_DETECTION";

if ($_FILES['photo']['name']) {  
    if(!$_FILES['photo']['error']) {
        $valid_file = true;
        if($_FILES['photo']['size'] > (4024000)) {
            $valid_file = false;
            die('Your file\'s size is too large.');
        }

        if($valid_file) {
            //convert it to base64
            $fname = $_FILES['photo']['tmp_name'];
            $data = file_get_contents($fname);
            $base64 = base64_encode($data);

            $r_json ='{
                "requests": [
                    {
                      "image": {
                        "content":"' . $base64. '"
                      },
                      "features": [
                          {
                            "type": "' .$type. '",
                            "maxResults": 200
                          }
                        ],
                        "imageContext" : [
                        "languageHints" : ["en","th"]
                        ]
                    }
                ]
            }';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $cvurl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $r_json);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ( $status != 200 ) {
                die("Error: $cvurl failed status $status" );
            }

            echo $json_response;
        }
    }
    else {
        echo "Error";
        die('Drror:  '.$_FILES['photo']['error']);
    }
}
?>
