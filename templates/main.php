<!DOCTYPE html>
<html lang="en">
<head>
    <title>Main Page</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php require __DIR__ . '/navbar.php'; ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Your first and last name</th>
            <th scope="col">Gender</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <th scope="row"><?= $user->getId() ?></th>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getGender() ?></td>
            <td><?= $user->getStatus() ?></td>
            <td>
                <a href="/<?= $user->getId() ?>" class="btn btn-dark">About</a>
                <a href="/<?= $user->getId() ?>/edit" class="btn btn-dark">Edit</a>
                <form method="post" action="/<?= $user->getId() ?>/delete">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>