<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Main Page</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/create">Create User</a>
                </li>
            </ul>
            <?php if (!$_COOKIE): ?>
            <a class="btn btn-light" href="/login">Login</a>
            <?php endif; ?>
            <?php if ($_COOKIE): ?>
            <form method="post" action="/logout">
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</nav>
