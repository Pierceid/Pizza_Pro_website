<?php

$layout = 'pizza-pro';
/** @var string $contentHTML */
/** @var \App\Core\LinkGenerator $link */
/** @var $data */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/css/styl_database.css">
</head>

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card mt-5">
                <div class="card-header" style="background-color: purple">
                    <h2 style="text-align: center; font-weight: bold; color: white">Table - users</h2>
                </div>

                <table class="table table-bordered text-center">
                    <tr class="columns">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>isAdmin</td>
                    </tr>

                    <?php for ($i = 0; $i < count($data[0]); $i++) { ?>
                        <tr class="content">
                            <td><?= $data[$i]['id'] ?></td>
                            <td><?= $data[$i]['name'] ?></td>
                            <td><?= $data[$i]['email'] ?></td>
                            <td><?= $data[$i]['isAdmin'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>

</html>
