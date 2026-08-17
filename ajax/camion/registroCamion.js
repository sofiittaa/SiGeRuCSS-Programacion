document.getElementById("formCamion").addEventListener("submit", async (e) => {
    e.preventDefault();

    const msg = document.getElementById("msg");
    const matricula = document.getElementById("matricula").value.trim();
    const capacidad = document.getElementById("capacidad").value.trim();

    if (matricula === '' || capacidad === '') {
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

    if (!/^[A-Za-z]{3}\d{4}$/.test(matricula)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La matricula debe tener 3 letras y 4 numeros',
            timer: 1500,
            color: '#096d45',
            showConfirmButton: false,
        });
        return;
    }

    if (isNaN(capacidad) || Number(capacidad) <= 0) {
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

    try {
        const formData = new FormData(e.target);
        formData.append("accion", "crear");

        const resp = await fetch("/SiGeRuCSS+/components/APIS/apiCamion.php", ({
            method: "POST",
            body: formData
        }));

        const texto = await resp.text();   
        console.log( texto);
        const data = JSON.parse(texto)
    
        if (data.ok) {
            e.target.reset();
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Camión registrado correctamente',
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
