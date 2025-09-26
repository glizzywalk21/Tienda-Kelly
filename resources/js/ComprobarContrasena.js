
    // Obtener los elementos de los campos de contraseña
    var contrasena = document.getElementById('contrasena');
    var confirmarContrasena = document.getElementById('confirmar_contrasena');

    // Función para verificar si las contraseñas coinciden
    function verificarContrasenas() {
        if (contrasena.value !== confirmarContrasena.value) {
            confirmarContrasena.setCustomValidity("Las contraseñas no coinciden");
        } else {
            confirmarContrasena.setCustomValidity('');
        }
    }

    // Agregar un listener para el evento input en el campo de confirmar contraseña
    confirmarContrasena.addEventListener('input', verificarContrasenas);


