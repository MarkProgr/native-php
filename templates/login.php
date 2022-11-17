<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php require __DIR__ . '/navbar.php'; ?>
<form class="mt-3" method="post" action="/login">
    <?php if ($error): ?>
    <div class="alert alert-danger w-50">
        <p><?= $error ?></p>
    </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="text" name="login" class="form-control w-50">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input name="password" type="password" class="form-control w-50">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>