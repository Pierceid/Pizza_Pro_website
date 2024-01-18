<?php

$layout = 'primary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_buttons.css">
<link rel="stylesheet" href="/public/css/styl_cart.css">

<div class="pizzas-container row">
    <div class="card">
        <h1>Your cart</h1>
    </div>
    <?php if (!empty($data)) : ?>
        <?php for ($i = 0; $i < count($data); $i++) { ?>
            <div class="card">
                <?php
                $id = $data[$i]['id'];
                $name = $data[$i]['name'];
                $description = $data[$i]['description'];
                $cost = $data[$i]['cost'];
                $imagePath = $data[$i]['image-path'];
                $amount = $data[$i]['amount'];
                ?>

                <img src="<?= $imagePath ?>" alt="">

                <div class="content">
                    <h4><?= $name ?></h4>
                    <h5>Cost: <?= $cost ?> €</h5>
                    <div class="action-buttons">
                        <button type="button" class="btn btn-success">
                            <a href="<?= $link->url("shop.add", ["id" => $id, "name" => $name, "cost" => $cost, "amount" => $amount]) ?>">+ / -</a>
                        </button>

                        <div class="card amount"><?= $amount ?></div>

                        <button type="button" class="btn btn-danger">
                            <a href="<?= $link->url("shop.remove", ["id" => $id, "name" => $name]) ?>">x</a>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php endif ?>
</div>