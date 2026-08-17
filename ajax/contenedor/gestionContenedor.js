document.addEventListener("click", async (e) => {

    if (e.target.classList.contains("btn-eliminar")) {
        const idCont = e.target.dataset.idcont;

        const confirmacion = await Swal.fire({
            icon: 'warning',
            title: '¿Eliminar contenedor?',
            text: 'Esta acción no se puede deshacer',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            color: '#096d45',
        });

        if (!confirmacion.isConfirmed) return;

        try {
            const formData = new FormData();
            formData.append("accion", "borrar");
            formData.append("idCont", idCont);

            const resp = await fetch("/SiGeRuCSS+/components/APIS/apiContenedor.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminado',
                    text: 'Contenedor eliminado correctamente',
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
        const idCont = btn.dataset.idcont;

        const { value: formValues } = await Swal.fire({
            title: 'Editar contenedor',
            color: '#096d45',
            html:
                `<input id="swal-zona" class="swal2-input" placeholder="Zona" value="${btn.dataset.zona}">` +
                `<input id="swal-capacidad" class="swal2-input" placeholder="Capacidad" value="${btn.dataset.capacidad}">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const zona = document.getElementById('swal-zona').value.trim();
                const capacidad = document.getElementById('swal-capacidad').value.trim();

                if (zona === '' || capacidad === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(zona)) {
                    Swal.showValidationMessage('Debes ingresar letras en la zona del contenedor');
                    return false;
                }

                if (isNaN(capacidad) || Number(capacidad) <= 0) {
                    Swal.showValidationMessage('La capacidad debe ser un número mayor a 0');
                    return false;
                }

                return { zona, capacidad };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "modificar");
            formData.append("idCont", idCont);
            formData.append("zona", formValues.zona);
            formData.append("capacidad", formValues.capacidad);

            const resp = await fetch("/SiGeRuCSS+/components/APIS/apiContenedor.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Contenedor actualizado correctamente',
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
