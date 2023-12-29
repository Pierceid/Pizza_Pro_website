<?php

$layout = '';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-message" method="post" action="<?= $link->url("user.index") ?>">
    <h2>Failed to login or register!</h2>

    <button name="btn-return" class="btn-submit" type="submit">Return</button>
</form>
