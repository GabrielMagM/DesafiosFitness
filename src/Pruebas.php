<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portada con Carrusel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .carousel-item {
      display: none;
    }
    .carousel-item.active {
      display: block;
    }
  </style>
</head>
<body class="bg-gray-100">

  <!-- Enlaces de Registro e Inicio de Sesión -->
  <nav class="absolute top-0 right-0 p-4 z-10">
    <a href="pages/register.php" class="text-white bg-blue-500 px-4 py-2 rounded-lg mr-2 hover:bg-blue-600">Registrarse</a>
    <a href="pages/login.php" class="text-white bg-gray-800 px-4 py-2 rounded-lg hover:bg-gray-900">Iniciar sesión</a>
  </nav>

  <!-- Carrusel -->
  <div class="h-screen w-full relative">
    <div id="carousel" class="relative w-full h-full overflow-hidden">
      <!-- Imagen 1 -->
      <div class="carousel-item active relative h-full w-full">
        <img src="https://img.freepik.com/foto-gratis/cerrar-entrenamiento-pesas-rusas-gimnasio_23-2149307711.jpg?t=st=1730662150~exp=1730665750~hmac=710f0460ad46324900a699c943fd998cf3fd8d94c28c6d492bdcf15058cacd1a&w=826" class="w-full h-full object-cover brightness-50" alt="Imagen 1">
        <div class="absolute inset-0 flex items-center justify-center">
          <h1 class="text-white text-5xl font-bold">ENTRENA TU FUERZA</h1>
        </div>
      </div>
      <!-- Imagen 2 -->
      <div class="carousel-item relative h-full w-full">
        <img src="https://img.freepik.com/foto-gratis/mujer-haciendo-yoga-playa_23-2148694882.jpg?t=st=1730659884~exp=1730663484~hmac=514ee0694b229a51ffac36b68574df8cd24a763ff61b4e189fe106f6bf2ae75c&w=826" class="w-full h-full object-cover brightness-50" alt="Imagen 2">
        <div class="absolute inset-0 flex items-center justify-center">
          <h1 class="text-white text-5xl font-bold">ENTRENA TU MENTE</h1>
        </div>
      </div>
      <!-- Imagen 3 -->
      <div class="carousel-item relative h-full w-full">
        <img src="https://img.freepik.com/foto-gratis/sonriente-mujer-hermosa-bebiendo-agua-botella-haciendo-deporte-manana-parque_285396-4370.jpg?t=st=1730659911~exp=1730663511~hmac=e51024615ab1c79264cd4acbe52693c0aa7a9b3d40c41b9c45b2b91aea1046a7&w=826" class="w-full h-full object-cover brightness-50" alt="Imagen 3">
        <div class="absolute inset-0 flex items-center justify-center">
          <h1 class="text-white text-5xl font-bold">ENTRENA TU SALUD</h1>
        </div>
      </div>

    </div>
  </div>

  <!-- Script del Carrusel -->
  <script>
    const items = document.querySelectorAll('.carousel-item');
    let currentIndex = 0;
    const totalItems = items.length;

    function showItem(index) {
      items.forEach((item, i) => {
        item.classList.toggle('active', i === index);
      });
    }

    function nextItem() {
      currentIndex = (currentIndex + 1) % totalItems;
      showItem(currentIndex);
    }

    function prevItem() {
      currentIndex = (currentIndex - 1 + totalItems) % totalItems;
      showItem(currentIndex);
    }

    // Cambiar la imagen automáticamente cada 5 segundos
    setInterval(nextItem, 5000);
  </script>

</body>
</html>