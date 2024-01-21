<?php

$layout = 'secondary';
/* @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_buttons.css">
<link rel="stylesheet" href="/public/css/styl_feedback.css">

<?php
$name = $data['name'] ?? '';
$email =$data['email'] ?? '';
$imagePath = $data['imagePath'] ?? '';
?>

<div class="container-fluid content">
    <div id="user-name" class="user-name"><?= $name ?></div>
    <div id="user-email" class="user-email"><?= $email ?></div>
    <div id="user-image-path" class="user-image-path"><?= $imagePath ?></div>

    <div class="container">
        <div class="card">
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

        <div class="card">
            <h5>Do you have any thoughts you'd like to share?</h5>
            <div class="text-input input-group mb-3">
        <textarea id="user-text" class="feedback-input form-control user-text" placeholder="Share your thoughts"
                  aria-label="Thoughts">
        </textarea>
            </div>
        </div>

        <div class="card">
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
            <div id="btn-discard" class="btn btn-danger">Discard</div>
            <div class="btn btn-dark">
                <a href="<?= $link->url("shop.index") ?>">Cancel</a>
            </div>
            <div id="btn-send" class="btn btn-success">Send</div>
        </div>
    </div>

    <div class="card container">
        <h5>Posts of our costumers</h5>
        <div class="action-buttons">
            <div id="btn-load" class="btn btn-warning btn-log">Load posts</div>
            <div id="btn-clear" class="btn btn-warning btn-log">Clear log</div>
        </div>

        <div id="post-container" class="post-container"></div>
    </div>
</div>

<script src="/public/js/script_feedback.js"></script>

