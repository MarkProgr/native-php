{% extends "navbar.php" %}

{% block title %}Sign up{% endblock %}

{% block content %}
<form class="mt-3" method="post">
    {% if error %}
    <div class="alert alert-danger w-50">
        <p>{{ error }}</p>
    </div>
    {% endif %}
    <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="text" name="login" class="form-control w-50">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input name="password" type="password" class="form-control w-50">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password confirmation</label>
        <input name="password_confirmation" type="password" class="form-control w-50">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
{% endblock %}
