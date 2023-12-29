<?php

$layout = 'shop';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-remove" method="post" action="<?= $link->url("pizza.removeItem") ?>">
    <h1>Remove pizza</h1>

    <label><input name="id" type="text" placeholder="Id"></label>

    <button name="btn-remove" class="btn-submit" type="submit">Remove</button>

    <h2></h2>
</form>
