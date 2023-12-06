<?php
$id = $_GET['id'];
$mysqli = new mysqli('localhost', 'root', '', 'online_store_db');

if ($mysqli->connect_error) {
    die('Ошибка подключения: ' . $mysqli->connect_error);
}

$query = "SELECT * FROM products WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

$oldname = $product['name'];
$oldprice = $product['price'];
$olddescr = $product['description'];

if (isset($_POST['submit'])) {
    $the_name = $_POST['the_name'];
    $price = $_POST['price'];
    $descr = $_POST['descr'];

    $query = "UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sdsi", $the_name, $price, $descr, $id);
    $stmt->execute();
    $stmt->close();

    header('location: index.php?page_layout=list');
}

$mysqli->close();
?>

<div class="prod-content">
    <div class="content-name">
        <h1>Редактировать данные</h1>
    </div>
    <div class="prod-list">
        <p>Заполните поля</p>
        <form method="POST" enctype="multipart/form-data">
            <div class="items">
                <label for="upd">Название</label>
                <input type="text" id="upd" name="the_name" class="form-control" value="<?php echo $oldname; ?>"
                       required>
            </div>
            <div class="items">
                <label for="upd">Цена</label>
                <input type="number" id="upd" name="price" class="form-control" value="<?php echo $oldprice; ?>"
                       required>
            </div>
            <div class="items">
                <label for="upd">Описание</label>
                <textarea id="upd" rows="3" name="descr" class="form-control"
                          required><?php echo $olddescr; ?></textarea>
            </div>
            <button name="submit" type="submit">Сохранить</button>
        </form>
    </div>
</div>
