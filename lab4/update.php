<?php
$id = $_GET['id'];
$doc = new DOMDocument();
$doc->load('product.xml');
$products = $doc->getElementsByTagName('products')->item(0);
$product = $products->getElementsByTagName('product');
$product1 = $products->getElementsByTagName('product');
$oldname = $product1->item($id - 1)->getElementsByTagName('name')->item(0)->nodeValue;
$oldprice = $product1->item($id - 1)->getElementsByTagName('price')->item(0)->nodeValue;
$olddescr = $product1->item($id - 1)->getElementsByTagName('descr')->item(0)->nodeValue;

if (isset($_POST['submit'])) {
    $the_name = $_POST['the_name'];
    $price = $_POST['price'];
    $descr = $_POST['descr'];

    $newprod = $doc->createElement('product');

    $new_id = $doc->createElement('id', $id);
    $newprod->appendChild($new_id);

    if (!empty($the_name)) {
        $new_name = $doc->createElement('name', $the_name);
    } else {
        $new_name = $doc->createElement('name', $oldname);
    }
    $newprod->appendChild($new_name);

    if (!empty($price)) {
        $new_price = $doc->createElement('price', $price);
    } else {
        $new_price = $doc->createElement('price', $oldprice);
    }
    $newprod->appendChild($new_price);

    if (!empty($descr)) {
        $new_descr = $doc->createElement('descr', $descr);
    } else {
        $new_descr = $doc->createElement('descr', $olddescr);
    }
    $newprod->appendChild($new_descr);

    $cnt = 0;

    while (is_object($product->item($cnt++))) {
        $tmp = $product->item($cnt - 1)->getElementsByTagName('id')->item(0);
        $tmpid = $tmp->nodeValue;
        if ($tmpid == $id) {
            $products->replaceChild($newprod, $product->item($cnt - 1));
            break;
        }
    }
    $doc->formatOutput = true;
    $doc->save('product.xml') or die('Death');
    header('location: index.php?page_layout=list');
}
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
                <textarea id="upd" rows="1" name="the_name" class="form-control" required><?php echo $oldname ?></textarea>
            </div>
            <div class="items">
                <label for="upd">Цена</label>
                <textarea id="upd" rows="1" name="price" class="form-control" required><?php echo $oldprice ?></textarea>
            </div>
            <div class="items">
                <label for="upd">Описание</label>
                <textarea id="upd" rows="3" name="descr" class="form-control" required><?php echo $olddescr ?></textarea>
            </div>
            <button name="submit" type="submit">Сохранить</button>
        </form>
    </div>
</div>
