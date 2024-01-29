<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$locationId = $_GET['location-id'] ?? '';
$purchase = isset($_GET['purchase']) ? number_format($_GET['purchase'], 2) : '0.00';
$operation = $_GET['operation'] ?? '';

$location = \App\Models\Location::getOne($locationId) ?? null;
$street = (!is_null($location)) ? $location->getStreet() : '';
$city = (!is_null($location)) ? $location->getCity() : '';
$zip = (!is_null($location)) ? $location->getZip() : '';
$address = $street . ', ' . $city . ', ' . $zip;

$destination = $operation == 'discard' || $operation == 'ok' ? 'order.discardOrder' :
    ($operation == 'choose' ? 'order.createLocation' : 'order.createOrder');
$header = $operation == 'discard' ? 'Discard order' : ($operation == 'choose' ? 'Choose location' :
    ($operation == 'order' ? 'Place order' : 'Confirm order'));
$text = $operation == 'discard' ? 'Are you sure you want to discard your order?' :
    ($operation == 'order' ? 'Are you sure you want to place your order?' : 'Your order has been placed!');
?>

<form class="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="location-id" value="<?= $locationId ?>"/>
    <input type="hidden" name="order-cost" value="<?= $purchase ?>"/>

    <h2 class="title"><?= $header ?></h2>

    <?php if ($operation == 'discard') : ?>
        <h5><?= $text ?></h5>
        <h5 style="color: darkred">Purchase: <?= $purchase ?? '0.00' ?> €</h5>
    <?php elseif ($operation == 'choose') : ?>
        <h5 style="color: darkred">Purchase: <?= $purchase ?? '0.00' ?> €</h5>
        <label><input name="street" type="text" placeholder="Street" value="<?= $street ?>"></label>
        <label><input name="city" type="text" placeholder="City" value="<?= $city ?>"></label>
        <label><input name="zip" type="text" placeholder="Zip" value="<?= $zip ?>"></label>
    <?php elseif ($operation == 'order'): ?>
        <h5 style="color: darkblue">Address: <?= $address ?></h5>
        <h5 style="color: darkred">Purchase: <?= $purchase ?> €</h5>
    <?php endif ?>

    <?php if (isset($_GET['message'])) : ?>
        <h5 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>; margin: 10px 0">
            <?= $_GET['message'] ?>
        </h5>
    <?php endif ?>

    <div class="action-buttons">
        <?php if ($operation != 'ok'): ?>
            <button class="btn-submit" type="submit" formaction="<?= $link->url("shop.cart") ?>">Cancel</button>
        <?php endif ?>
        <button class="btn-submit" type="submit" formaction="<?= $link->url($destination) ?>"><?= $operation ?></button>
    </div>
</form>