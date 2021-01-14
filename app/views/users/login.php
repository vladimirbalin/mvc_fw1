<?php use app\helpers\SessionHelper;

require_once APP_ROOT . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-6 mx-auto">
        <div class="card car-body bg-light my-5">
            <h2 class="m-3 text-center">Login</h2>
            <?php SessionHelper::flash('register_success'); ?>
        </div>
        <form method="post">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label>Email address</label>
                        <input name="email" type="email"
                               class="form-control <?= ($params['errors']['email'] ? 'is-invalid' : '') ?>"
                               value="<?= $params['email'] ?>">
                        <div class="invalid-feedback">
                            <?= $params['errors']['email'] ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control <?= ($params['errors']['password'] ? 'is-invalid' : '') ?>"
                       name="password">
                <div class="invalid-feedback">
                    <?= $params['errors']['password'] ?? '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col ">
                    <button type="submit" class="btn btn-success w-100">Login</button>
                </div>
                <div class="col pt-2"><p>Dont have an account? <a href="/users/register">Create an account</a></p></div>
            </div>
        </form>
    </div>
</div>
<?php require_once APP_ROOT . "/views/inc/footer.php"; ?>
