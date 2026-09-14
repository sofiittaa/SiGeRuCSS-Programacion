document.addEventListener("click", async (e) => {

    if (e.target.id === "btnNuevoMaquinaria") {
        const { value: formValues } = await Swal.fire({
            title: 'Registrar nueva maquinaria',
            color: '#096d45',
            html:
                `<input id="swal-codigoActivo" class="swal2-input" placeholder="Código de activo">` +
                `<input id="swal-tipoMaquinaria" class="swal2-input" placeholder="Tipo de maquinaria">` +
                `<input id="swal-numeroSerie" class="swal2-input" placeholder="Número de serie">` +
                `<input id="swal-modelo" class="swal2-input" placeholder="Modelo">` +
                `<input id="swal-marca" class="swal2-input" placeholder="Marca">` +
                `<input id="swal-anofabricacion" class="swal2-input" placeholder="Año de fabricación">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Registrar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const codigoActivo = document.getElementById('swal-codigoActivo').value.trim();
                const tipoMaquinaria = document.getElementById('swal-tipoMaquinaria').value.trim();
                const numeroSerie = document.getElementById('swal-numeroSerie').value.trim();
                const modelo = document.getElementById('swal-modelo').value.trim();
                const marca = document.getElementById('swal-marca').value.trim();
                const anofabricacion = document.getElementById('swal-anofabricacion').value.trim();

                if (codigoActivo === '' || tipoMaquinaria === '' || numeroSerie === '' || modelo === '' || marca === '' || anofabricacion === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (!/^[A-Za-z0-9\s]+$/.test(codigoActivo)) {
                    Swal.showValidationMessage('El código de activo solo debe contener letras y números');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(tipoMaquinaria)) {
                    Swal.showValidationMessage('El tipo de maquinaria solo debe contener letras');
                    return false;
                }

                if (!/^[A-Za-z0-9\s]+$/.test(numeroSerie)) {
                    Swal.showValidationMessage('El número de serie solo debe contener letras y números');
                    return false;
                }

                if (!/^\d{4}$/.test(anofabricacion)) {
                    Swal.showValidationMessage('El año de fabricación debe ser un número de 4 dígitos');
                    return false;
                }

                return { codigoActivo, tipoMaquinaria, numeroSerie, modelo, marca, anofabricacion };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "maquinaria.crear");
            formData.append("codigoActivo", formValues.codigoActivo);
            formData.append("tipoMaquinaria", formValues.tipoMaquinaria);
            formData.append("numeroSerie", formValues.numeroSerie);
            formData.append("modelo", formValues.modelo);
            formData.append("marca", formValues.marca);
            formData.append("anofabricacion", formValues.anofabricacion);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Maquinaria registrada correctamente',
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
        const codigoActivo = e.target.dataset.codigoactivo;

        const confirmacion = await Swal.fire({
            icon: 'warning',
            title: '¿Eliminar maquinaria?',
            text: 'Esta acción no se puede deshacer',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            color: '#096d45',
        });

        if (!confirmacion.isConfirmed) return;

        try {
            const formData = new FormData();
            formData.append("accion", "maquinaria.borrar");
            formData.append("codigoActivo", codigoActivo);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminado',
                    text: 'Maquinaria eliminada correctamente',
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
        const codigoActivo = btn.dataset.codigoactivo;

        const { value: formValues } = await Swal.fire({
            title: 'Editar maquinaria',
            color: '#096d45',
            html:
                `<input id="swal-tipoMaquinaria" class="swal2-input" placeholder="Tipo de maquinaria" value="${btn.dataset.tipomaquinaria}">` +
                `<input id="swal-numeroSerie" class="swal2-input" placeholder="Número de serie" value="${btn.dataset.numeroserie}">` +
                `<input id="swal-modelo" class="swal2-input" placeholder="Modelo" value="${btn.dataset.modelo}">` +
                `<input id="swal-marca" class="swal2-input" placeholder="Marca" value="${btn.dataset.marca}">` +
                `<input id="swal-anofabricacion" class="swal2-input" placeholder="Año de fabricación" value="${btn.dataset.anofabricacion}">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const tipoMaquinaria = document.getElementById('swal-tipoMaquinaria').value.trim();
                const numeroSerie = document.getElementById('swal-numeroSerie').value.trim();
                const modelo = document.getElementById('swal-modelo').value.trim();
                const marca = document.getElementById('swal-marca').value.trim();
                const anofabricacion = document.getElementById('swal-anofabricacion').value.trim();

                if (tipoMaquinaria === '' || numeroSerie === '' || modelo === '' || marca === '' || anofabricacion === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(tipoMaquinaria)) {
                    Swal.showValidationMessage('El tipo de maquinaria solo debe contener letras');
                    return false;
                }

                if (!/^\d{4}$/.test(anofabricacion)) {
                    Swal.showValidationMessage('El año de fabricación debe ser un número de 4 dígitos');
                    return false;
                }

                return { tipoMaquinaria, numeroSerie, modelo, marca, anofabricacion };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "maquinaria.actualizar");
            formData.append("codigoActivo", codigoActivo);
            formData.append("tipoMaquinaria", formValues.tipoMaquinaria);
            formData.append("numeroSerie", formValues.numeroSerie);
            formData.append("modelo", formValues.modelo);
            formData.append("marca", formValues.marca);
            formData.append("anofabricacion", formValues.anofabricacion);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Maquinaria actualizada correctamente',
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
