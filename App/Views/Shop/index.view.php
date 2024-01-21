<?php

$layout = 'primary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_buttons.css">
<link rel="stylesheet" href="/public/css/styl_shop.css">

<div class="carousel-container">
    <div id="carousel-container" class="carousel slide">
        <div class="carousel-inner">
            <?php
            $allPizzas = $data['all-pizzas'];
            $filteredPizzas = $data['filtered-pizzas'];
            shuffle($allPizzas);
            $pizzaSets = array_chunk($allPizzas, 4);

            foreach ($pizzaSets as $setIndex => $pizzaSet): ?>
                <div class="carousel-item<?php echo $setIndex === 0 ? ' active' : ''; ?>">
                    <?php foreach ($pizzaSet as $pizza): ?>
                        <img src="<?= $pizza['image-path'] ?>" alt="">
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-container" data-bs-slide="prev"
                style="justify-content: left; padding-left: 5px">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carousel-container" data-bs-slide="next"
                style="justify-content: right; padding-right: 5px">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<form class="form" method="post">
    <div class="search">
        <input class="search-field" name="search-field" type="search" placeholder="Search your favorite pizza"
               aria-label="Search">
        <button class="btn btn-light" type="submit" formaction="<?= $link->url("shop.index") ?>">
            Search
        </button>
    </div>
</form>

<div class="pizzas-container row">
    <?php if ($data['isAdmin'] > 0) : ?>
        <div class="card add-card" style="background-color: darkorange">
            <a href="<?= $link->url("shop.crudManagement", ["operation" => "insert"]) ?>">
                <img src="/public/images/icons/plus.png" alt="">
            </a>
        </div>
    <?php endif ?>

    <?php if (!empty($filteredPizzas)) : ?>
        <?php foreach ($filteredPizzas as $pizza): ?>
            <div class="card">
                <?php
                $id = $pizza['id'];
                $name = $pizza['name'];
                $description = $pizza['description'];
                $cost = number_format($pizza['cost'], 2);
                $imagePath = $pizza['image-path'];
                $amount = $pizza['amount'];
                ?>

                <input id="pizza-id" type="hidden" value="<?= $id ?>">

                <img src="<?= $imagePath ?>" alt="">
                <h5><?= $name ?></h5>
                <h6>Cost: <?= $cost ?> €</h6>

                <div class="action-buttons">
                    <?php if ($data['isAdmin']): ?>
                        <button type="button" class="btn btn-primary">
                            <a href="<?= $link->url("shop.crudManagement", ["operation" => "update", "pizzaId" => $id]) ?>"
                            >o</a>
                        </button>

                        <button type="button" class="btn btn-success">
                            <a href="<?= $link->url("shop.cartManagement", ["operation" => "add", "pizzaId" => $id]) ?>">ADD</a>
                        </button>

                        <button type="button" class="btn btn-danger">
                            <a href="<?= $link->url("shop.crudManagement", ["operation" => "delete", "pizzaId" => $id]) ?>">x</a>
                        </button>
                    <?php else: ?>
                        <button id="plus-btn" type="button" class="btn btn-success">+</button>

                        <button id="amount-btn" type="button" class="btn btn-light"><?= $amount ?></button>

                        <button id="minus-btn" type="button" class="btn btn-danger">-</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif ?>
</div>

<script src="/public/js/script_shop.js"></script>
