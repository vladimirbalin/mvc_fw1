<?php use app\helpers\SessionHelper;

require_once APP_ROOT . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-6 mx-auto">
        <div class="card car-body bg-light my-5">
            <h2 class="m-3 text-center">Login</h2>
            <?php SessionHelper::flash('register_success'); ?>
        </div>
        <div class="card text-center">
            <p class="fw-light">acc for testing purposes. <span class="text-sm">click to copy</span></p>
            <div class="col d-flex justify-content-center align-items-center">
                <span class="fw-light">email:&nbsp;
                    <button id="copy1"
                            data-bs-toggle="tooltip"
                            data-bs-placement="right" title="Copied"
                            data-bs-trigger="click"
                            data-clipboard-text="testaccount@mail.com"
                            class="btn m-0 p-0">testaccount@mail.com
                    </button>
                </span>

            </div>
            <div class="col d-flex justify-content-center align-items-center">
                               <span class="fw-light">password:&nbsp;
                    <button id="copy2"
                            data-bs-toggle="tooltip"
                            data-bs-placement="right" title="Copied"
                            data-bs-trigger="click"
                            data-clipboard-text="testaccount"
                            class="btn m-0 p-0">testaccount
                    </button>
                </span>
            </div>


        </div>
        <form method="post">
            <div class="row">
                <div class="col mb-3">
                    <label>Email address</label>
                    <input name="email" type="email"
                           class="form-control <?= ($params['errors']['email'] ? 'is-invalid' : '') ?>"
                           id="myInputEmail_p"
                           value="<?= $params['email'] ?>">
                    <div class="invalid-feedback">
                        <?= $params['errors']['email'] ?? '' ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           class="form-control <?= ($params['errors']['password'] ? 'is-invalid' : '') ?>"
                           id="myInputPassword_p"
                           name="password">
                    <div class="invalid-feedback">
                        <?= $params['errors']['password'] ?? '' ?>
                    </div>
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

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    tooltipList.forEach(el => {
        document.addEventListener('shown.bs.tooltip', function () {
            setTimeout(function () {
                el.hide()
            }, 2000);
        })

    })

    var clipboard1 = new ClipboardJS('#copy1');
    clipboard1.on('success', function (e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        // e.clearSelection();
    });
    var clipboard2 = new ClipboardJS('#copy2');

</script>
<?php require_once APP_ROOT . "/views/inc/footer.php"; ?>
