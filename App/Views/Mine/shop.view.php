<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Pizza Pro - Shop</title>

    <link rel="stylesheet" href="style_2.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a href="#"><img src="/Images/logo.png" alt=""></a>

        <a class="navbar-brand" href="#">PIZZA PRO</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#">Profile</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Cart</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Support
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../Website_3/index_3.html">Feedback</a></li>
                        <li><a class="dropdown-item" href="#">Q&A</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">History</a></li>
                    </ul>
                </li>
            </ul>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search your favorite pizza"
                       aria-label="Search">

                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<a href="#"><img class="banner" src="/Images/banner.png" alt=""></a>

<div class="container-fluid pizzas-container row">
    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/neapolitan_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Neapolitan pizza</p>
            <p class="cost">Cost: 10,50 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="plus">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="minus">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/newyork_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">New York pizza</p>
            <p class="cost">Cost: 9,20 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="plus">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="minus">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/california_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">California pizza</p>
            <p class="cost">Cost: 9,50 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/greek_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Greek pizza</p>
            <p class="cost">Cost: 10,00 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/roman_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Roman pizza</p>
            <p class="cost">Cost: 10,20 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="plus">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="minus">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/pepperoni_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Pepperoni pizza</p>
            <p class="cost">Cost: 9,00 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="plus">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="minus">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/veggie_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Veggie pizza</p>
            <p class="cost">Cost: 8,20 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="plus">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="minus">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/chicken_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Chicken pizza</p>
            <p class="cost">Cost: 10,50 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="plus">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="minus">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/hawaiian_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Hawaiian pizza</p>
            <p class="cost">Cost: 9,60 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="plus">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="minus">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/Images/Pizzas/supreme_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Supreme pizza</p>
            <p class="cost">Cost: 12,00 €</p>
            <div class="counter">
                <img src="/Images/plus.png" alt="plus">
                <span class="count">0</span>
                <img src="/Images/minus.png" alt="minus">
            </div>
        </div>
    </div>
</div>

<script src="../../../public/js/script_shop.js"></script>
</body>
</html>