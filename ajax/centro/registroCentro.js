document.getElementById("formCentro").addEventListener("submit", async (e) => {
    e.preventDefault();

    const RUTdes = document.getElementById("RUTdes").value.trim();
    const nomDes = document.getElementById("nomDes").value.trim();
    const capDes = document.getElementById("capDes").value.trim();
    const horAperDes = document.getElementById("horAperDes").value.trim();
    const horCierDes = document.getElementById("horCierDes").value.trim();
    const zonaDes = document.getElementById("zonaDes").value.trim();

    if (RUTdes === '' || nomDes === '' || capDes === '' || horAperDes === '' || horCierDes === '' || zonaDes === '') {
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

    if (!/^\d+$/.test(RUTdes)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El RUT del destino debe contener solo números',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(nomDes)) {
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

    if (isNaN(capDes) || Number(capDes) <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La capacidad debe ser un número mayor a 0',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(zonaDes)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La zona solo debe contener letras',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (horCierDes <= horAperDes) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La hora de cierre debe ser posterior a la hora de apertura',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    try {
        const formData = new FormData(e.target);
        formData.append("accion", "crear");

        const resp = await fetch("/SiGeRuCSS+/components/APIS/apiCentro.php", ({
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
                text: 'Centro de acopio registrado correctamente',
                timer: 1500,
                color: '#096d45',
                showConfirmButton: false,
            });

            setTimeout(() => {
                window.location.href = "/SiGeRuCSS+/components/vista/admin/panelAdmin.html";
            }, 2000);
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
