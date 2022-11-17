{% extends "navbar.php" %}

{% block title %}Main{% endblock %}

{% block content %}
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
        {% for user in users %}
        <tr>
            <th scope="row">{{ user.getId() }}</th>
            <td>{{ user.getEmail() }}</td>
            <td>{{ user.getName() }}</td>
            <td>{{ user.getGender() }}</td>
            <td>{{ user.getStatus() }}</td>
            <td>
                <a href="/{{ user.getId() }}" class="btn btn-dark">About</a>
                <a href="/{{ user.getId() }}/edit" class="btn btn-dark">Edit</a>
                <form method="post" action="/{{ user.getId() }}/delete">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        {% endfor %}
        </tbody>
    </table>
{% endblock %}