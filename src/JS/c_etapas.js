// Control de las etapas
        function mostrarCamposEtapas() {
            const etapas = document.getElementById("etapas").value;
            const contenedor = document.getElementById("camposEtapas");
            contenedor.innerHTML = "";

            for (let i = 1; i <= etapas; i++) {
                contenedor.innerHTML += `
                    <div class="grid grid-cols-1 gap-1">
                        <div class="flex flex-col shadow-md w-11/12 justify-self-center">
                            <label class="text-white" for="etapa_${i}">Descripción de la etapa ${i}:</label>
                            <textarea rows="2" type="text" id="etapa_${i}" name="etapa_${i}" class="mt-1 rounded-md pb-3 text-wrap" required></textarea>  
                        </div>
                    </div>
                        `;
            }
        }

        // Selector de imagen
        const images = ["runing.webp", "estiramiento.webp", "peso_muerto.webp"];
        let currentIndex = 0;

        function cambiarImagen(direction) {
            currentIndex = (currentIndex + direction + images.length) % images.length;
            document.getElementById("previewImage").src = "../assets/desafio_img/" + images[currentIndex];
            document.getElementById("imagen_url").value = images[currentIndex];
        }