<?php require_once APP_ROOT . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-6 mx-auto">
        <div class="card car-body bg-light my-5">
            <h2 class="m-3 text-center">Create an Account</h2>
        </div>
        <form method="post">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label>Name</label>
                        <input name="name" type="text"
                               class="form-control <?= ($params['errors']['name'] ? 'is-invalid' : '') ?>"
                               value="<?= $params['name'] ?>">
                        <div class="invalid-feedback">
                            <?= $params['errors']['name'] ?? '' ?>
                        </div>
                    </div>
                </div>
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
            <div class="mb-3">
                <label class="form-label">Confirm password</label>
                <input type="password"
                       class="form-control <?= ($params['errors']['confirm_password'] ? 'is-invalid' : '') ?>"
                       name="confirm_password">
                <div class="invalid-feedback">
                    <?= $params['errors']['confirm_password'] ?? '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col "><button type="submit" class="btn btn-success w-100">Submit</button></div>
                <div class="col pt-2"><p>Have an account? <a href="/users/login">Login</a></p></div>
            </div>


        </form>
    </div>
</div>
<?php require_once APP_ROOT . "/views/inc/footer.php"; ?>
