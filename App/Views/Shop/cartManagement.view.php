<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$pizzaId = $_GET['pizza-id'] ?? '';
$purchase = isset($_GET['purchase']) ? number_format($_GET['purchase'], 2) : '0';
$operation = $_GET['operation'] ?? '';

$pizza = \App\Models\Pizza::getOne($pizzaId) ?? null;
$name = (!is_null($pizza)) ? $pizza->getName() : '';
$cost = (!is_null($pizza)) ? number_format($pizza->getCost(), 2) : '';
$amount = (!is_null($pizza)) ? $pizza->getAmount() : '';

$destination = $operation == 'add' ? 'pizza.addItem' : ($operation == 'adjust' ? 'pizza.adjustItem' : 'pizza.removeItem');
$header = $operation == 'add' ? 'Add pizza' : ($operation == 'adjust' ? 'Adjust pizza' : 'Remove pizza');
$moveTo = $operation == 'add' ? 'shop.index' : 'shop.cart';
?>

<form class="form" method="post">
    <input type="hidden" name="pizza-id" value="<?= $pizzaId ?>"/>
    <input type="hidden" name="order-cost" value="<?= $purchase ?>"/>

    <h2 class="title"><?= $header ?></h2>

    <?php if ($operation == 'add' || $operation == 'adjust') : ?>
        <h5 style="color: darkred"><?= $name ?></h5>
        <h5 style="color: black">Cost: <?= $cost ?> €</h5>
        <label><input class="counter" type="number" name="pizza-amount" placeholder="Amount"
                      min="0" max="100" value="<?= $amount ?>"/></label>
    <?php elseif ($operation == 'remove') : ?>
        <h5>Are you sure you want to remove the pizza from your cart?</h5>
        <h5 style="color: darkred"><?= $amount ?? '' ?>x <?= $name ?? 'not selected' ?></h5>
    <?php endif ?>

    <?php if (isset($_GET['message'])) : ?>
        <h5 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>; margin: 10px 0">
            <?= $_GET['message'] ?>
        </h5>
    <?php endif ?>

    <div class="action-buttons">
        <button class="btn-submit" type="submit" formaction="<?= $link->url($moveTo) ?>">Cancel</button>
        <button class="btn-submit" type="submit" formaction="<?= $link->url($destination) ?>"><?= $operation ?></button>
    </div>
</form>