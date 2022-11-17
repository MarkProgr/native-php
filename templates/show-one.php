{% extends "navbar.php" %}

{% block title %}Show{% endblock %}

{% block content %}
<div class="card">
    <div class="card-header">
        About user {{ user.getId() }}
    </div>
    <div class="card-body">
        <h5 class="card-title">Email: {{ user.getEmail() }}</h5>
        <p class="card-text">Name: {{ user.getName() }}</p>
        <p class="card-text">Gender: {{ user.getGender() }}</p>
        <p class="card-text">Status: {{ user.getStatus() }}</p>
        {% if user.getImageName() %}
        <img height="300" src="/uploads/{{ user.getImageName() }}">
        {% endif %}
    </div>
</div>
{% endblock %}