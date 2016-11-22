<?php
require 'vendor/autoload.php';

if(isset($_POST["SubmitBtn"])){

	$fileName=$_FILES["resume"]["name"];
	$fileSize=$_FILES["resume"]["size"]/1024;
	$fileType=$_FILES["resume"]["type"];
	$fileTmpName=$_FILES["resume"]["tmp_name"];

	$b64Doc = base64_encode(file_get_contents($fileTmpName));

	if($fileType=="application/pdf"){
		if($fileSize<=2000){
			$random=rand(1111,9999);
			$newFileName=$random.$fileName;
			$uploadPath="testUpload/".$newFileName;
			if(move_uploaded_file($fileTmpName,$uploadPath)){
				$client = Elasticsearch\ClientBuilder::create()->build();
				$response = $client->index([
					'index' => 'documents',
					'type' => 'pdf',
					'id' => 20,
					'my_attachment' => [
						'_content_type' => 'application/pdf',
						'_name' => $uploadPath,
						'_content' => $b64Doc
					]
				]);
				print_r($response);
			}
		} else{
		  echo "Maximum upload file size limit is 2000 kb";
		}
	} else{
	  echo "You can only upload a  pdf file.";
	}  
}
?> 
<html>
	<head>
		<meta charset="utf-8">
		<title>Add an attachment </title>
	</head>
	<body>
		<form action="" method="post" enctype="multipart/form-data" name="form1">
		<input type="file" name="resume" id="resume">
		<input type="submit" name="SubmitBtn" id="SubmitBtn" value="Upload Resume">
		</form>
	</body>
</html>