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
    <link rel="stylesheet" href="/public/css/styl_primary.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid navbar-container">
        <a href="<?= $link->url("shop.index") ?>"><img src="/public/images/others/logo.png" alt=""></a>

        <a class="navbar-brand" href="<?= $link->url("shop.index") ?>">PIZZA PRO</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="<?= $link->url('shop.profile') ?>">Profile</a>
                </li>
                <li class="nav-item"><a class="nav-link active" href="<?= $link->url('shop.index') ?>">Shop</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= $link->url('shop.cart') ?>">Cart</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">Support
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= $link->url('shop.feedback') ?>">Feedback</a></li>
                        <li><a class="dropdown-item" href="<?= $link->url('shop.database') ?>">Database</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= $link->url('user.index') ?>">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>

<footer class="footer mt-5">
    <div class="text-center text-light py-3">
        <p>&copy; <?= date('Y') ?> <?= \App\Config\Configuration::APP_NAME ?></p>
        <p>Follow us on <a href="#" class="text-light">Instagram</a> | <a href="#" class="text-light">Facebook</a></p>
    </div>
</footer>

</body>
</html>
