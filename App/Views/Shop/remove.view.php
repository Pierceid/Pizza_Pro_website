<?php

$layout = 'pizza-pro';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-remove" method="post" action="<?= $link->url("pizza.removeItem") ?>">
    <input type="hidden" name="pizza-id" value="<?= (isset($_GET['id'])) ? $_GET['id'] : '' ?>"/>

    <h2 style="color: blue; font-weight: bold">Remove pizza</h2>

    <h4>Are you sure you want to delete the pizza?</h4>
    <?php if (isset($_GET['name'])) : ?>
        <h4 style="color: red; font-weight: bold">(<?= $_GET['name'] ?>)</h4>
    <?php endif ?>
    <button class="btn-submit" type="submit">Remove</button>

    <?php if (isset($_GET['message'])) : ?>
        <h4 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>; text-align: center">
            <?= $_GET['message'] ?>
        </h4>
    <?php endif ?>
</form>
