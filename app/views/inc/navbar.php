<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/pages/index"><?= SITE_NAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav d-flex mb-2 mb-lg-0 w-100">
                <div class="nav-item">
                    <a class="nav-link" aria-current="page" href="/pages/index">Home</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/pages/about">About</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="/posts/index">Share posts</a>
                </div>
                <?php if (!$_SESSION['user_id']): ?>
                    <div class="nav-item ms-auto">
                        <a class="nav-link" href="/users/register">Create account</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="/users/login">Log in</a>
                    </div>
                <?php else: ?>
                    <div class="nav-item ms-auto">
                        <a class="nav-link text-light" href="/users/<?= $_SESSION['user_id'] ?>">Hello, <?= $_SESSION['user_name'] ?></a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="/users/logout">Log out</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</nav>