<?php
	require 'vendor/autoload.php';

	$client = Elasticsearch\ClientBuilder::create()->build();	                

	if(!empty($_POST)) {
		
		if(isset($_POST['title'], $_POST['body'], $_POST['keywords'])) {

			$title = $_POST['title'];
			$body =  $_POST['body'];
			$keywords = explode(',', $_POST['keywords']);
			
			$response = $client->index([
				'index' => 'cluster1',
				'type' => 'master',
				'body' => [
					'title' => $title,
					'body' => $body,
					'keywords' => $keywords
				]
 			]);
		}
		if($response) {
			print_r($response);
		}
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Add an article </title>
	</head>
	<body>
		<form method="post" action="add.php">
			<label>
				Title :
			</label>
			<input type="text" name="title">
			<br>
			<label>
				Body :
			</label>
			<textarea name="body" rows=10></textarea>
			<br>
			<label>
				Keywords :
			</label>
			<input type="text" name="keywords">
			<br>
			<input type="submit" name="submit" value ="submit">
		</form>
	</body>
</html>