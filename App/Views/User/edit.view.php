<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<?php
$option = $_GET['option'] ?? '';
$name = $_GET['name'] ?? '';
$email = $_GET['email'] ?? '';
$header = $option == 0 ? 'profile image' : ($option == 1 ? 'name' :
    ($option == 2 ? 'email' : ($option == 3 ? 'password' : '')));
?>

<form class="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="option-id" value="<?= $option ?>"/>
    <input type="hidden" name="user-name" value="<?= $name ?>"/>
    <input type="hidden" name="user-email" value="<?= $email ?>"/>

    <h2>Edit your <?= $header ?></h2>

    <label>
        <input name="image-path" type="<?= ($option == 0) ? 'file' : 'hidden' ?>" placeholder="Image path">
        <input name="name" type="<?= ($option == 1) ? 'text' : 'hidden' ?>" placeholder="Name" value="<?= $name ?>">
        <input name="email" type="<?= ($option == 2) ? 'email' : 'hidden' ?>" placeholder="Email" value="<?= $email ?>">
        <input name="password-old" type="<?= ($option == 3) ? 'password' : 'hidden' ?>" placeholder="Old password">
        <input name="password-new" type="<?= ($option == 3) ? 'password' : 'hidden' ?>" placeholder="New password">
    </label>

    <div class="action-buttons">
        <button class="btn-submit" type="submit" formaction="<?= $link->url('shop.profile') ?>">Cancel</button>
        <button class="btn-submit" type="submit" formaction="<?= $link->url("user.editProfile") ?>">Edit</button>
    </div>
</form>
