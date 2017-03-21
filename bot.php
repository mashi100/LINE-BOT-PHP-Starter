<?php
$access_token = '4P4q+KGQSNnOQiZrjWlvHi5EOx/a8rn7BqGtZVUW/sV9uVxnkqiW+Z+cL06jDDNQ7SW6SJsssCCdZrMZfqxGYxxfU9t8X18TyGHc0vMyAyk2oi0pl9k6YufZqe3bKahpXfhNjJ4EJFtZ+SofYT9jKgdB04t89/1O/w1cDnyilFU=';

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
			// Get User ID
			$u = $event['source']['userId'];

			// find time
			$param = array(
				'user_id' => $text,
			);
			$param = json_encode($param);
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL,"http://eservice.depa.or.th/service_api/time_service.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'parameter='.$param);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec ($ch);
			curl_close ($ch);
			$p = json_decode($server_output, true);
			$t1 =$p[0]['TimeIn'];
			// end find time
				
			// Build message to reply back
			$messages = [
				'type' => 'text',				
				'text' => $t1
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
echo "OK $u";
?>