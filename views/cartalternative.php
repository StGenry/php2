<h3>Товары в корзине:</h3>
<?php if(empty($basket)):?>
    <div>Корзина пуста!</div>
<?php else:?>
    <?php foreach ($basket as $item):?>
        <div><?=$item['product']->name?> :
            <?=$item['count']?>
            <a href="/basket/remove_from_basket?id=<?=$item['product']->id?>">Удалить</a>
        </div>
    <?php endforeach;?>
<?php endif;?>