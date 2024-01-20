<?php

$layout = 'secondary';
/* @var \App\Core\LinkGenerator $link */
?>

<link rel="stylesheet" href="/public/css/styl_buttons.css">
<link rel="stylesheet" href="/public/css/styl_feedback.css">

<div class="question">
    <h5>What do you think of the website?</h5>

    <div class="satisfaction-options">
        <div class="option">
            <label>
                <input type="radio" class="radio-button" name="radioGroup" value="option1" checked>Great
            </label>
            <img src="/public/images/satisfactions/great.png" alt="">
        </div>

        <div class="option">
            <label>
                <input type="radio" class="radio-button" name="radioGroup" value="option2">Good
            </label>
            <img src="/public/images/satisfactions/good.png" alt="">
        </div>

        <div class="option">
            <label>
                <input type="radio" class="radio-button" name="radioGroup" value="option3">Decent
            </label>
            <img src="/public/images/satisfactions/decent.png" alt="">

        </div>

        <div class="option">
            <label>
                <input type="radio" class="radio-button" name="radioGroup" value="option4">Bad
            </label>
            <img src="/public/images/satisfactions/bad.png" alt="">
        </div>
    </div>
</div>

<div class="question">
    <h5>Do you have any thoughts you'd like to share?</h5>
    <div class="text-input input-group mb-3">
        <textarea class="feedback-input form-control" placeholder="Share your thoughts"
                  aria-label="Thoughts"></textarea>
    </div>
</div>

<div class="question">
    <h5>May we follow you up on your feedback?</h5>
    <div class="switch-option">
        Yes
        <label class="switch">
            <input type="checkbox">
            <span class="slider"></span>
        </label>
        No
    </div>
</div>

<div class="action-buttons">
    <div class="btn btn-danger">
        <a href="<?= $link->url("shop.feedback") ?>">Discard</a>
    </div>
    <div class="btn btn-dark">
        <a href="<?= $link->url("shop.index") ?>">Cancel</a>
    </div>
    <div class="btn btn-success">
        <a href="<?= $link->url("shop.index") ?>">Send</a>
    </div>
</div>
