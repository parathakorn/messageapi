<?php
# URL API LINE
$API_URL = 'https://api.line.me/v2/bot/message';

# Channel access token (long-lived)
$ACCESS_TOKEN = '8IFoohQjh502i+Ch+2+C8+73GuKwMneh/H+CYe+iENi2qdLnv3/wn4c8H3o7irFc0bFhaNuK7JQCC1Zq6vczjMqfR2nddoIVTVi9unF5j6a2pZFwv3bzwxeGAxRctptuANsiZJ1Dgd+ia5oWarsJugdB04t89/1O/w1cDnyilFU=';

# Channel Secret
$channelSecret='11244a6442f44298bc083b311d05e82f';

# Set HEADER
$POST_HEADER = array('Content-Type: application/json','Authorization: Bearer '.$ACCESS_TOKEN);

# Get request content
$request = file_get_contents('php://input');

# Decode JSON to Array
$request_array = json_decode($request,true);

if (sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            // 'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  Debug Detail message
            'messages' => [['type' => 'text', 'text' => $text ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
    }
}

echo "OK";



function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>