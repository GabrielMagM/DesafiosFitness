<!--<link rel="stylesheet" href="../assets/css/header_log.css">-->

<header id="header" class="bg-gray-900 text-white shadow-md mt-3 mx-6 rounded-md py-1">
    <div id="h_container" class="flex flex-wrap justify-between items-center px-12">
        <img id="logo" src="../assets/images/Siiiu.png" alt="Logo" class="h-14">
        <nav id="ul" class="flex justify-between gap-6">
            <a href="index.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Inicio</a>
            <a href="desafios.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Desafíos</a>
            <a href="#" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Informe</a>
        </nav>
        <div id="h-container2" class="flex items-center gap-4">
            <div id="perfil_container" class="relative group">
                <img id="person_image" src="../assets/svg/personsvg.svg" class="w-6 h-6 cursor-pointer" alt="Perfil">
                <div id="person_container" class="hidden group-hover:block absolute right-0 pt-4 bg-slate-100 text-gray-500 rounded shadow-lg">
                    <div id="show_container" class="flex flex-col gap-2 w-36 py-3 px-5">
                        <!-- Mostrar el nombre del usuario escapado para mayor seguridad -->
                        <p id="name_text" class="cursor-pointer hover:text-blue-700">Mi Perfil: <?php echo htmlspecialchars($userName); ?></p>
                        <!-- Enlace para cerrar sesión -->
                        <a id="close_text" href="index.php?logout=1" class="cursor-pointer hover:text-red-500">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
