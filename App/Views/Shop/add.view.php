<?php
$layout = 'eshop';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>
<link rel="stylesheet" href="/public/css/styl_addOrRemove.css">

<form class="form form-add" method="post" action="<?= $link->url("pizza.addItem") ?>">
    <h1 class="title">Add pizza</h1>

    <label><input name="name" type="text" placeholder="Name"></label>

    <label><input name="description" type="text" placeholder="Description"></label>

    <label><input name="cost" type="text" placeholder="Cost"></label>

    <button id="btn-add" class="btn-submit" type="submit">Add</button>
</form>