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
$email = $data['email'] ?? '';
$imagePath = $data['imagePath'] ?? '';
?>

<div class="container-fluid content">
    <div class="user">
        <div id="user-name" style="display: none"><?= $name ?></div>
        <div id="user-email" style="display: none"><?= $email ?></div>
        <div id="user-image-path" style="display: none"><?= $imagePath ?></div>
    </div>

    <div class="container">
        <div class="card">
            <h5>What do you think of the website?</h5>

            <div class="satisfaction-options">
                <div class="radio-group">
                    <label>
                        <input id="option-1" type="radio" name="radio" value="great" checked> Great
                    </label>
                    <label>
                        <input id="option-2" type="radio" name="radio" value="good"> Good
                    </label>
                    <label>
                        <input id="option-3" type="radio" name="radio" value="decent"> Decent
                    </label>
                    <label>
                        <input id="option-4" type="radio" name="radio" value="bad"> Bad
                    </label>
                </div>

                <div class="icons">
                    <img src="/public/images/satisfactions/great.png" alt="">
                    <img src="/public/images/satisfactions/good.png" alt="">
                    <img src="/public/images/satisfactions/decent.png" alt="">
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
                    <input id="checkbox" type="checkbox" checked>
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

