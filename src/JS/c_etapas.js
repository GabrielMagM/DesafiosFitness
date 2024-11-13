// Control de las etapas
function mostrarCamposEtapas() {
    const etapas = document.getElementById("etapas").value;
    const contenedor = document.getElementById("camposEtapas");
    contenedor.innerHTML = "";

    for (let i = 1; i <= etapas; i++) {
        contenedor.innerHTML += `
            <label for="etapa_${i}">Descripción de la etapa ${i}:</label>
            <input type="text" id="etapa_${i}" name="etapa_${i}" required>
        `;
    }
}

// Selector de imagen
const images = ["running.webp", "estiramiento.webp", "Peso_muerto.webp"];
let currentIndex = 0;

function cambiarImagen(direction) {
    currentIndex = (currentIndex + direction + images.length) % images.length;
    document.getElementById("previewImage").src = "../assets/desafio_img/" + images[currentIndex];
    document.getElementById("imagen_url").value = images[currentIndex];
}