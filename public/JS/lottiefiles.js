if (lottie) {
    lottie.loadAnimation({
        container: document.getElementById('Animation1'), // Elemento de destino para la animación
        renderer: 'svg', // Renderizado en SVG
        loop: true, // La animación se repetirá
        autoplay: true, // La animación se reproduce automáticamente
        path: '../assets/Animation1.json' // Cambia esto a la ruta de tu archivo JSON
    });
} else {
    console.error("Lottie no se cargó correctamente.");
}