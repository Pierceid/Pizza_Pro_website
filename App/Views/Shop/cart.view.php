<?php

$layout = 'primary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_buttons.css">
<link rel="stylesheet" href="/public/css/styl_cart.css">

<?php
$items = 0;
$tax = 0.2;
$total = 0.0;
?>

<div class="pizzas-container row">
    <?php if (!empty($data[0])) : ?>
        <?php for ($i = 0; $i < count($data); $i++) { ?>
            <div class="card">
                <?php
                $id = $data[$i]['id'] ?? '';
                $name = $data[$i]['name'] ?? '';
                $description = $data[$i]['description'] ?? '';
                $cost = number_format($data[$i]['cost'], 2) ?? '';
                $imagePath = $data[$i]['image-path'] ?? '';
                $amount = $data[$i]['amount'] ?? '';
                $items +=  $cost * $amount;
                ?>

                <img src="<?= $imagePath ?>" alt="">

                <div class="content">
                    <h4><?= $name ?></h4>
                    <h5>Cost: <?= $cost ?> €</h5>
                    <div class="action-buttons">
                        <button type="button" class="btn btn-success">
                            <a href="<?= $link->url("shop.cartManagement", ["operation" => "adjust", "pizzaId" => $id]) ?>">+
                                / -</a>
                        </button>

                        <div class="card amount"><?= $amount ?></div>

                        <button type="button" class="btn btn-danger">
                            <a href="<?= $link->url("shop.cartManagement", ["operation" => "remove", "pizzaId" => $id]) ?>">x</a>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php endif ?>

    <div class="card" style="background-color: darkgrey">
        <div class="check">
            <div class="check-row">
                <h2 class="check-text">Items:</h2>
                <h2 class="check-value"><?= number_format($items, 2) ?> €</h2>
            </div>

            <div class="check-row">
                <h2 class="check-text">Tax:</h2>
                <h2 class="check-value"><?= number_format($items * $tax, 2) ?> €</h2>
            </div>

            <div class="divider" style="border: 1px solid black; margin: 5px 0"></div>

            <div class="check-row">
                <h1 class="check-text">Total cost:</h1>
                <h1 class="check-value"><?= number_format($total = $items + ($items * $tax), 2) ?> €</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="action-buttons">
            <button type="button" class="btn btn-danger cart-btn">
                <a href="<?= $link->url("shop.cartManagement", ["operation" => "discard", "purchase" => $total]) ?>">Discard</a>
            </button>
            <button type="button" class="btn btn-dark cart-btn">
                <a href="<?= $link->url("shop.index") ?>">Back</a>
            </button>
            <button type="button" class="btn btn-success cart-btn">
                <a href="<?= $link->url("shop.cartManagement", ["operation" => "choose", "purchase" => $total]) ?>">Order</a>
            </button>
        </div>
    </div>
</div>