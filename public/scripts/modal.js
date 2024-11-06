// Seleccionar los elementos del modalLogin y botones
        const modalLogin = document.getElementById('modalLogin');
        const openModalLoginButton = document.getElementById('openModalLogin');
        const closeModalLoginButton = document.getElementById('closeModalLogin');

        const openModalRegisterButton = document.getElementById('openModalRegister');
        const closeModalRegisterButton = document.getElementById('closeModalRegister');

        // Mostrar el modalLogin cuando se haga clic en "Iniciar sesión"
        openModalLoginButton.addEventListener('click', () => {
            modalLogin.classList.remove('hidden');
        });

        // Cerrar el modalLogin
        closeModalLoginButton.addEventListener('click', () => {
            modalLogin.classList.add('hidden');
        });


        // Mostrar el modalLogin cuando se haga clic en "Registro"
        openModalRegisterButton.addEventListener('click', () => {
            modalRegister.classList.remove('hidden');
        });

        closeModalRegisterButton.addEventListener('click', () => {
            modalRegister.classList.add('hidden');
        });

        



        // Cerrar el modalLogin al hacer clic fuera del contenido del modalLogin
        modalLogin.addEventListener('click', (event) => {
            // Si el clic ocurre fuera del contenido del modalLogin, cerrar el modalLogin
            if (event.target === modalLogin) {
                modalLogin.classList.add('hidden');
            }
        });

        modalRegister.addEventListener('click', (event) => {
            // Si el clic ocurre fuera del contenido del modalLogin, cerrar el modalLogin
            if (event.target === modalRegister) {
                modalRegister.classList.add('hidden');
            }
        });