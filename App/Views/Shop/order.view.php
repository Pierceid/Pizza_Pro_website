<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$locationId = $_GET['locationId'] ?? '';
$purchase = $_GET['purchase'] ?? '';
$operation = $_GET['operation'] ?? '';

$location = \App\Models\Location::getOne($locationId) ?? null;
$address = !is_null($location) ? $location->getStreet() . ', ' . $location->getCity() . ', ' . $location->getZip() : 'not selected';

$destination = $operation == 'order' ? 'order.createOrder' : 'order.discardPizzas';
$header = $operation == 'order' ? 'Place order' : 'Confirm order';
$text = $operation == 'order' ? 'Are you sure you want to place your order?' : 'Your order has been placed!';
?>

<form class="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="location-id" value="<?= $locationId ?>"/>
    <input type="hidden" name="order-cost" value="<?= $purchase ?>"/>

    <h2><?= $header ?></h2>
    <h5><?= $text ?></h5>

    <?php if ($operation == 'order'): ?>
        <h5 style="color: darkblue">Address: <?= $address ?></h5>
        <h5 style="color: darkred">Purchase: <?= $purchase ?? '0.00' ?> €</h5>
    <?php endif ?>

    <div class="action-buttons">
        <?php if ($operation == 'order'): ?>
            <button class="btn-submit" type="submit" formaction="<?= $link->url("shop.cart") ?>">Cancel</button>
        <?php endif ?>
        <button class="btn-submit" type="submit" formaction="<?= $link->url($destination) ?>"><?= $operation ?></button>
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <h5 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>">
            <?= $_GET['message'] ?>
        </h5>
    <?php endif ?>
</form>