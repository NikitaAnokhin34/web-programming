<?php
$id = $_GET['id'];
$mysqli = new mysqli('localhost', 'root', '', 'online_store_db');

if ($mysqli->connect_error) {
    die('Ошибка подключения: ' . $mysqli->connect_error);
}

$query = "DELETE FROM products WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

$mysqli->close();
header('location: index.php?page_layout=list');
?>
