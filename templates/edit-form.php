{% extends "navbar.php" %}

{% block title %}Edit{% endblock %}

{% block content %}
<form id="form" method="post" action="/{{ user.getId() }}/edit" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input id="email" value="{{ user.getEmail() }}" type="email" name="email" class="form-control field">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Your first and last name</label>
        <input id="name" value="{{ user.getName() }}" name="name" type="text" class="form-control field">
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
{% endblock %}