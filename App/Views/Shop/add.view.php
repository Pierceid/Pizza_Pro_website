<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-add" method="post" action="<?= $link->url("pizza.addItem") ?>" enctype="multipart/form-data">
    <input type="hidden" name="pizza-id" value="<?= (isset($_GET['id'])) ? $_GET['id'] : '' ?>"/>

    <h2>Add pizza to your cart</h2>

    <?php
    $name = $_GET['name'] ?? '';
    $cost = $_GET['cost'] ?? '';
    ?>
    <h5 style="color: red"><?= $name ?></h5>
    <h5 style="color: black">Cost: <?= $cost ?> €</h5>

    <label><input type="number" name="pizza-amount" placeholder="Amount" min="0" max="100"/></label>

    <button class="btn-submit" type="submit">Add to cart</button>

    <?php if (isset($_GET['message'])) : ?>
        <h5 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>">
            <?= $_GET['message'] ?>
        </h5>
    <?php endif ?>
</form>