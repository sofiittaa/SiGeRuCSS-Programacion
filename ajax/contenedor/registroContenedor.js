document.getElementById("formCont").addEventListener("submit", async (e) => {
    e.preventDefault();

    const msg = document.getElementById("msg");
    const capacidad = document.getElementById("capacidad").value.trim();
    const zona = document.getElementById("zona").value.trim();

    if ( capacidad === '' || zona === '') {
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
    
    if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(zona)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Debes ingresar letras en la zona del contenedor',
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

        const resp = await fetch("/SiGeRuCSS+/components/APIS/apiContenedor.php", ({
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
                text: 'Contenedor registrado correctamente',
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


