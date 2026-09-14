const formLogin = document.getElementById("formLogin");

if (formLogin) {
    formLogin.addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.getElementById("email").value.trim();
    const contrasena = document.getElementById("contrasena").value.trim();

    if (email === '' || contrasena  === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Completa todos los campos',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });    
        return;
    }


    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ingresa un correo electrónico válido',
            timer: 1500,
            color: '#096d45;',
            showConfirmButton: false,
        });

        return;
    }

    try {
        const formData = new FormData(e.target);
        formData.append("accion", "auth.login");

        const resp = await fetch("../../backend/APIS/apiUsuario.php", {
            method: "POST",
            body: formData
        });

        if (!resp.ok) {
            throw new Error(`El servidor respondió con el estado ${resp.status}`);
        }

        const data = await resp.json();

        if (data.exito) {
            sessionStorage.setItem('usuario_rol', data.rol);  
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Inicio de sesión exitoso',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });

        setTimeout(() => {
            
            if (data.rol === 'vecino') {
                window.location.href = "../vecino/panelVecino.php";
            } else {
                window.location.href = "../admin/panelAdmin.php";
            }
        }, 1500);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error,
                timer: 1500,
                color: '#096d45',
                showConfirmButton: false,
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de conexión',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        console.error(error);


    }

    });
}

const btnLogout = document.getElementById("btnLogout");

if (btnLogout) {
    btnLogout.addEventListener("click", async (e) => {
        e.preventDefault();

        const confirmacion = await Swal.fire({
            icon: 'warning',
            title: '¿Cerrar sesión?',
            showCancelButton: true,
            confirmButtonText: 'Cerrar sesión',
            cancelButtonText: 'Cancelar',
            color: '#096d45',
        });

        if (!confirmacion.isConfirmed) return;

        try {
            const formData = new FormData();
            formData.append("accion", "auth.logout");

            const resp = await fetch("../../backend/APIS/apiUsuario.php", {
                method: "POST",
                body: formData
            });

            const data = await resp.json();

            if (data.exito) {
                sessionStorage.removeItem('usuario_rol');
                window.location.href = "../usuarioVista/loginVista.html";
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error || 'No se pudo cerrar sesión',
                    color: '#096d45',
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error de conexion',
                color: '#096d45',
            });
            console.log(error);
        }
    });
}
