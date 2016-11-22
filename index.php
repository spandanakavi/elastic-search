<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

if(!empty($_GET['q'])) {
	$search = $_GET['q'];

	$params['body']['query']['match']['title'] = $search;

	$searchQuery = $client->search($params);

	$results = $searchQuery['hits']['hits'];
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Search </title>
	</head>
	<body>
		<form method="get" action="index.php">
			<label>
				Search Key :
			</label>
			<input type="text" name="q">
			<input type="submit" name="submit" value ="search">
		</form>
		<?php
			foreach ($results as $result) { ?>
				<div class="results">
					<h3><a href='<?php echo $result['_id'] ?>'><?php echo $result['_source']['title']?></a></h3><br>
					<div>
						<p>
							<?php echo $result['_source']['body'] ?>
						</p>
					</div><br>
				</div>
				<?php }

		?>
		</div>
	</body>
</html>
