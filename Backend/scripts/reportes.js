function mostrarReporteGanancias() {
    fetch("../controllers/procesar_reporte_ganancias.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "error") {
                mostrarToast(data.message, "error");
                return;
            }

            const tablaReportes = document.getElementById("tablaReportes");
            tablaReportes.innerHTML = "";
            
            if (data.length === 0) {
                const row = document.createElement("tr");
                row.innerHTML = `<td colspan="3" class="text-center">No hay datos disponibles</td>`;
                tablaReportes.appendChild(row);
                return;
            }

            data.forEach(item => {
                const row = document.createElement("tr");
                const ganancia = item.ganancia !== null ? parseFloat(item.ganancia).toFixed(2) : "0.00";

                row.innerHTML = `
                    <td>${item.id_obra}</td>
                    <td>${item.titulo}</td>
                    <td>$${ganancia}</td>
                `;
                tablaReportes.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al cargar reporte", "error");
        });
}

function mostrarToast(mensaje, tipo) {
    const toastA = document.getElementById('toastAdvertencia');
    const toastMensaje = document.getElementById('toastMensaje');

    if (!toastA || !toastMensaje) return;

    toastMensaje.innerHTML = mensaje;

    if (tipo === "exito") {
        toastA.classList.remove("text-bg-danger");
        toastA.classList.add("text-bg-success");
    } else {
        toastA.classList.remove("text-bg-success");
        toastA.classList.add("text-bg-danger");
    }

    const toast = new bootstrap.Toast(toastA);
    toast.show();
}
