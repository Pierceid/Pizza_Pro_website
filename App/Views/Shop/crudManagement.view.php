<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$pizzaId = $_GET['pizzaId'] ?? '';
$operation = $_GET['operation'] ?? '';

$pizza = \App\Models\Pizza::getOne($pizzaId) ?? null;
$name = !is_null($pizza) ? $pizza->getName() : ($_GET['name'] ?? '');
$description = !is_null($pizza) ? $pizza->getDescription() : ($_GET['description'] ?? '');
$cost = $cost = !is_null($pizza) ? number_format($pizza->getCost(), 2) : (!empty($_GET['cost']) ? number_format($_GET['cost'], 2) : '');
$amount = !is_null($pizza) ? $pizza->getAmount() : '';

$destination = $operation == 'insert' ? 'pizza.insertItem' :
    ($operation == 'update' ? 'pizza.updateItem' :
        (($operation == 'delete' ? 'pizza.deleteItem' : '')));

$header = $operation == 'insert' ? 'Insert pizza' :
    ($operation == 'update' ? 'Update pizza' :
        (($operation == 'delete' ? 'Delete pizza' : '')));
?>

<form class="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="pizza-id" value="<?= $pizzaId ?>"/>

    <h2><?= $header ?></h2>

    <?php if ($operation == 'insert' || $operation == 'update') : ?>
        <label><input name="name" type="text" placeholder="Name" value="<?= $name ?>"></label>
        <label><input name="description" type="text" placeholder="Description" value="<?= $description ?>"></label>
        <label><input name="cost" type="text" placeholder="Cost" value="<?= $cost ?>"></label>
        <label><input name="image-path" type="file" placeholder="Image path"></label>
    <?php elseif ($operation == 'delete') : ?>
        <h5>Are you sure you want to delete the item?</h5>
        <?php if (!empty($name)) : ?>
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