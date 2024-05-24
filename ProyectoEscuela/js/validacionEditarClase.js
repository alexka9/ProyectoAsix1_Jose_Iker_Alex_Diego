function validaCodiClase() {
    var nombre = document.getElementById("codi_clase").value;
    var error = document.getElementById("error_codi_clase");

    if (nombre == null || nombre.length < 8 || /^\s+$/.test(nombre)) { // Espacios en blanco
        error.innerHTML = "Rellena el campo o añade más caracteres (mínimo 7)";
    } else {
        error.innerHTML = ""; // Si lo haces bien, quita el mensaje de error
    }
}

function validaNombreClase() {
    var nombreclase = document.getElementById("nombre_clase").value;
    var errornombre = document.getElementById("error_nombre_clase");
    
    if (nombreclase == null || nombreclase.length < 3) { // Espacios en blanco
        error.innerHTML = "Rellena el campo o añade más caracteres (mínimo 2)";
    } else {
        error.innerHTML = ""; // Si lo haces bien, quita el mensaje de error
    }
    }