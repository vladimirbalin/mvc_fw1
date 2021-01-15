<?php use app\helpers\SessionHelper;

require_once APP_ROOT . "/views/inc/header.php"; ?>
<div class="d-flex justify-content-around align-items-center my-4">
    <div class="">
        <h1>Posts</h1>

    </div>
    <div class="">
        <a href="/posts/add" class="btn btn-primary float-end"><i class="bi bi-pencil"></i> Add post</a>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 mx-auto">
        <?php SessionHelper::flash('post_info'); ?>
    </div>
</div>
<?php foreach($params as $post) :?>
<div class="row">
    <div class="col-md-6 col-sm-12 mx-auto">
        <div class="card card-body ">
            <h4 class="card-title"><?=$post->title?></h4>
            <div class="bg-light p-2 mb-3 fs-6 fw-lighter">posted by: <span class="fw-bolder"><?=$post->name?></span> on <?=$post->p_created_at?></div>
            <p class="card-text"><?=$post->body?></p>
            <a href="/posts/show/<?=$post->post_id?>" class="btn btn-dark">More</a>
        </div>
    </div>
</div>

<?php endforeach; ?>
<?php require_once APP_ROOT . "/views/inc/footer.php"; ?>
