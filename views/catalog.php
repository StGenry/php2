<?php /** @var \app\models\Product $products */?>
<h1>CATALOG</h1>
<?php foreach ($products as $product): ?>
    <div class="product">
        <strong><?=$product->name?></strong>. "<em><?=$product->description?>"</em> - <?=$product->price?> руб.
    </div>
<?php endforeach;?>