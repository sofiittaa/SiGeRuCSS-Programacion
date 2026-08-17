console.log('Rol leído de sessionStorage:', sessionStorage.getItem('usuario_rol'));

document.addEventListener("DOMContentLoaded", () => {
    const rol = sessionStorage.getItem('usuario_rol');
    const menu = document.getElementById('menuOpciones');

    if (!rol) {
        window.location.href = "/SiGeRuCSS+/components/vista/usuarioVista/loginVista.html";
        return;
    }

    let html = '';

    if (rol === 'admin') {
        if (rol === 'admin') {
            html += `
    <a class="bloque-menu" href="../usuarioVista/listarUsuVista.php">
        <p class="text-menu2">Usuarios</p>
        <p class="text-menu">Registra nuevos usuarios, actualizalos o eliminalos</p>
    </a>
    <a class="bloque-menu" href="../camionVista/listarCamVista.php">
        <p class="text-menu2">Camiones</p>
        <p class="text-menu">Registra nuevos camiones, actualizalos o eliminalos</p>
    </a>
    <a class="bloque-menu" href="../contenedorVista/listarContVista.php">
        <p class="text-menu2">Contenedores</p>
        <p class="text-menu">Registra nuevos contenedores, actualizalos o eliminalos</p>
    </a>
    <a class="bloque-menu" href="../centroAcoVista/listarCen.php">
        <p class="text-menu2">Centros de acopio</p>
        <p class="text-menu">Registra nuevos centros de acopio, actualizalos o eliminalos</p>
    </a>
    <a class="bloque-menu" href="../empleadoVista/listarEmpVista.php">
        <p class="text-menu2">Empleados</p>
        <p class="text-menu">Registra nuevos empleados, actualizalos o eliminalos</p>
    </a>`
        }
    } else if (rol === 'empleado') {
        html += `<a class="registros"    href="../camionVista/listarCamVista.php">Ver camiones de mi cuadrilla</a><br>`;
        html += `<a class="registros" href="../contenedorVista/listarContVista.php">Gestionar contenedores</a><br>`;
        html += `<a class="registros" href="../centroAcoVista/listarCen.php">Ver centros de acopio</a><br>`;
    } else {
        html += `<p class="text-menu">Próximamente: reportar incidencias y ver mapa de contenedores</p>`;
    }

    menu.innerHTML = html;
});