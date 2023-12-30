<?php

$layout = '';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-message" method="post" action="<?= $link->url("shop.index") ?>">
    <h2 style="color: green"><?= $data["message"] ?></h2>

    <button name="btn-return" class="btn-submit" type="submit">Continue</button>
</form>
