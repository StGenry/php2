<?php /** @var \app\models\Product $products, $cart */?>

<form action="" method="post">
    <h2>Корзина</h2>
    <div id="basket">
        <?php foreach ($productList as $item): ?>
        <div>
            <img src="<?=PUBLIC_THUMB_DIR_URL . $item['image_path']?>" width="50" alt="<?=$item['name']?>">
            <?=$item['name'] ?>
            <?=$item['quantity']." * ".$item['price']." = ".$item['total'] ?> руб.
            <button class="buy-btn" name = "del" value = "<?=$item['id']?>">Удалить</button>
        </div>
        <?php endforeach;?>

        Итого: <span id="basket-price"><?=$cartTotal . ' руб.'?></span>
    </div>
</form>
