document.getElementById("formMaquinaria").addEventListener("submit", async (e) => {
    e.preventDefault();

    const codigoActivo = document.getElementById("codigoActivo").value.trim();
    const tipoMaquinaria = document.getElementById("tipoMaquinaria").value.trim();
    const numeroSerie = document.getElementById("numeroSerie").value.trim();
    const modelo = document.getElementById("modelo").value.trim();
    const marca = document.getElementById("marca").value.trim();
    const anofabricacion = document.getElementById("anofabricacion").value.trim();

    if (codigoActivo === '' || tipoMaquinaria === '' || numeroSerie === '' || modelo === '' || marca === '' || anofabricacion === '') {
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

    if (!/^[A-Za-z0-9\s]+$/.test(codigoActivo)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El código de activo solo debe contener letras y números',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(tipoMaquinaria)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El tipo de maquinaria solo debe contener letras',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (!/^[A-Za-z0-9\s]+$/.test(numeroSerie)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El número de serie solo debe contener letras y números',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (!/^\d{4}$/.test(anofabricacion)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El año de fabricación debe ser un número de 4 dígitos',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    try {
        const formData = new FormData(e.target);
        formData.append("accion", "maquinaria.crear");

        const resp = await fetch("../../backend/APIS/apiGestion.php", ({
            method: "POST",
            body: formData
        }));

        const texto = await resp.text();
        console.log(texto);
        const data = JSON.parse(texto);

        if (data.exito) {
            e.target.reset();
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Maquinaria registrada correctamente',
                timer: 1500,
                color: '#096d45',
                showConfirmButton: false,
            });

            setTimeout(() => {
                window.location.href = "../admin/panelAdmin.php";
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
