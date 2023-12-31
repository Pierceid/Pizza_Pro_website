<?php

$layout = '';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-message" method="post" action="<?= $link->url("index") ?>">
    <h2 style="color: red"><?= $data["message"] ?></h2>

    <button name="btn-return" class="btn-submit" type="submit">Return</button>
</form>
