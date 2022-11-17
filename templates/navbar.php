<!DOCTYPE html>
<html lang="en">
<head>
    <title>{% block title %}{% endblock %} page</title>
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
            {% if sessionId is same as(null) %}
            <a class="btn btn-light" href="/login">Login</a>
                <a class="btn btn-light" href="/sign-up">Sign Up</a>
            {% endif %}
            {% if sessionId %}
            <form method="post" action="/logout">
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
            {% endif %}
        </div>
    </div>
</nav>
<body>
{% block content %}
{% endblock %}
</body>
</html>
