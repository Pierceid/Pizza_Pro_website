<?php

$layout = 'pizza-pro';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-update" method="post" action="<?= $link->url("pizza.updateItem") ?>" enctype="multipart/form-data">
    <input type ="hidden" name ="pizza-id" value ="<?php if (isset($_GET['id'])) echo $_GET['id']; ?>" />

    <h2 style="color: blue; font-weight: bold">Update pizza</h2>

    <label><input name="name" type="text" placeholder="Name" value="<?php if (isset($_GET['name'])) echo $_GET['name']; ?>"></label>

    <label><input name="description" type="text" placeholder="Description" value="<?php if (isset($_GET['description'])) echo $_GET['description']; ?>"></label>

    <label><input name="cost" type="text" placeholder="Cost" value="<?php if (isset($_GET['cost'])) echo $_GET['cost']; ?>"></label>

    <label><input name="image-path" type="file" placeholder="Image path"></label>

    <button class="btn-submit" type="submit">Update</button>

    <?php if (isset($_GET['message'])) : ?>
        <h4 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>; text-align: center">
            <?= $_GET['message'] ?>
        </h4>
    <?php endif ?></form>
