document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (username === 'usuario' && password === 'contraseña') {
        // Simulando inicio de sesión exitoso
        alert('¡Inicio de sesión exitoso!');
        // Aquí puedes redirigir a otra página, por ejemplo:
        // window.location.href = 'dashboard.html';
    } else {
        document.getElementById('error-message').textContent = 'Usuario o contraseña incorrectos.';
    }
});