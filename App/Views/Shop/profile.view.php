<?php

$layout = '';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Pizza profile</title>
<link rel="stylesheet" href="/public/css/styl_profile.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<body>

<div class="container-fluid">
    <a href="<?= $link->url("shop.index") ?>"><img src="/public/images/others/logo.png" alt=""></a>
    <h1 style="font-size: x-large; font-weight: bold">Your profile</h1>
    <a href="<?= $link->url("shop.index") ?>"><img src="/public/images/others/logo.png" alt=""></a>
</div>

<div class="card">
    <img style="" src="/public/images/others/Toxic.png" alt="">
    <div class="field">
        <h3>Login: <?= $data['login'] ?></h3>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("shop.update", ["login" => $data['login'], "email" => $data['email']]) ?>"
            >Change</a>
        </button>
    </div>

    <div class="field">
        <h3>Email: <?= $data['email'] ?></h3>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("shop.update", ["login" => $data['login'], "email" => $data['email']]) ?>"
            >Change</a>
        </button>
    </div>

    <div class="field">
        <h3>Password: ************</h3>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("shop.update", ["login" => $data['login'], "email" => $data['email']]) ?>"
            >Change</a>
        </button>
    </div>
</div>

</body>
</html>
