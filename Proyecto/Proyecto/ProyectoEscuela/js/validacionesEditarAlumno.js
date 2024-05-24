function validaNombreAlum() {
    var nombre = document.getElementById("nombre_alumno").value;
    var error = document.getElementById("error_nombre_alumno");

    if (nombre == null || nombre.length < 3 || /^\s+$/.test(nombre)) { // Espacios en blanco
        error.innerHTML = "Rellena el campo o añade más caracteres (mínimo 2)";
    } else {
        error.innerHTML = ""; // Si lo haces bien, quita el mensaje de error
    }
}

function validaApellidoAlum() {
    var apellido = document.getElementById("apellido_alumno").value;
    var error = document.getElementById("error_apellido_alumno");

    if (apellido == null || apellido.length < 2 || /^\s+$/.test(apellido)) {
        error.innerHTML = "Rellena el campo o añade más caracteres (mínimo 2)";
    } else {
        error.innerHTML = ""; // Si lo haces bien, quita el mensaje de error
    }
}

function validaTelfAlum() {
    var telefono = document.getElementById("telf_alumno").value
    var error = document.getElementById("error_telf_alumno")
    var telefonoRegExp = /^\d{9}$/; // formato del teléfono
    
    if (!telefono || telefono == null) {
        error.innerHTML = "El campo de teléfono no puede estar vacío"
    } else if (!telefonoRegExp.test(telefono)) {
        error.innerHTML = "El formato del teléfono no es válido"
    } else {
        error.innerHTML = ""
    }
}

function validaNacimientoAlum() {
    var fechaNacimiento = document.getElementById("nacimiento_alumno").value;
    var error = document.getElementById("error_nacimiento_alumno");

    // Expresión regular para validar el formato de fecha (yyyy-mm-dd)
    var fechaRegExp = /^\d{4}-\d{2}-\d{2}$/;

    // Verifica si la fecha de nacimiento es una fecha válida
    if (!fechaNacimiento || fechaNacimiento.trim().length === 0) {
        error.innerHTML = "La fecha de nacimiento no puede estar vacía";
    } else if (!fechaRegExp.test(fechaNacimiento)) {
        error.innerHTML = "El formato de la fecha de nacimiento no es válido (yyyy-mm-dd)";
    } else {
        var fechaActual = new Date();
        var fechaIngresada = new Date(fechaNacimiento);

        if (fechaIngresada >= fechaActual) {
            error.innerHTML = "La fecha de nacimiento debe ser anterior a la fecha actual";
        } else {
            error.innerHTML = ""; // Si la fecha de nacimiento es válida, no muestra ningún mensaje de error
        }
    }
}