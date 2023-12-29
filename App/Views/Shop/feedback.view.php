<?php

$layout = '';
/* @var \App\Core\LinkGenerator $link */
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Pizza feedback</title>
<link rel="stylesheet" href="/public/css/styl_feedback.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<body>

<div class="container-fluid">
    <a href="<?= $link->url("shop.index") ?>"><img src="/public/images/others/logo.png" alt=""></a>
    <h1 style="font-size: x-large; font-weight: bold">Give us your feedback</h1>
    <a href="<?= $link->url("shop.index") ?>"><img src="/public/images/others/logo.png" alt=""></a>
</div>

<div class="question">
    <header>What do you think of the website?</header>

    <form class="satisfaction-options">
        <label>
            <input type="radio" class="radio-button" name="radioGroup" value="option1" checked>
            Great
            <img src="/public/images/satisfactions/great.png" alt="">
        </label>

        <label>
            <input type="radio" class="radio-button" name="radioGroup" value="option2">
            Good
            <img src="/public/images/satisfactions/good.png" alt="">
        </label>

        <label>
            <input type="radio" class="radio-button" name="radioGroup" value="option3">
            Decent
            <img src="/public/images/satisfactions/decent.png" alt="">
        </label>

        <label>
            <input type="radio" class="radio-button" name="radioGroup" value="option4">
            Bad
            <img src="/public/images/satisfactions/bad.png" alt="">
        </label>
    </form>
</div>

<div class="question">
    <header>Do you have any thoughts you'd like to sare?</header>
    <div class="text-input input-group mb-3">
        <textarea class="feedback-input form-control" placeholder="Share your thoughts"
                  aria-label="Thoughts"></textarea>
    </div>
</div>

<div class="question">
    <header>May we follow you up on your feedback?</header>
    <form class="switch-option">
        Yes
        <label class="switch">
            <input type="checkbox">
            <span class="slider"></span>
        </label>
        No
    </form>
</div>

<div class="action-buttons">
    <div class="btn btn-secondary" style="background-color: purple">Discard</div>
    <div class="btn btn-secondary" style="background-color: purple">
        <a href="<?= $link->url("shop.index") ?>">Cancel</a>
    </div>
    <div class="btn btn-secondary" style="background-color: purple">Send</div>
</div>

</body>
</html>
