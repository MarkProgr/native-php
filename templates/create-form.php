<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Page</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php require __DIR__ . '/navbar.php'; ?>
<form id="form" method="post" action="/create" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input id="email" type="email" name="email" class="form-control field">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Your first and last name</label>
        <input id="name" name="name" type="text" class="form-control field">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Gender</label>
        <select name="gender" class="form-select" aria-label="Default select example">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Status</label>
        <select name="status" class="form-select" aria-label="Default select example">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Put the photo</label>
        <input class="form-control" name="image" type="file" id="formFile">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
    const form = document.getElementById('form');
    let name = document.getElementById('name');
    let fields = document.querySelectorAll('.field');

    form.addEventListener('submit', function (event) {
        let errors = document.querySelectorAll('.alert-danger');

        for (let i = 0; i < errors.length; i++) {
            errors[i].remove();
        }

        for (let i = 0; i < fields.length; i++) {
            if (!fields[i].value) {
                let error = document.createElement('div');
                error.className = 'alert alert-danger';
                error.innerHTML = 'This field is required';
                form[i].parentElement.insertBefore(error, fields[i]);
                event.preventDefault();
            }
        }
    });
</script>
</body>
</html>