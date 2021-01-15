<?php require_once APP_ROOT . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-6 mx-auto my-4">
        <a href="/posts" class="btn btn-outline-dark"><i class="bi bi-arrow-left-circle-fill"></i>&nbsp;&nbsp;Back to
            posts</a>
    </div>
</div>
<div class="row">

        <div class="col-6 bg-secondary text-white mx-auto p-2 mb-2">
            Written by <?= $params['user']->name ?> on <?= $params['post']->created_at ?>

        </div>


</div>
<div class="row">
    <div class="col-6 mx-auto">
        <p class="fw-bolder"><?=$params['post']->title?></p>
        <p><?= $params['post']->body ?></p>

        <?php if ($params['post']->user_id == $_SESSION['user_id']): ?>
            <a href="/posts/edit/<?= $params['post']->post_id ?>" class="btn btn-dark float-start">Edit</a>
            <form action="/posts/delete/<?=$params['post']->post_id?>" method="post">
                <input type="submit" value="Delete" class="btn btn-danger float-end">
            </form>
        <?php endif; ?>
    </div>
</div>

<?php require_once APP_ROOT . "/views/inc/footer.php"; ?>
