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
$editId = $_GET['editId'] ?? '';
$destination = $option != '4' ? 'shop.profile' : 'shop.database';
$header = $option == 0 ? 'profile image' : ($option == 1 ? 'name' :
    ($option == 2 ? 'email' : ($option == 3 ? 'password' : 'admin privilege')));
?>

<form class="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="option-id" value="<?= $option ?>"/>
    <input type="hidden" name="user-name" value="<?= $name ?>"/>
    <input type="hidden" name="edit-id" value="<?= $editId ?>"/>

    <h2>Edit <?= $header ?></h2>
    <h5 style="color: red">User: <?= $name ?></h5>

    <label>
        <input name="image-path" type="<?= ($option == 0) ? 'file' : 'hidden' ?>" placeholder="Image path">
        <input name="name" type="<?= ($option == 1) ? 'text' : 'hidden' ?>" placeholder="Name" value="<?= $name ?>">
        <input name="email" type="<?= ($option == 2) ? 'email' : 'hidden' ?>" placeholder="Email" value="<?= $email ?>">
        <input name="password-old" type="<?= ($option == 3) ? 'password' : 'hidden' ?>" placeholder="Old password">
        <input name="password-new" type="<?= ($option == 3) ? 'password' : 'hidden' ?>" placeholder="New password">
        <?php if ($option == 4) : ?>
            <select name="is-admin">
                <option value="0">Not an admin</option>
                <option value="1">Is an admin</option>
            </select>
        <?php endif ?>
    </label>

    <div class="action-buttons">
        <button class="btn-submit" type="submit" formaction="<?= $link->url($destination) ?>">Cancel</button>
        <button class="btn-submit" type="submit" formaction="<?= $link->url("user.editProfile") ?>">Edit</button>
    </div>
</form>
