function validaNombreProf() {
    var nombre = document.getElementById("nombre_prof").value;
    var error = document.getElementById("error_nombre_prof");

    if (nombre == null || nombre.length < 3 || /^\s+$/.test(nombre)) { // Espacios en blanco
        error.innerHTML = "Rellena el campo o añade más caracteres (mínimo 2)";
    } else {
        error.innerHTML = ""; // Si lo haces bien, quita el mensaje de error
    }
}

function validaApellidoProf() {
    var apellido = document.getElementById("apellido_prof").value;
    var error = document.getElementById("error_apellido_prof");

    if (apellido == null || apellido.length < 2 || /^\s+$/.test(apellido)) {
        error.innerHTML = "Rellena el campo o añade más caracteres (mínimo 2)";
    } else {
        error.innerHTML = ""; // Si lo haces bien, quita el mensaje de error
    }
}

function validaTelfProf() {
    var telefono = document.getElementById("telf_prof").value
    var error = document.getElementById("error_telf_prof")
    var telefonoRegExp = /^\d{9}$/; // formato del teléfono
    
    if (!telefono || telefono == null) {
        error.innerHTML = "El campo de teléfono no puede estar vacío"
    } else if (!telefonoRegExp.test(telefono)) {
        error.innerHTML = "El formato del teléfono no es válido"
    } else {
        error.innerHTML = ""
    }
}
function validaContratacionProf() {
    var fechaContratacion = document.getElementById("contratacion_prof").value;
    var error = document.getElementById("error_contratacion_prof");
    
    // Verificar si la fecha de contratación es posterior a la fecha actual
    var fechaActual = new Date();
    var fechaIngresada = new Date(fechaContratacion);

    if (fechaIngresada > fechaActual) {
        error.innerHTML = "La fecha de contratación no puede ser posterior a la fecha actual";
    } else {

        var fechaRegExp = /^\d{4}-\d{2}-\d{2}$/;// Formato yyyy-dd-mm

        if (!fechaContratacion || fechaContratacion.trim().length === 0) {
            error.innerHTML = "El campo de fecha de contratación no puede estar vacío";
        } else if (!fechaRegExp.test(fechaContratacion)) {
            error.innerHTML = "El formato de fecha no es válido (formato esperado: yyyy-mm-dd)";
        } else {
            error.innerHTML = ""; // Si la fecha es válida, no muestra ningún mensaje de error
        }
    }
}

function validaGradoProf() {
var grado = document.getElementById("grado_prof").value;
var error = document.getElementById("error_grado_prof");

if (grado == null || grado.length < 3) { // Espacios en blanco
    error.innerHTML = "Rellena el campo o añade más caracteres (mínimo 2)";
} else {
    error.innerHTML = ""; // Si lo haces bien, quita el mensaje de error
}
}


function validaSalarioProf() {
    var salario = document.getElementById("salario_prof").value;
    var error = document.getElementById("error_salario_prof");

    // Expresión regular para validar el formato de salario (números con hasta 2 decimales)
    var salarioRegExp = /^\d+(\.\d{1,2})?$/;

    if (!salario || salario.trim().length === 0) {
        error.innerHTML = "El campo de salario no puede estar vacío";
    } else if (!salarioRegExp.test(salario)) {
        error.innerHTML = "El formato del salario no es válido (solo números con hasta 2 decimales)";
    } else if (parseFloat(salario) <= 1000) {
        error.innerHTML = "El salario debe ser mayor a 1000 euros";
    } else {
        error.innerHTML = ""; // Si el salario es válido, no muestra ningún mensaje de error
    }
}