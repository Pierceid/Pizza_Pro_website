<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$id = $_GET['id'] ?? '';
$name = $_GET['name'] ?? '';
$cost = $_GET['cost'] ?? '';
$amount = $_GET['amount'] ?? '';
$operation = $_GET['operation'] ?? '';
$destination = $operation == 'add' ? 'pizza.addItem' : ($operation == 'adjust' ? 'pizza.adjustItem' :
    ($operation == 'remove' ? 'pizza.removeItem' : ($operation == 'discard' ? 'pizza.discardItems' : '')));
$header = $operation == 'add' ? 'Add pizza' : ($operation == 'adjust' ? 'Adjust pizza' :
    ($operation == 'remove' ? 'Remove pizza' : ($operation == 'discard' ? 'Discard order' : '')));
$moveTo = $operation == 'add' ? 'shop.index' : 'shop.cart';
?>

<form class="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="pizza-id" value="<?= $id ?>"/>

    <h2><?= $header ?></h2>

    <?php if ($operation == 'add' || $operation == 'adjust') : ?>
        <h5 style="color: red"><?= $name ?></h5>
        <h5 style="color: black">Cost: <?= $cost ?> €</h5>
        <label><input class="counter" type="number" name="pizza-amount" placeholder="Amount" min="0" max="100"
                      value="<?= $amount ?>"/></label>
    <?php elseif ($operation == 'remove') : ?>
        <h5>Are you sure you want to remove the pizza from your cart?</h5>
        <h5 style="color: red">(<?= isset($_GET['name']) ? $name : 'not selected' ?>)</h5>
    <?php elseif ($operation == 'discard') : ?>
        <h5>Are you sure you want to discard your order?</h5>
    <?php endif ?>

    <div class="action-buttons">
        <button class="btn-submit" type="submit" formaction="<?= $link->url($moveTo) ?>">Cancel</button>
        <button class="btn-submit" type="submit" formaction="<?= $link->url($destination) ?>"><?= $operation ?></button>
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <h5 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>">
            <?= $_GET['message'] ?>
        </h5>
    <?php endif ?>
</form>