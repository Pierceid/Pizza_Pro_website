<?php

$layout = 'secondary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-edit" method="post" action="<?= $link->url("user.editProfile") ?>"
      enctype="multipart/form-data">

    <input type="hidden" name="option-id" value="<?= $option = $_GET['option'] ?? -1; ?>"/>
    <input type="hidden" name="user-name" value="<?= $name = $_GET['name'] ?? ''; ?>"/>
    <input type="hidden" name="user-email" value="<?= $email = $_GET['email'] ?? ''; ?>"/>

    <h2>
        Edit your <?= ($option == 0) ? 'profile image' : (($option == 1) ? 'name' : (($option == 2) ? 'email' : 'password')) ?>
    </h2>

    <label>
        <input name="image-path" type="<?= ($option == 0) ? 'file' : 'hidden' ?>" placeholder="Image path">
        <input name="name" type="<?= ($option == 1) ? 'text' : 'hidden' ?>" placeholder="Name" value="<?= $name ?>">
        <input name="email" type="<?= ($option == 2) ? 'email' : 'hidden' ?>" placeholder="Email" value="<?= $email ?>">
        <input name="password-old" type="<?= ($option == 3) ? 'password' : 'hidden' ?>" placeholder="Old password">
        <input name="password-new" type="<?= ($option == 3) ? 'password' : 'hidden' ?>" placeholder="New password">
    </label>

    <button class="btn-submit" type="submit">Edit</button>
</form>
