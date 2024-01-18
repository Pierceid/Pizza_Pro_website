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

?>

<div class="pizzas-container row">
    <div class="card" style="margin-bottom: 15px">
        <h1>Your cart</h1>
    </div>

    <?php if (!empty($data[0])) : ?>
        <?php for ($i = 0; $i < count($data); $i++) { ?>
            <div class="card">
                <?php
                $id = $data[$i]['id'] ?? '';
                $name = $data[$i]['name'] ?? '';
                $description = $data[$i]['description'] ?? '';
                $cost = $data[$i]['cost'] ?? '';
                $imagePath = $data[$i]['image-path'] ?? '';
                $amount = $data[$i]['amount'] ?? '';
                $items += $data[$i]['cost'] ?? 0;

                ?>

                <img src="<?= $imagePath ?>" alt="">

                <div class="content">
                    <h4><?= $name ?></h4>
                    <h5>Cost: <?= $cost ?> €</h5>
                    <div class="action-buttons">
                        <button type="button" class="btn btn-success">
                            <a href="<?= $link->url("shop.cartManagement", ["operation" => "adjust", "id" => $id, "name" => $name, "cost" => $cost, "amount" => $amount]) ?>">+ / -</a>
                        </button>

                        <div class="card amount"><?= $amount ?></div>

                        <button type="button" class="btn btn-danger">
                            <a href="<?= $link->url("shop.cartManagement", ["operation" => "remove", "id" => $id, "name" => $name]) ?>">x</a>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php endif ?>

    <div class="card">
        <div class="check">
            <div class="items-cost">Items:
                <div class="items">

                </div>
            </div>

            <div class="tax-cost">Tax:
                <div class="tax">

                </div>
            </div>

            <div class=""></div>

            <div class="total-cost">Total:
                <div class="total">

                </div>
            </div>
        </div>
    </div>

    <div class="operation">
        <div class="action-buttons">
            <button type="button" class="btn btn-dark">
                <a href="<?= $link->url("shop.cartManagement", ["operation" => "discard"]) ?>">Discard</a>
            </button>

            <button type="button" class="btn btn-dark">
                <a href="<?= $link->url("shop.cartManagement", ["operation" => "order"]) ?>">Order</a>
            </button>
        </div>
    </div>
</div>