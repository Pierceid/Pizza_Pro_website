<?php

$layout = '';
/** @var \App\Core\LinkGenerator $link */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Pizza Pro</title>

    <link rel="stylesheet" href="/public/css/styl_intro.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
    <div class="form-container sign-up">
        <form>
            <h1 class="title">Register</h1>

            <div class="social-media">
                <a href="#"><img src="/public/images/socials/facebook.png" alt=""></a>
                <a href="#"><img src="/public/images/socials/instagram.png" alt=""></a>
                <a href="#"><img src="/public/images/socials/twitter.png" alt=""></a>
                <a href="#"><img src="/public/images/socials/google.png" alt=""></a>
            </div>

            <span>or use your email for registration</span>

            <label><input id="name" type="text" placeholder="Username"></label>

            <label><input id="email" type="email" placeholder="Email"></label>

            <label><input id="password" type="password" placeholder="Password"></label>

            <button id="sign-up" class="btn-submit">Sign up</button>
        </form>
    </div>

    <div class="form-container sign-in">
        <form>
            <h1 class="title">Log in</h1>

            <div class="social-media">
                <a href="#"><img src="/public/images/socials/facebook.png" alt=""></a>
                <a href="#"><img src="/public/images/socials/instagram.png" alt=""></a>
                <a href="#"><img src="/public/images/socials/twitter.png" alt=""></a>
                <a href="#"><img src="/public/images/socials/google.png" alt=""></a>
            </div>

            <span>or use your email and password</span>

            <label><input id="email" type="email" placeholder="Email"></label>

            <label><input id="password" type="password" placeholder="Password"></label>

            <a href="#">Forgot your password?</a>

            <button id="sign-in" class="btn-submit"><a href="<?= $link->url('user.shop')?>">Sign in</a></button>
        </form>
    </div>

    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel left-panel">
                <h1 class="title">Welcome back!</h1>
                <p>Enter your personal details to use all site features.</p>
                <button class="btn-hidden" id="login">Sign in</button>
                <img src="/public/images/others/pizza_sharing.png" alt="">
            </div>

            <div class="toggle-panel right-panel">
                <h1 class="title">New here?</h1>
                <p>Register with your personal details to use all site features.</p>
                <button class="btn-hidden" id="register">Sign up</button>
                <img src="/public/images/others/welcome.png" alt="">
            </div>
        </div>
    </div>
</div>

<script src="/public/js/script_intro.js"></script>
</body>
</html>
