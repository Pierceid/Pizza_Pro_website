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
        <input class="search-field" name="name-field" type="search" placeholder="Search your favorite pizza"
               aria-label="Name filter" style="background-color: mediumpurple">
        <input class="search-field" name="min-cost-field" type="number" placeholder="Min cost" min="0" max="1000"
               aria-label="Cost filter" style="max-width: 100px; background-color: indianred">
        <input class="search-field" name="max-cost-field" type="number" placeholder="Max cost" min="0" max="1000"
               aria-label="Cost filter" style="max-width: 100px; background-color: lightgreen">
        <button class="btn btn-light" type="submit" formaction="<?= $link->url("shop.index") ?>">
            Search
        </button>
    </div>
</form>

<div class="pizzas-container row">
    <?php if ($data['is-admin'] > 0) : ?>
        <div class="card add-card" style="background-color: darkorange">
            <a href="<?= $link->url("shop.crudManagement", ["operation" => "insert"]) ?>">
                <img src="/public/images/icons/plus.png" alt="">
            </a>
        </div>
    <?php endif ?>

    <?php if (!empty($filteredPizzas)) : ?>
        <?php foreach ($filteredPizzas as $pizza): ?>
            <?php
            $pizzaId = $pizza['id'];
            $name = $pizza['name'];
            $description = $pizza['description'];
            $cost = number_format($pizza['cost'], 2);
            $imagePath = $pizza['image-path'];
            $amount = $pizza['amount'];
            ?>

            <div class="card">
                <input id="pizza-id" type="hidden" value="<?= $pizzaId ?>">

                <img src="<?= $imagePath ?>" alt=""
                     onclick="openModal('<?= $name ?>', '<?= $description ?>', '<?= $imagePath ?>')">
                <h5><?= $name ?></h5>
                <h6>Cost: <?= $cost ?> €</h6>

                <div class="action-buttons">
                    <?php if ($data['is-admin']): ?>
                        <button type="button" class="btn btn-primary">
                            <a href="<?= $link->url("shop.crudManagement", ["operation" => "update", "pizza-id" => $pizzaId]) ?>"
                            >o</a>
                        </button>
                        <button type="button" class="btn btn-success">
                            <a href="<?= $link->url("shop.cartManagement", ["operation" => "add", "pizza-id" => $pizzaId]) ?>">ADD</a>
                        </button>
                        <button type="button" class="btn btn-danger">
                            <a href="<?= $link->url("shop.crudManagement", ["operation" => "delete", "pizza-id" => $pizzaId]) ?>">x</a>
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

<div class="container-fluid">
    <div class="overlay" id="overlay" onclick="closeModal()">
        <div class="modal" id="modal">
            <h1 onclick="closeModal()">&times;</h1>
            <h2 id="modal-title"></h2>
            <img id="modal-image" src="" alt="">
            <h3 id="modal-description"></h3>
        </div>
    </div>
</div>

<script src="/public/js/script_shop.js"></script>
