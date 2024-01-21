<?php

$layout = 'secondary';
/* @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_buttons.css">
<link rel="stylesheet" href="/public/css/styl_feedback.css">
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

<?php
$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$imagePath = $data['imagePath'] ?? '';
?>

<div id="app">
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
                        <input type="radio" id="option-1" v-model="selectedOption" value="option1" checked>
                        <label for="option-1">Option 1</label>
                        <input type="radio" id="option-2" v-model="selectedOption" value="option2" checked>
                        <label for="option-2">Option 2</label>
                        <input type="radio" id="option-3" v-model="selectedOption" value="option3" checked>
                        <label for="option-3">Option 3</label>
                        <input type="radio" id="option-4" v-model="selectedOption" value="option4" checked>
                        <label for="option-4">Option 4</label>
                    </div>
                    <div class="icons">
                        <img src="/public/images/satisfactions/great.png" alt="">
                        <img src="/public/images/satisfactions/good.png" alt="">
                        <img src="/public/images/satisfactions/decent.png" alt="">
                        <img src="/public/images/satisfactions/bad.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5>Do you have any thoughts you'd like to share?</h5>
            <textarea id="user-text" v-model="userText" placeholder="Share your thoughts"></textarea>
        </div>

        <div class="card">
            <h5>May we follow you up on your feedback?</h5>
            <div class="switch-option">
                Yes
                <label class="switch">
                    <input type="checkbox" id="checkbox" v-model="isChecked" checked>
                    <span class="slider"></span>
                </label>
                No
            </div>
        </div>

        <div class="action-buttons">
            <button @click="discardData" id="btn-discard" class="btn btn-danger">Discard</button>
            <div class="btn btn-dark">
                <a href="<?= $link->url("shop.index") ?>">Cancel</a>
            </div>
            <button @click="sendData" id="btn-send" class="btn btn-success">Send</button>
        </div>

        <div class="card container">
            <h5>Posts of our costumers</h5>
            <div class="action-buttons">
                <button @click="loadData" id="btn-load" class="btn btn-warning btn-log">Load post</button>
                <button @click="clearData" id="btn-clear" class="btn btn-warning btn-log">Clear posts</button>
            </div>

            <div v-for="(post, index) in posts" :key="index" class="post">
                <div class="header">
                    <div class="user-info">
                        <h6 class="user-name">{{ post.data.first_name ?? $name }} {{ post.data.last_name }}</h6>
                        <h6 class="user-email">contact: {{ post.data.email }}</h6>
                    </div>
                    <img :src="post.data.avatar" alt="">
                </div>
                <div class="divider"></div>
                <h6 class="body">{{ post.support.text }}</h6>
            </div>
        </div>
    </div>
</div>

<script src="/public/js/script_feedback.js"></script>
