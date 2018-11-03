<?php /** @var \app\models\Product $model */?>

<form action="" method="post">
    <input type="login" name="login" placeholder="login"/>
    <input type="password" name="password" placeholder="password"/>
    <input type="password" name="passwordCopy" placeholder="re-enter password"/>
    <input type="text" name="name" placeholder="Name"/>
    <input type="submit" value="OK"/>
</form>
<div style='color: red'><?=$message?></div>
