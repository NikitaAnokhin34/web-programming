<?php
if(isset($_POST['submit'])){
    $the_name = $_POST['the_name'];
    $price = $_POST['price'];
    $descr = $_POST['descr'];

    // Подключение к базе данных
    $mysqli = new mysqli('localhost', 'root', '', 'online_store_db');

    if ($mysqli->connect_error) {
        die('Ошибка подключения: ' . $mysqli->connect_error);
    }

    // Подготовка SQL-запроса
    $query = "INSERT INTO products (name, price, description) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    // Привязка параметров и выполнение запроса
    $stmt->bind_param('sds', $the_name, $price, $descr);
    $stmt->execute();

    // Закрытие соединения
    $stmt->close();
    $mysqli->close();

    // Перенаправление после успешного добавления
    header('location: index.php?page_layout=list');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Online Store</title>
</head>
<body>
<div class="prod-content">
    <div class="content-name">
        <h1>Добавить товар</h1>
    </div>
    <div class="prod-list">
        <form method="POST" enctype="multipart/form-data">
            <div class="items">
                <label for="cr">Название</label>
                <textarea id="cr" rows="1" name="the_name" class="form-control" required></textarea>
            </div>
            <div class="items">
                <label for="cr">Цена</label>
                <input id="cr" type="number" name="price" class="form-control" required>
            </div>
            <div class="items">
                <label for="cr">Описание</label>
                <textarea id="cr" rows="3" name="descr" class="form-control" required></textarea>
            </div>
            <button name="submit" type="submit">Сохранить</button>
        </form>
    </div>
</div>
</body>
</html>
