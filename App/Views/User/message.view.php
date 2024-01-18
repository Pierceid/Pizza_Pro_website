<?php

$layout = '';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$message = $_GET['message'];
$destination = ($_GET['destination'] < 0) ? 'user.index' : 'shop.index';
$button = ($_GET['destination'] < 0) ? 'Return' : 'Continue';
?>

<form class="form form-message" method="post" action="<?= $link->url($destination) ?>" style="top: 10%">
    <?php if (isset($_GET['message'])) : ?>
        <h2 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>; text-align: center">
            <?= $_GET['message'] ?>
        </h2>
    <?php endif ?>
    <button class="btn-submit" type="submit"><?= $button ?></button>
</form>