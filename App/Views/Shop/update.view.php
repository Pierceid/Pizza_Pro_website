<?php
$layout = 'shop';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>
<link rel="stylesheet" href="/public/css/styl_message.css">

<form class="form form-update" method="post" action="<?= $link->url("pizza.updateItem") ?>">
    <h1>Update pizza</h1>

    <label><input name="id" type="text" placeholder="Id"></label>

    <label><input name="name" type="text" placeholder="Name"></label>

    <label><input name="description" type="text" placeholder="Description"></label>

    <label><input name="cost" type="text" placeholder="Cost"></label>

    <button name="btn-update" class="btn-submit" type="submit">Update</button>

    <h2></h2>
</form>
