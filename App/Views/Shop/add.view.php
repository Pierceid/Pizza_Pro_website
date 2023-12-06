<?php
$layout = 'eshop';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>
<link rel="stylesheet" href="/public/css/styl_addOrRemove.css">

<form class="form form-add" method="post" action="<?= $link->url("shop.add") ?>">
    <h1 class="title">Add pizza</h1>

    <label><input id="name" type="text" placeholder="Name"></label>

    <label><input id="description" type="text" placeholder="Description"></label>

    <label><input id="cost" type="text" placeholder="Cost"></label>

    <label><input id="imagePath" type="text" placeholder="Image path"></label>

    <button id="btn-add" class="btn-submit"><a href="<?= $link->url('shop.index') ?>">Add</a></button>
</form>