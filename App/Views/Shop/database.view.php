<?php /** @noinspection ALL */

$layout = 'primary';
/** @var string $contentHTML */
/** @var \App\Core\LinkGenerator $link */
/** @var $data */
?>

<link rel="stylesheet" href="/public/css/styl_database.css">

<?php
$isAdmin = (int)$data['isAdmin'] ?? 0;
$users = $data['users'] ?? [];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <h1>Users table</h1>
                <form class="form" method="post">
                    <div class="search">
                        <input class="search-field" name="search-field" type="search" placeholder="Search login"
                               aria-label="Search">
                        <button class="btn btn-light" type="submit" formaction="<?= $link->url("shop.database") ?>">
                            Search
                        </button>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <?php if ($isAdmin) : ?>
                                <th>Privilege</th>
                            <? endif ?>
                        </tr>
                        </thead>

                        <tbody id="container">
                        <?php if (!empty($users)) : ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['isAdmin'] ? 'Yes' : 'No' ?></td>

                                    <?php if ($isAdmin) : ?>
                                        <td>
                                            <button type="button" class="btn btn-primary">
                                                <a href="<?= $link->url("user.edit", ["name" => $user['name'], "editId" => $user['id'], "option" => 4]) ?>">
                                                    Edit
                                                </a>
                                            </button>
                                        </td>
                                    <? endif ?>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                        </tbody>
                    </table>
                    <?php if (empty($users)) : ?>
                        <h5 style="color: red">0 results found</h5>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="button" class="btn btn-dark" style="width: 60px; height: 40px; align-self: center">GO</div>

<script src="/public/js/script_database.js"></script>

