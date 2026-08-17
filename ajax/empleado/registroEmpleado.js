document.getElementById("formEmpleado").addEventListener("submit", async (e) => {
    e.preventDefault();

    const cedula = document.getElementById("cedula").value.trim();
    const nombre = document.getElementById("nombre").value.trim();
    const apellido = document.getElementById("apellido").value.trim();
    const email = document.getElementById("email").value.trim();
    const contrasena = document.getElementById("contrasena").value.trim();

    if (cedula === '' || nombre === '' || apellido === '' || email === '' || contrasena === '') {
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

    if (!/^\d{8}$/.test(cedula)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La cedula debe tener 8 numeros',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El nombre solo debe contener letras',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(apellido)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El apellido solo debe contener letras',
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
            text: 'Ingresa un correo válido',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (contrasena.length <= 5) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Contraseña debil',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    try {
        const formData = new FormData(e.target);
        formData.append("accion", "crearEmpleado");

        const resp = await fetch("/SiGeRuCSS+/components/APIS/apiUsuario.php", ({
            method: "POST",
            body: formData
        }));

        const texto = await resp.text();
        console.log(texto);
        const data = JSON.parse(texto);

        if (data.ok) {
            e.target.reset();
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Empleado registrado correctamente',
                timer: 1500,
                color: '#096d45',
                showConfirmButton: false,
            });

            setTimeout(() => {
                window.location.href = "/SiGeRuCSS+/components/vista/empleadoVista/listarEmpVista.php";
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
            text: 'Error de conexion',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        console.log(error);
    }
});
