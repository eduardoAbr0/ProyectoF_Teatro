(function () {
    function validarSesion() {
        fetch("/Backend/controllers/check_session.php?t=" + new Date().getTime())
            .then(response => response.json())
            .then(data => {
                if (data.status !== "autenticado") {
                    window.location.href = "/login";
                }
            });
    }

    validarSesion();

    document.addEventListener("DOMContentLoaded", () => {
        const btnCerrarSesion = document.getElementById("btnCerrarSesion");
        if (btnCerrarSesion) {
            btnCerrarSesion.addEventListener("click", (e) => {
                e.preventDefault();
                cerrarSesion();
            });
        }
    });
})();

function cerrarSesion() {
    fetch("/Backend/controllers/logout.php")
        .then(res => res.json())
        .then(data => {
            if (data.status === "exito") {
                window.location.href = "/index";
            }
        });
}
