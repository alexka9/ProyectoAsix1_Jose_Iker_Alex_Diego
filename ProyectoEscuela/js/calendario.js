const eventos = {
    dia1: ["Inicio del período escolar"],
    dia2: ["Sin eventos"],
    dia3: ["Sin eventos"],
    dia4: ["Reunión de padres y maestros"],
    dia5: ["Sin eventos"],
    dia6: ["Sin eventos"],
    dia7: ["Sin eventos"],
    dia8: ["Sin eventos"],
    dia9: ["Sin eventos"],
    dia10: ["Taller de orientación vocacional para estudiantes de último año"],
    dia11: ["Sin eventos"],
    dia12: ["Sin eventos"],
    dia13: ["Sin eventos"],
    dia14: ["Sin eventos"],
    dia15: ["Sin eventos"],
    dia16: ["Sin eventos"],
    dia17: ["Sin eventos"],
    dia18: ["Presentación de proyectos y trabajos de los estudiantes"],
    dia19: ["Sin eventos"],
    dia20: ["Visita guiada para nuevos estudiantes y familias"],
    dia21: ["Actividades deportivas y recreativas para estudiantes y familias"],
    dia22: ["Sin eventos"],
    dia23: ["Sin eventos"],
    dia24: ["Sin eventos"],
    dia25: ["Sin eventos"],
    dia26: ["Sin eventos"],
    dia27: ["Sin eventos"],
    dia28: ["Exposición de arte y música de los estudiantes"],
    dia29: ["Sin eventos"],
    dia30: ["Sin eventos"],
    dia31: ["Sin eventos"]
};


// Función para mostrar eventos al hacer clic en un día
document.querySelectorAll('.dia').forEach(item => {
    item.addEventListener('click', event => {
        const diaId = event.target.id;
        const listaEventos = eventos[diaId] || [];
        const eventosDiv = document.getElementById('eventos');
        eventosDiv.innerHTML = ""; // Limpiar eventos anteriores
        listaEventos.forEach(evento => {
            const p = document.createElement('p');
            p.textContent = evento;
            eventosDiv.appendChild(p);
        });
    });
});
