<?php

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
        <div class="card">
            <h1>Users table</h1>
            <form class="form" method="post">
                <div class="search">
                    <input class="search-field" name="login-field" type="search" placeholder="Login"
                           aria-label="Search">
                    <input class="search-field" name="email-field" type="search" placeholder="Email"
                           aria-label="Search">
                    <select class="search-field" name="is-admin-field">
                        <option value="">All users</option>
                        <option value="0">Not an admin</option>
                        <option value="1">Is an admin</option>
                    </select>
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
                            <th>Account</th>
                        <?php endif ?>
                    </tr>
                    </thead>

                    <tbody>
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
                                            <a href="<?= $link->url("user.profileManagement", ["editId" => $user['id'], "option" => 4]) ?>">
                                                Edit
                                            </a>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger">
                                            <a href="<?= $link->url("user.profileManagement", ["editId" => $user['id'], "option" => -5]) ?>">
                                                Remove
                                            </a>
                                        </button>
                                    </td>
                                <?php endif ?>
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
