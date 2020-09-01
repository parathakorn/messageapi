<?php
include_once('bot_settings.php');

$accessToken = LINE_MESSAGE_ACCESS_TOKEN;	//copy ��ͤ��� Channel access token �͹����駤��
$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);
$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$accessToken}";

   //�Ѻ��ͤ����ҡ�����
$message = $arrayJson['events'][0]['message']['text'];
   //�Ѻ id �ͧ�����
$id = $arrayJson['events'][0]['source']['userId'];
if($message == "�Ѻ 1-10"){
    for($i=1;$i<=10;$i++){
	$arrayPostData['to'] = $id;
	$arrayPostData['messages'][0]['type'] = "text";
	$arrayPostData['messages'][0]['text'] = $i;
	pushMsg($arrayHeader,$arrayPostData);
    }
}

function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
}
exit;
?>