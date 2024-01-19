<?php /** @noinspection ALL */

use App\Core\DB\Connection;

$layout = 'primary';
/** @var string $contentHTML */
/** @var \App\Core\LinkGenerator $link */
/** @var $data */
?>


<?php
$isAdmin = $data['isAdmin'] ?? 0;
$users = $data['users'] ?? [];
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <form class="form" method="post" action="<?= $link->url("shop.database") ?>">
                <input id="search-field" name="search-field" type="search" placeholder="Search login"
                       aria-label="Search">
                <button id="search-btn" class="btn btn-dark" type="submit">Search</button>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Is admin</th>
                    </tr>
                    </thead>

                    <tbody id="output">
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $user): ?>
                            <?php echo $user ?>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#search-btn").keypress(function () {
            $.ajax({
                type: 'POST',
                url: 'App/Helpers/search.php',
                data: {
                    regex: $("#search-field").val(),
                },
                success: function (data) {
                    $("#output").html(data);
                }
            });
        });
    });
</script>
