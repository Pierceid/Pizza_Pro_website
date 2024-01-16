<?php

$layout = 'pizza-pro';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-remove" method="post" action="<?= $link->url("pizza.removeItem") ?>">
    <input type ="hidden" name ="pizza-id" value ="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>" />

    <h1 style="color: blue; font-weight: bold">Remove pizza</h1>

    <h3>Are you sure you want to delete the pizza?</h3>

    <button class="btn-submit" type="submit">Remove</button>

    <h4 style="color: darkmagenta"><?php if (isset($_GET['message'])) echo $_GET['message']; ?></h4>
</form>
