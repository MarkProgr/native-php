<!DOCTYPE html>
<html lang="en">
<head>
    <title>Show User</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Main Page</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/create">Create User</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="card">
    <div class="card-header">
        About user <?= $user->getId() ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Email: <?= $user->getEmail() ?></h5>
        <p class="card-text">Name: <?= $user->getName() ?></p>
        <p class="card-text">Gender: <?= $user->getGender() ?></p>
        <p class="card-text">Status: <?= $user->getStatus() ?></p>
        <?php if ($user->getImageName()): ?>
        <img height="300" src="/uploads/<?= $user->getImageName() ?>">
        <?php endif; ?>
    </div>
</div>
</body>
</html>
