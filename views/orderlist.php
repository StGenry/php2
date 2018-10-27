<h1>ORDER LIST</h1>
<?php foreach ($orders as $order): ?>
    <div class="order">
        <strong><?=$order->userName?></strong>. телефон:<em><?=$order->tel?></em> адрес:<?=$order->address?> Сумма заказа: <?=$order->sum?> руб.
    </div>
<?php endforeach;?>