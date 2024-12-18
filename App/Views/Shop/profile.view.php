<?php

$layout = 'primary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_profile.css">

<?php
$userId = $data['user-id'] ?? '';
$name = !is_null($userId) ? \App\Models\User::getOne($userId)->getLogin() : '';
?>

<input type="hidden" name="user-name" value="<?= $name ?>"/>

<div class="card">
    <div class="field" style="flex-direction: column; align-items: center">
        <img src="/public/images/profiles/<?= $data['image-path'] ?>" alt="">
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.profileManagement", ["user-id" => $userId, "option" => 0]) ?>"
            >Edit</a>
        </button>
    </div>

    <div class="field">
        <h4>Name: <?= $data['name'] ?></h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.profileManagement", ["user-id" => $userId, "option" => 1]) ?>"
            >Edit</a>
        </button>
    </div>

    <div class="field">
        <h4>Email: <?= $data['email'] ?></h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.profileManagement", ["user-id" => $userId, "option" => 2]) ?>"
            >Edit</a>
        </button>
    </div>

    <div class="field">
        <h4>Password: **********</h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.profileManagement", ["user-id" => $userId, "option" => 3]) ?>"
            >Edit</a>
        </button>
    </div>

    <div class="action-buttons">
        <button type="button" class="btn btn-danger profile-btn">
            <a href="<?= $link->url("user.profileManagement", ["user-id" => $userId, "option" => 5]) ?>"
            >Delete account</a>
        </button>
        <button type="button" class="btn btn-dark profile-btn">
            <a href="<?= $link->url("shop.index") ?>">Back to shop</a>
        </button>
    </div>
</div>
