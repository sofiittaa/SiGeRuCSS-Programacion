document.addEventListener("click", async (e) => {

    if (e.target.id === "btnNuevoEmpleado") {
        const { value: formValues } = await Swal.fire({
            title: 'Registrar nuevo empleado',
            color: '#096d45',
            html:
                `<input id="swal-cedula" class="swal2-input" placeholder="Cédula">` +
                `<input id="swal-nombre" class="swal2-input" placeholder="Nombre">` +
                `<input id="swal-apellido" class="swal2-input" placeholder="Apellido">` +
                `<input id="swal-email" type="email" class="swal2-input" placeholder="Correo electrónico">` +
                `<input id="swal-contrasena" type="password" class="swal2-input" placeholder="Contraseña">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Registrar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const cedula = document.getElementById('swal-cedula').value.trim();
                const nombre = document.getElementById('swal-nombre').value.trim();
                const apellido = document.getElementById('swal-apellido').value.trim();
                const email = document.getElementById('swal-email').value.trim();
                const contrasena = document.getElementById('swal-contrasena').value.trim();

                if (cedula === '' || nombre === '' || apellido === '' || email === '' || contrasena === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (!/^\d{8}$/.test(cedula)) {
                    Swal.showValidationMessage('La cédula debe tener 8 números');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre)) {
                    Swal.showValidationMessage('El nombre solo debe contener letras');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(apellido)) {
                    Swal.showValidationMessage('El apellido solo debe contener letras');
                    return false;
                }

                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    Swal.showValidationMessage('Ingresa un correo válido');
                    return false;
                }

                if (contrasena.length <= 5) {
                    Swal.showValidationMessage('Contraseña débil');
                    return false;
                }

                return { cedula, nombre, apellido, email, contrasena };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "empleado.crear");
            formData.append("cedula", formValues.cedula);
            formData.append("nombre", formValues.nombre);
            formData.append("apellido", formValues.apellido);
            formData.append("email", formValues.email);
            formData.append("contrasena", formValues.contrasena);

            const resp = await fetch("../../backend/APIS/apiUsuario.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Empleado registrado correctamente',
                    timer: 1500,
                    color: '#096d45',
                    showConfirmButton: false,
                }).then(() => window.location.reload());
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error || 'No se pudo registrar',
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
    }

    if (e.target.classList.contains("btn-eliminar")) {
        const cedula = e.target.dataset.cedula;

        const confirmacion = await Swal.fire({
            icon: 'warning',
            title: '¿Eliminar empleado?',
            text: 'Esta acción no se puede deshacer',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            color: '#096d45',
        });

        if (!confirmacion.isConfirmed) return;

        try {
            const formData = new FormData();
            formData.append("accion", "empleado.borrar");
            formData.append("cedula", cedula);

            const resp = await fetch("../../backend/APIS/apiUsuario.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminado',
                    text: 'Empleado eliminado correctamente',
                    timer: 1500,
                    color: '#096d45',
                    showConfirmButton: false,
                }).then(() => window.location.reload());
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error || 'No se pudo eliminar',
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
    }

    if (e.target.classList.contains("btn-editar")) {
        const btn = e.target;
        const cedula = btn.dataset.cedula;

        const { value: formValues } = await Swal.fire({
            title: 'Editar empleado',
            color: '#096d45',
            html:
                `<input id="swal-nombre" class="swal2-input" placeholder="Nombre" value="${btn.dataset.nombre}">` +
                `<input id="swal-apellido" class="swal2-input" placeholder="Apellido" value="${btn.dataset.apellido}">` +
                `<input id="swal-email" type="email" class="swal2-input" placeholder="Correo electrónico" value="${btn.dataset.email}">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const nombre = document.getElementById('swal-nombre').value.trim();
                const apellido = document.getElementById('swal-apellido').value.trim();
                const email = document.getElementById('swal-email').value.trim();

                if (nombre === '' || apellido === '' || email === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nombre)) {
                    Swal.showValidationMessage('El nombre solo debe contener letras');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(apellido)) {
                    Swal.showValidationMessage('El apellido solo debe contener letras');
                    return false;
                }

                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    Swal.showValidationMessage('Ingresa un correo válido');
                    return false;
                }

                return { nombre, apellido, email };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "usuario.actualizar");
            formData.append("cedula", cedula);
            formData.append("nombre", formValues.nombre);
            formData.append("apellido", formValues.apellido);
            formData.append("email", formValues.email);

            const resp = await fetch("../../backend/APIS/apiUsuario.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Empleado actualizado correctamente',
                    timer: 1500,
                    color: '#096d45',
                    showConfirmButton: false,
                }).then(() => window.location.reload());
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error || 'No se pudo actualizar',
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
    }
});
