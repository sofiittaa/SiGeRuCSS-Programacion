document.addEventListener("DOMContentLoaded", () => {
    const rol = sessionStorage.getItem('usuario_rol');

    if (!rol) {
        window.location.href = "../usuarioVista/loginVista.html";
        return;
    }

    const params = new URLSearchParams(window.location.search);
    if (params.get('no_autorizado')) {
        Swal.fire({
            icon: 'error',
            title: 'No tenés permiso',
            text: 'No podés acceder a esa sección',
            color: '#096d45',
        });
        window.history.replaceState({}, '', window.location.pathname);
    }
});
