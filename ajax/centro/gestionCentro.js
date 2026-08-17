document.addEventListener("click", async (e) => {

    if (e.target.classList.contains("btn-eliminar")) {
        const RUTdes = e.target.dataset.rutdes;

        const confirmacion = await Swal.fire({
            icon: 'warning',
            title: '¿Eliminar centro de acopio?',
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
            formData.append("RUTdes", RUTdes);

            const resp = await fetch("/SiGeRuCSS+/components/APIS/apiCentro.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminado',
                    text: 'Centro de acopio eliminado correctamente',
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
        const RUTdes = btn.dataset.rutdes;

        const { value: formValues } = await Swal.fire({
            title: 'Editar centro de acopio',
            color: '#096d45',
            html:
                `<input id="swal-nomDes" class="swal2-input" placeholder="Nombre" value="${btn.dataset.nomdes}">` +
                `<input id="swal-capDes" class="swal2-input" placeholder="Capacidad" value="${btn.dataset.capdes}">` +
                `<label style="display:block;margin-top:10px;">Hora apertura</label>` +
                `<input id="swal-horAperDes" type="time" class="swal2-input" value="${btn.dataset.horaperdes}">` +
                `<label style="display:block;margin-top:10px;">Hora cierre</label>` +
                `<input id="swal-horCierDes" type="time" class="swal2-input" value="${btn.dataset.horcierdes}">` +
                `<input id="swal-zonaDes" class="swal2-input" placeholder="Zona" value="${btn.dataset.zonades}">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const nomDes = document.getElementById('swal-nomDes').value.trim();
                const capDes = document.getElementById('swal-capDes').value.trim();
                const horAperDes = document.getElementById('swal-horAperDes').value.trim();
                const horCierDes = document.getElementById('swal-horCierDes').value.trim();
                const zonaDes = document.getElementById('swal-zonaDes').value.trim();

                if (nomDes === '' || capDes === '' || horAperDes === '' || horCierDes === '' || zonaDes === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nomDes)) {
                    Swal.showValidationMessage('El nombre solo debe contener letras');
                    return false;
                }

                if (isNaN(capDes) || Number(capDes) <= 0) {
                    Swal.showValidationMessage('La capacidad debe ser un número mayor a 0');
                    return false;
                }

                if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(zonaDes)) {
                    Swal.showValidationMessage('La zona solo debe contener letras');
                    return false;
                }

                if (horCierDes <= horAperDes) {
                    Swal.showValidationMessage('La hora de cierre debe ser posterior a la hora de apertura');
                    return false;
                }

                return { nomDes, capDes, horAperDes, horCierDes, zonaDes };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "modificar");
            formData.append("RUTdes", RUTdes);
            formData.append("nomDes", formValues.nomDes);
            formData.append("capDes", formValues.capDes);
            formData.append("horAperDes", formValues.horAperDes);
            formData.append("horCierDes", formValues.horCierDes);
            formData.append("zonaDes", formValues.zonaDes);

            const resp = await fetch("/SiGeRuCSS+/components/APIS/apiCentro.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Centro de acopio actualizado correctamente',
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
