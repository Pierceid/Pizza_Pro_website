<?php

$layout = 'pizza-pro';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_shop.css">

<div class="carousel-container">
    <div id="carousel-container" class="carousel slide">
        <div class="carousel-inner">
            <?php
            shuffle($data['pizzas']);
            $pizzaSets = array_chunk($data['pizzas'], 3);

            foreach ($pizzaSets as $setIndex => $pizzaSet): ?>
                <div class="carousel-item<?php echo $setIndex === 0 ? ' active' : ''; ?>">
                    <?php foreach ($pizzaSet as $pizza): ?>
                        <img src="<?= $pizza['image-path'] ?>" alt=""
                             style="width: 25%; max-width: 250px; max-height: 200px; margin: 5px">
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

<div class="pizzas-container row">
    <div class="card" style="width: 145px; height: 145px; margin: 75px 50px;
    border: 5px solid black; border-radius: 50%; background-color: darkorange">
        <a href="<?= $link->url("shop.add") ?>"><img src="/public/images/icons/plus.png" alt=""></a>
    </div>

    <?php if (!empty($data['pizzas'])) : ?>
        <?php foreach ($data['pizzas'] as $pizza): ?>
            <div class="card">
                <?php
                $id = $pizza['id'];
                $name = $pizza['name'];
                $description = $pizza['description'];
                $cost = $pizza['cost'];
                $imagePath = $pizza['image-path'];
                ?>

                <img style="max-height: 150px; padding-bottom: 10px" src="<?= $imagePath ?>" alt="">
                <h4><?= $name ?></h4>
                <h6>Cost: <?= $cost ?> €</h6>

                <div class="action-buttons">
                    <?php if ($data['admin']): ?>
                        <button type="button" class="btn btn-primary"
                                style="border: 2px solid black; font-weight: bold">
                            <a href="<?= $link->url("shop.update", ["id" => $id, "name" => $name, "description" => $description, "cost" => $cost, "image-path" => $imagePath]) ?>"
                            >Edit</a>
                        </button>
                    <?php endif; ?>

                    <button type="button" class="btn btn-success" style="border: 2px solid black; font-weight: bold">
                        <a href="<?= $link->url("shop.cart", ["id" => $id]) ?>">Add</a>
                    </button>

                    <?php if ($data['admin']): ?>
                        <button type="button" class="btn btn-dark" style="border: 2px solid black; font-weight: bold">
                            <a href="<?= $link->url("shop.remove", ["id" => $id]) ?>">Delete</a>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif ?>
</div>

<script src="/public/js/script_shop.js"></script>
