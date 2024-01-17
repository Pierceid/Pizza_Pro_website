<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-remove" method="post" action="<?= $link->url("pizza.removeItem") ?>">
    <input type="hidden" name="pizza-id" value="<?= (isset($_GET['id'])) ? $_GET['id'] : '' ?>"/>

    <h2>Remove pizza</h2>

    <h5>Are you sure you want to delete the pizza?</h5>
    <?php if (isset($_GET['name'])) : ?>
        <h5 style="color: red">(<?= $_GET['name'] ?>)</h5>
    <?php endif ?>
    <button class="btn-submit" type="submit">Remove</button>

    <?php if (isset($_GET['message'])) : ?>
        <h5 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>">
            <?= $_GET['message'] ?>
        </h5>
    <?php endif ?>
</form>
