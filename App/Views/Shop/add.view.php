<?php

$layout = 'pizza-pro';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-add" method="post" action="<?= $link->url("pizza.addItem") ?>" enctype="multipart/form-data">
    <h2 style="color: blue; font-weight: bold">Add pizza</h2>

    <label><input name="name" type="text" placeholder="Name"></label>

    <label><input name="description" type="text" placeholder="Description"></label>

    <label><input name="cost" type="text" placeholder="Cost"></label>

    <label><input name="image-path" type="file" placeholder="Image path"></label>

    <button class="btn-submit" type="submit">Add</button>

    <h4 style="color: darkmagenta"><?php if (isset($_GET['message'])) echo $_GET['message']; ?></h4>
</form>