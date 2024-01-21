<?php

$layout = 'primary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_profile.css">

<?php
$name = $data['name'] ?? '';
?>

<input type="hidden" name="user-name" value="<?= $name ?>"/>

<div class="card">
    <div class="field" style="flex-direction: column; align-items: center">
        <img src="/public/images/profiles/<?= $data['imagePath'] ?>" alt="">
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.edit", ["name" => $name, "option" => 0]) ?>"
            >Edit</a>
        </button>
    </div>

    <div class="field">
        <h4>Name: <?= $data['name'] ?></h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.edit", ["name" => $name, "option" => 1]) ?>"
            >Edit</a>
        </button>
    </div>

    <div class="field">
        <h4>Email: <?= $data['email'] ?></h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.edit", ["name" => $name, "option" => 2]) ?>"
            >Edit</a>
        </button>
    </div>

    <div class="field">
        <h4>Password: **********</h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.edit", ["name" => $name, "option" => 3]) ?>"
            >Edit</a>
        </button>
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <h4 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>; text-align: center">
            <?= $_GET['message'] ?>
        </h4>
    <?php endif ?>
</div>
