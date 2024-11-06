     // Seleccionar todos los items del carrusel
     const items = document.querySelectorAll('.carousel-item');
     let currentIndex = 0;
     const totalItems = items.length;
 
     // Función para mostrar el item actual y ocultar los demás
     function showItem(index) {
         items.forEach((item, i) => {
             // Mostrar el item correspondiente y ocultar los demás
             item.classList.remove('opacity-100');
             item.classList.add('opacity-0');
             if (i === index) {
                 item.classList.remove('opacity-0');
                 item.classList.add('opacity-100');
             }
         });
     }
     // Función para avanzar al siguiente item
     function nextItem() {
             currentIndex = (currentIndex + 1) % totalItems;
             showItem(currentIndex);
         }
         // Mostrar la primera imagen al cargar
     showItem(currentIndex);
 
         // Cambiar la imagen cada 3 segundos (opcional)
     setInterval(nextItem, 3000); // Cambia la imagen cada 3 segundos