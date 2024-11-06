<div id="modalLogin" class="flex fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
        <div id="modalContent" class="bg-white p-8 rounded-lg w-96 shadow-lg relative">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Iniciar sesión</h2>
            <form>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Nombre de usuario</label>
                    <input type="text" id="username_login" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Escribe tu nombre de usuario">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Contraseña</label>
                    <input type="password" id="password_login" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Escribe tu contraseña">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-cyan-800 text-white rounded hover:bg-cyan-700">Entrar</button>
                </div>
            </form>
            
            <!-- Botón de cerrar (X) -->
            <button id="closeModalLogin" class="absolute top-2 right-2 text-2xl text-gray-700 bg-transparent border-none hover:text-cyan-800 mr-4">X</button>
        </div>
    </div>