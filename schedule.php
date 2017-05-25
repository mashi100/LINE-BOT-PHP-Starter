<?php
 
$strAccessToken = '4P4q+KGQSNnOQiZrjWlvHi5EOx/a8rn7BqGtZVUW/sV9uVxnkqiW+Z+cL06jDDNQ7SW6SJsssCCdZrMZfqxGYxxfU9t8X18TyGHc0vMyAyk2oi0pl9k6YufZqe3bKahpXfhNjJ4EJFtZ+SofYT9jKgdB04t89/1O/w1cDnyilFU=';
 
$strUrl = "https://api.line.me/v2/bot/message/push";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";

// Find User and Time Attendance
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,"http://eservice.depa.or.th/service_api/schedule_service.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'parameter='.$param);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);

	//echo 'Result : [---'.$server_output.'---]';
	$p = json_decode($server_output, true);

	$cnt = count($p);
	for($i=0; $i<$cnt; $i++) {
		$line_user_id = $p[$i]['line_user_id'];
		$startTime = $p[$i]['startTime'];
		$endTime = $p[$i]['endTime'];
		$description = $p[$i]['description'];
		
		$arrPostData = array();
		$arrPostData['to'] = $line_user_id;
		$arrPostData['messages'][0]['type'] = "text";
		$arrPostData['messages'][0]['text'] = "วันนี้ท่านมีประชุมเวลา : ".$startTime."-".$endTime." : ".$description;
		 
		 
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
	}
 

echo $result;
 
?>