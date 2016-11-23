<?php
header('Content-Type: application/json');
$dbConnection = new PDO("mysql:host=localhost;dbname=elastic_search_test", 'root', 'aspire@123');
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = array();

switch ($_SERVER['REQUEST_METHOD'])
{
    case "GET":
        $result['articles'] = array();
        $query = "SELECT * FROM articles";
        foreach($dbConnection->query($query) as $id => $row)
        {
            $result['articles'][$id]['title'] = utf8_encode($row['title']);
            $result['articles'][$id]['content'] = utf8_encode($row['content']);
        }

        $query = "SELECT * FROM media";
        $result['media'] = array();
        foreach($dbConnection->query($query) as $id => $row)
        {
            $result['media'][$id]['title'] = utf8_encode($row['title']);
        }

        break;

    case "POST":
        $data = $_POST['search'];
        $query = "SELECT title FROM articles WHERE title LIKE '%".$data."%' Union All SELECT title FROM media WHERE title LIKE '%".$data."%'";
        $result['search'] = array();
        foreach($dbConnection->query($query) as $id => $row)
        {
            $result['search'][$id]['title'] = utf8_encode($row['title']);
        }

        break;
}

echo json_encode($result);
?>

