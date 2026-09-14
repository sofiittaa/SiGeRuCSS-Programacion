document.addEventListener("click", async (e) => {

    if (e.target.id === "btnNuevoCentro") {
        const { value: formValues } = await Swal.fire({
            title: 'Registrar nuevo centro de acopio',
            color: '#096d45',
            html:
                `<input id="swal-RUTdes" class="swal2-input" placeholder="RUT (máx. 9 dígitos)" maxlength="9">` +
                `<input id="swal-nomDes" class="swal2-input" placeholder="Nombre">` +
                `<input id="swal-capDes" class="swal2-input" placeholder="Capacidad">` +
                `<label style="display:block;margin-top:10px;">Hora apertura</label>` +
                `<input id="swal-horAperDes" type="time" class="swal2-input">` +
                `<label style="display:block;margin-top:10px;">Hora cierre</label>` +
                `<input id="swal-horCierDes" type="time" class="swal2-input">` +
                `<input id="swal-zonaDes" class="swal2-input" placeholder="Zona">`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Registrar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const RUTdes = document.getElementById('swal-RUTdes').value.trim();
                const nomDes = document.getElementById('swal-nomDes').value.trim();
                const capDes = document.getElementById('swal-capDes').value.trim();
                const horAperDes = document.getElementById('swal-horAperDes').value.trim();
                const horCierDes = document.getElementById('swal-horCierDes').value.trim();
                const zonaDes = document.getElementById('swal-zonaDes').value.trim();

                if (RUTdes === '' || nomDes === '' || capDes === '' || horAperDes === '' || horCierDes === '' || zonaDes === '') {
                    Swal.showValidationMessage('Completa todos los campos');
                    return false;
                }

                if (!/^\d+$/.test(RUTdes)) {
                    Swal.showValidationMessage('El RUT del destino debe contener solo números');
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

                return { RUTdes, nomDes, capDes, horAperDes, horCierDes, zonaDes };
            }
        });

        if (!formValues) return;

        try {
            const formData = new FormData();
            formData.append("accion", "centro.crear");
            formData.append("RUTdes", formValues.RUTdes);
            formData.append("nomDes", formValues.nomDes);
            formData.append("capDes", formValues.capDes);
            formData.append("horAperDes", formValues.horAperDes);
            formData.append("horCierDes", formValues.horCierDes);
            formData.append("zonaDes", formValues.zonaDes);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Centro de acopio registrado correctamente',
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
            formData.append("accion", "centro.borrar");
            formData.append("RUTdes", RUTdes);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
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
            formData.append("accion", "centro.actualizar");
            formData.append("RUTdes", RUTdes);
            formData.append("nomDes", formValues.nomDes);
            formData.append("capDes", formValues.capDes);
            formData.append("horAperDes", formValues.horAperDes);
            formData.append("horCierDes", formValues.horCierDes);
            formData.append("zonaDes", formValues.zonaDes);

            const resp = await fetch("../../backend/APIS/apiGestion.php", {
                method: "POST",
                body: formData
            });

            const data = JSON.parse(await resp.text());

            if (data.exito) {
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
