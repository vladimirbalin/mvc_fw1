<?php use app\helpers\SessionHelper;

require_once APP_ROOT . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-6 mx-auto my-4">
        <a href="/posts" class="btn btn-outline-dark"><i class="bi bi-arrow-left-circle-fill"></i>&nbsp;&nbsp;Back to
            posts</a>
        <div class="card car-body bg-light my-5">
            <h2 class="my-3 text-center">Add new post</h2>
            <?php SessionHelper::flash('post_info'); ?>
        </div>
        <form method="post">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label>Title</label>
                        <input name="title" type="text"
                               class="form-control <?= ($params['errors']['title'] ? 'is-invalid' : '') ?>"
                               value="<?= $params['title'] ?>">
                        <div class="invalid-feedback">
                            <?= $params['errors']['title'] ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Body</label>
                <textarea class="form-control <?= ($params['errors']['body'] ? 'is-invalid' : '') ?>"
                          name="body"><?= $params['body'] ?></textarea>
                <div class="invalid-feedback">
                    <?= $params['errors']['body'] ?? '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col ">
                    <button type="submit" class="btn btn-success w-100">Add post</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require_once APP_ROOT . "/views/inc/footer.php"; ?>
