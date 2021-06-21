<strong>
    <pre>
    </pre>
    hello
    {% if session.user is defined %}
    {{ session.user.firstname }}
    {% endif %}
    {% if session.user is not defined %}
    {{ 'Wilder' }}
    {% endif %}
</strong>