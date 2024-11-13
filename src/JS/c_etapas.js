function mostrarCamposEtapas() {
    var numeroEtapas = document.getElementById("etapas").value;
    var camposEtapas = document.getElementById("camposEtapas");
    
    // Limpiar el contenedor de etapas
    camposEtapas.innerHTML = '';
    
    // Opciones de título para las etapas
    var opcionesTitulo = ["Introducción", "Desarrollo", "Práctica", "Conclusión"];

    for (var i = 1; i <= numeroEtapas; i++) {
        // Crear campo de selección de título para la etapa
        var tituloLabel = document.createElement("label");
        tituloLabel.className = "font-semibold text-white";
        tituloLabel.innerHTML = "Título de la Etapa " + i + ":";
        camposEtapas.appendChild(tituloLabel);

        var tituloSelect = document.createElement("select");
        tituloSelect.name = "titulo_etapa_" + i;
        tituloSelect.className = "rounded-md shadow-md px-1 py-1";
        tituloSelect.required = true;

        // Añadir opciones al select
        opcionesTitulo.forEach(function(titulo) {
            var option = document.createElement("option");
            option.value = titulo;
            option.text = titulo;
            tituloSelect.appendChild(option);
        });
        camposEtapas.appendChild(tituloSelect);

        // Crear campo de descripción para la etapa
        var descripcionLabel = document.createElement("label");
        descripcionLabel.className = "font-semibold text-white";
        descripcionLabel.innerHTML = "Descripción de la Etapa " + i + ":";
        camposEtapas.appendChild(descripcionLabel);

        var descripcionTextarea = document.createElement("textarea");
        descripcionTextarea.name = "descripcion_etapa_" + i;
        descripcionTextarea.rows = 2;
        descripcionTextarea.className = "rounded-md shadow-md px-1";
        descripcionTextarea.placeholder = "Ingrese Descripción de la Etapa " + i;
        descripcionTextarea.maxLength = 80;
        descripcionTextarea.required = true;
        camposEtapas.appendChild(descripcionTextarea);
    }
}