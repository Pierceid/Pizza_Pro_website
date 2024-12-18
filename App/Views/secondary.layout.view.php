<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <link rel="stylesheet" href="/public/css/styl_secondary.css">
</head>

<body>
<div class="container-fluid navbar-container">
    <a href="<?= $link->url("shop.index") ?>"><img src="/public/images/others/logo.png" alt=""></a>
    <a href="<?= $link->url("shop.index") ?>">PIZZA PRO</a>
    <a href="<?= $link->url("shop.index") ?>"><img src="/public/images/others/logo.png" alt=""></a>
</div>

<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>

<script src="/public/js/script_secondary.js"></script>
</body>
</html>
