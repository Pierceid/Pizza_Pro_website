<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$id = $_GET['id'] ?? '';
$name = $_GET['name'] ?? '';
$description = $_GET['description'] ?? '';
$cost = $_GET['cost'] ?? '';
$operation = $_GET['operation'] ?? '';
$destination = $operation == 'insert' ? 'pizza.insertItem' :
    ($operation == 'update' ? 'pizza.updateItem' :
        (($operation == 'delete' ? 'pizza.deleteItem' : '')));
$header = $operation == 'insert' ? 'Insert pizza' :
    ($operation == 'update' ? 'Update pizza' :
        (($operation == 'delete' ? 'Delete pizza' : '')));
?>

<form class="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="pizza-id" value="<?= $id ?>"/>

    <h2><?= $header ?></h2>

    <?php if ($operation == 'insert' || $operation == 'update') : ?>
        <label><input name="name" type="text" placeholder="Name" value="<?= $name ?>"></label>
        <label><input name="description" type="text" placeholder="Description" value="<?= $description ?>"></label>
        <label><input name="cost" type="text" placeholder="Cost" value="<?= $cost ?>"></label>
        <label><input name="image-path" type="file" placeholder="Image path"></label>
    <?php elseif ($operation == 'delete') : ?>
        <h5>Are you sure you want to delete the item?</h5>
        <?php if (isset($_GET['name'])) : ?>
            <h5 style="color: red">(<?= $name ?>)</h5>
        <?php endif ?>
    <?php endif ?>

    <div class="action-buttons">
        <button class="btn-submit" type="submit" formaction="<?= $link->url('shop.index') ?>">Cancel</button>
        <button class="btn-submit" type="submit" formaction="<?= $link->url($destination) ?>"><?= $operation ?></button>
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <h5 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>">
            <?= $_GET['message'] ?>
        </h5>
    <?php endif ?>
</form>