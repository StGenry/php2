<?php /** @var \app\models\Product $products */?>
<h1>CATALOG</h1>
<ul>
    <?php foreach ($products as $product): ?>
    <li> <a href="card?id=<?=$product->id?>">
        <strong>
            <?=$product->name?></strong>. "<em>
            <?=$product->description?>"</em> -
        <?=$product->price?> руб.
        </a>
    </li>
    <?php endforeach;?>
</ul>