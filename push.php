<?php
// �óյ�ͧ��õ�Ǩ�ͺ����� error ����Դ 3 ��÷Ѵ��ҧ������ӧҹ �ó���� ��� comment �Դ�
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// ��õ������ǡѺ bot
require_once 'bot_settings.php';
 
$httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
$bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));
 
// userId 
$userId = 'U8be490498aacfb6eb8b16cbc2a6b8195';
// ���ͺ�� push ��ͤ������ҧ����
$textPushMessage = '���ʴդ�Ѻ';                
$messageData = new TextMessageBuilder($textPushMessage);        
             
$response = $bot->pushMessage($userId,$messageData);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}
 
// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>