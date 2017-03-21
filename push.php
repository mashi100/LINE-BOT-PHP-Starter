<?php
 
$strAccessToken = '4P4q+KGQSNnOQiZrjWlvHi5EOx/a8rn7BqGtZVUW/sV9uVxnkqiW+Z+cL06jDDNQ7SW6SJsssCCdZrMZfqxGYxxfU9t8X18TyGHc0vMyAyk2oi0pl9k6YufZqe3bKahpXfhNjJ4EJFtZ+SofYT9jKgdB04t89/1O/w1cDnyilFU=';
 
$strUrl = "https://api.line.me/v2/bot/message/push";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
$arrPostData = array();
$arrPostData['to'] = "mashi.j7";
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "TEST Push Message";
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);

echo $result;
 
?>