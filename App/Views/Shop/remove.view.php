<?php
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>
<link rel="stylesheet" href="/public/css/styl_addOrRemove.css">

<form class="form-add" method="post" action="<?= $link->url("shop.remove") ?>">
    <h1 class="title">Remove pizza</h1>

    <label><input id="name" type="text" placeholder="Name"></label>

    <button id="btn-remove" class="btn-submit"><a href="<?= $link->url('shop.index') ?>">Remove</a></button>
</form>
