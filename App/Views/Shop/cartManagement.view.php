<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$pizzaId = $_GET['pizzaId'] ?? '';
$locationId = $_GET['locationId'] ?? '';
$purchase = $_GET['purchase'] ?? '';
$operation = $_GET['operation'] ?? '';

$pizza = \App\Models\Pizza::getOne($pizzaId) ?? null;
$name = (!is_null($pizza)) ? $pizza->getName() : '';
$cost = (!is_null($pizza)) ? number_format($pizza->getCost(), 2) : '';
$amount = (!is_null($pizza)) ? $pizza->getAmount() : '';

$location = \App\Models\Location::getOne($locationId) ?? null;
$street = (!is_null($location)) ? $location->getStreet() : '';
$city = (!is_null($location)) ? $location->getCity() : '';
$zip = (!is_null($location)) ? $location->getZip() : '';

$destination = $operation == 'add' ? 'pizza.addItem' : ($operation == 'adjust' ? 'pizza.adjustItem' :
    ($operation == 'remove' ? 'pizza.removeItem' : ($operation == 'discard' ? 'order.discardOrder' :
        ($operation == 'choose' ? 'order.createLocation' : ''))));

$header = $operation == 'add' ? 'Add pizza' : ($operation == 'adjust' ? 'Adjust pizza' :
    ($operation == 'remove' ? 'Remove pizza' : ($operation == 'discard' ? 'Discard order' :
        ($operation == 'choose' ? 'Choose location' : ''))));
$moveTo = $operation == 'add' ? 'shop.index' : 'shop.cart';
?>

<form class="form" method="post">
    <input type="hidden" name="pizza-id" value="<?= $pizzaId ?>"/>
    <input type="hidden" name="location-id" value="<?= $locationId ?>"/>
    <input type="hidden" name="order-cost" value="<?= $purchase ?>"/>

    <h2><?= $header ?></h2>

    <?php if ($operation == 'add' || $operation == 'adjust') : ?>
        <h5 style="color: red"><?= $name ?></h5>
        <h5 style="color: black">Cost: <?= $cost ?> €</h5>
        <label><input class="counter" type="number" name="pizza-amount" placeholder="Amount"
                      min="0" max="100" value="<?= $amount ?>"/></label>
    <?php elseif ($operation == 'remove') : ?>
        <h5>Are you sure you want to remove the pizza from your cart?</h5>
        <h5 style="color: red"><?= ($amount) ?? '' ?>x <?= ($name) ?? 'not selected' ?></h5>
    <?php elseif ($operation == 'discard') : ?>
        <h5>Are you sure you want to discard your order?</h5>
        <h5 style="color: saddlebrown">Purchase: <?= $purchase ?? '0.00' ?> €</h5>
    <?php elseif ($operation == 'choose') : ?>
        <h5 style="color: saddlebrown">Purchase: <?= $purchase ?? '0.00' ?> €</h5>
        <label><input name="street" type="text" placeholder="Street" value="<?= $street ?>"></label>
        <label><input name="city" type="text" placeholder="City" value="<?= $city ?>"></label>
        <label><input name="zip" type="text" placeholder="Zip" value="<?= $zip ?>"></label>
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