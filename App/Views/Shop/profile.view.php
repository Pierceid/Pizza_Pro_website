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

<div class="card"
     style="max-width: 600px; position: relative; left: calc(50% - 20px); transform: translate(-50%);
     margin: 20px; padding: 10px; background-color: lightgrey; border: 2px solid black">
    <div class="field" style="flex-direction: column; align-items: center">
        <img src="/public/images/profiles/<?= $data['imagePath'] ?>" alt="">
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.change", ["name" => $data['name'], "email" => $data['email'], "option" => 0]) ?>"
            >Change</a>
        </button>
    </div>

    <div class="field">
        <h4>Login: <?= $data['name'] ?></h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.change", ["name" => $data['name'], "email" => $data['email'], "option" => 1]) ?>"
            >Change</a>
        </button>
    </div>

    <div class="field">
        <h4>Email: <?= $data['email'] ?></h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.change", ["name" => $data['name'], "email" => $data['email'], "option" => 2]) ?>"
            >Change</a>
        </button>
    </div>

    <div class="field">
        <h4>Password: ************</h4>
        <button type="button" class="btn btn-primary">
            <a href="<?= $link->url("user.change", ["name" => $data['name'], "email" => $data['email'], "option" => 3]) ?>"
            >Change</a>
        </button>
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <h4 style="color: <?= str_contains($_GET['message'], 'Failed') ? 'red' : 'green' ?>; text-align: center">
            <?= $_GET['message'] ?>
        </h4>
    <?php endif ?>
</div>

</body>
</html>
