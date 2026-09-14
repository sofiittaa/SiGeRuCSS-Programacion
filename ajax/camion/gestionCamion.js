document.addEventListener("click", async (e) => {

    if (e.target.id === "btnNuevoCamion") {
        const { value: formValues } = await Swal.fire({
            title: 'Registrar nuevo camión',
            color: '#096d45',
            html:
                `<input id="swal-matricula" class="swal2-input" placeholder="Matrícula">` +
                `<input id="swal-capacidad" class="swal2-input" placeholder="Capacidad">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Registrar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const matriculaInput = document.getElementById('swal-matricula').value.trim();
                const capacidad = document.getElementById('swal-capacidad').value.trim();

                if (matriculaInput === '' || capacidad === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (!/^[A-Za-z]{3}\s?\d{4}$/.test(matriculaInput)) {
                    Swal.showValidationMessage('La matricula debe tener 3 letras y 4 numeros (ej: ABH 5149)');
                    return false;
                }

                if (isNaN(capacidad) || Number(capacidad) <= 0) {
                    Swal.showValidationMessage('La capacidad debe ser un número mayor a 0');
                    return false;
                }

                const matricula = matriculaInput.replace(/\s/g, '').toUpperCase();

                return { matricula, capacidad };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "camion.crear");
            formData.append("matricula", formValues.matricula);
            formData.append("capacidad", formValues.capacidad);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Camión registrado correctamente',
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
        const matricula = e.target.dataset.matricula;

        const confirmacion = await Swal.fire({
            icon: 'warning',
            title: '¿Eliminar camión?',
            text: 'Esta acción no se puede deshacer',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            color: '#096d45',
        });

        if (!confirmacion.isConfirmed) return;

        try {
            const formData = new FormData();
            formData.append("accion", "camion.borrar");
            formData.append("matricula", matricula);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminado',
                    text: 'Camión eliminado correctamente',
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
        const matricula = btn.dataset.matricula;

        const { value: formValues } = await Swal.fire({
            title: 'Editar camión',
            color: '#096d45',
            html:
                `<input id="swal-matricula" class="swal2-input" value="${matricula}" disabled>` +
                `<input id="swal-capacidad" class="swal2-input" placeholder="Capacidad" value="${btn.dataset.capacidad}">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const capacidad = document.getElementById('swal-capacidad').value.trim();

                if (capacidad === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (isNaN(capacidad) || Number(capacidad) <= 0) {
                    Swal.showValidationMessage('La capacidad debe ser un número mayor a 0');
                    return false;
                }

                return { capacidad };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "camion.actualizar");
            formData.append("matricula", matricula);
            formData.append("capacidad", formValues.capacidad);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Camión actualizado correctamente',
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
