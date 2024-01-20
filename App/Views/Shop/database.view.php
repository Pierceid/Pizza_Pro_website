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
                <h2>Users table</h2>
                <form class="form" method="post" action="<?= $link->url("shop.database") ?>">
                    <input name="search-field" type="search" placeholder="Search login"
                           aria-label="Search" style="width: 100%; padding: 5px; margin-right: 10px">
                    <button class="btn btn-dark" type="submit">Search</button>
                </form>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Is admin</th>
                        <?php if ($isAdmin) : ?>
                            <th>Edit privilege</th>
                        <? endif ?>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['isAdmin'] ?></td>

                                <?php if ($isAdmin) : ?>
                                    <td>
                                        <button type="button" class="btn btn-primary">
                                            <a href="<?= $link->url("user.edit", ["name" => $user['name'], "editId" => $user['id'], "option" => 4]) ?>"
                                            >Edit</a>
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
            </div>
        </div>
    </div>
</div>
