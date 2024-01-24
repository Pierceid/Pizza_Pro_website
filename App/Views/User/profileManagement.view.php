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
$currentId = $_GET['userId'] ?? '';
$currentUser = !empty($currentId) ? \App\Models\User::getOne($currentId) : null;
$currentName = !is_null($currentUser) ? $currentUser->getLogin() : '';
$currentEmail = !is_null($currentUser) ? $currentUser->getEmail() : '';
$editId = $_GET['editId'] ?? '';
$editUser = !empty($editId) ? \App\Models\User::getOne($editId) : null;
$editName = !is_null($editUser) ? $editUser->getLogin() : '';
$name = !empty($currentName) ? $currentName : (!empty($editName) ? $editName : '');
$destination = $option == 4 || $option == -5 ? 'shop.database' : 'shop.profile';
$option = !empty($option) ? abs($option) : $option;
$button = $option != 5 ? 'Edit' : 'Delete';
$operation = $option != 5 ? 'user.editProfile' : 'user.removeAccount';
$header = $option == 0 ? 'Edit profile image' : ($option == 1 ? 'Edit name' : ($option == 2 ? 'Edit email' :
    ($option == 3 ? 'Edit password' : ($option == 4 ? 'Edit admin privilege' : 'Delete account'))));
?>

<form class="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="option-id" value="<?= $option ?>"/>
    <input type="hidden" name="user-id" value="<?= $currentId ?>"/>
    <input type="hidden" name="edit-id" value="<?= $editId ?>"/>

    <h2 class="title"><?= $header ?></h2>
    <h5 class="message">User: <?= $name ?></h5>

    <label>
        <?php if ($option == 0) : ?>
            <input name="image-path" type="file" placeholder="Image path">
        <?php elseif ($option == 1) : ?>
            <input name="name" type="text" placeholder="Name" value="<?= $currentName ?>">
        <?php elseif ($option == 2) : ?>
            <input name="email" type="email" placeholder="Email" value="<?= $currentEmail ?>">
        <?php elseif ($option == 3) : ?>
            <input name="password-old" type="password" placeholder="Old password">
            <input name="password-new" type="password" placeholder="New password">
        <?php elseif ($option == 4) : ?>
            <select class="search-field" name="is-admin">
                <option value="0">Not an admin</option>
                <option value="1">Is an admin</option>
            </select>
        <?php elseif ($option == 5) : ?>
            <h5>Are you sure you want to delete this account?</h5>
        <?php endif ?>
    </label>

    <div class="action-buttons">
        <button class="btn-submit" type="submit" formaction="<?= $link->url($destination) ?>">Cancel</button>
        <button class="btn-submit" type="submit"
                formaction="<?= $link->url($operation) ?>"><?= $button ?></button>
    </div>
</form>
