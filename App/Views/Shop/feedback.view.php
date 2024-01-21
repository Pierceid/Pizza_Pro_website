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
    <button @click="loadData" id="btn-load">Load Data</button>
    <button @click="clearData" id="btn-clear">Clear Data</button>
    <div>
        <input type="radio" id="option-1" v-model="selectedOption" value="option1" checked>
        <label for="option-1">Option 1</label>
    </div>
    <textarea id="user-text" v-model="userText"></textarea>
    <input type="checkbox" id="checkbox" v-model="isChecked" checked>
    <button @click="sendData" id="btn-send">Send Data</button>
    <button @click="discardData" id="btn-discard">Discard Data</button>
    <div v-for="(post, index) in posts" :key="index" class="post">
        <div class="header">
            <div class="user-info">
                <h6 class="user-name">{{ post.data.first_name }} {{ post.data.last_name }}</h6>
                <h6 class="user-email">contact: {{ post.data.email }}</h6>
            </div>
            <img :src="post.data.avatar" alt="">
        </div>
        <div class="divider"></div>
        <h6 class="body">{{ post.support.text }}</h6>
    </div>
</div>

<script src="/public/js/script_posts.js"></script>

