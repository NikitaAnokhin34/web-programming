<?php
$mysqli = new mysqli('localhost', 'root', '', 'online_store_db');

if ($mysqli->connect_error) {
    die('Ошибка подключения: ' . $mysqli->connect_error);
}

$query = "SELECT * FROM products";
$result = $mysqli->query($query);

$mysqli->close();
?>

<div class="prod-content">
    <div class="content-name">
        <h1>Товары</h1>
    </div>
    <div class="prod-list" style="align-items: center">
        <table class="table">
            <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Описание</th>
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $cnt = 0;
            while ($row = $result->fetch_assoc()) {
                $cnt++;
                ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><a href="index.php?page_layout=update&id=<?php echo $row['id']; ?>">Редактировать</a></td>
                    <td><a onclick="return confirmation('<?php echo $row['name']; ?>')"
                           href="index.php?page_layout=delete&id=<?php echo $row['id']; ?>">Удалить</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="index.php?page_layout=create"
           style="width:30%;font-size: 24px; border-radius: 10px; background: whitesmoke; margin-left: 50%; margin-right: 50%; text-align: center;">
            Добавить
        </a>
    </div>
</div>

<script>
    function confirmation(name) {
        return confirm("Вы действительно хотите удалить товар '" + name + "'?");
    }
</script>
