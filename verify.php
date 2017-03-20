<?php
$access_token = '4P4q+KGQSNnOQiZrjWlvHi5EOx/a8rn7BqGtZVUW/sV9uVxnkqiW+Z+cL06jDDNQ7SW6SJsssCCdZrMZfqxGYxxfU9t8X18TyGHc0vMyAyk2oi0pl9k6YufZqe3bKahpXfhNjJ4EJFtZ+SofYT9jKgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>