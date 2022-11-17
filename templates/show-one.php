<!DOCTYPE html>
<html lang="en">
<head>
    <title>Show User</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php require __DIR__ . '/navbar.php'; ?>
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
