function mostrarBoletos() {
    fetch("/Backend/controllers/procesar_mostrar_boletos.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "error") {
                mostrarToast(data.message, "error");
                return;
            }

            const boletos = data;
            const tablaBoletos = document.getElementById("tablaBoletos");
            tablaBoletos.innerHTML = "";

            boletos.forEach(boleto => {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${boleto.id_boleto}</td>
                    <td>${boleto.id_usuario}</td>
                    <td>${boleto.id_asiento}</td>
                    <td>${boleto.id_obra}</td>
                    <td>${boleto.precio}</td>
                    <td>${boleto.fecha_compra}</td>
                    <td>${boleto.estado}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="modificar_mostrar(${boleto.id_boleto})" data-bs-toggle="tooltip" title="Modificar">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button class="btn btn-info btn-sm" onclick="detalle(${boleto.id_boleto})" data-bs-toggle="tooltip" title="Detalle">
                            <i class="fa-solid fa-file-zipper"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarBoleto(${boleto.id_boleto})" data-bs-toggle="tooltip" title="Eliminar">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                `;
                tablaBoletos.appendChild(row);
            });

            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (tooltipTrigger) {
                new bootstrap.Tooltip(tooltipTrigger);
            });
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al cargar boletos", "error");
        });
}

function cargarUsuarios() {
    fetch("/Backend/controllers/procesar_mostrar.php")
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                console.error("Error al cargar usuarios: " + data.message);
                return;
            }

            const selectAgregar = document.getElementById("formIdUsuario");
            const selectModificar = document.getElementById("modificarIdUsuario");

            if (selectAgregar) selectAgregar.innerHTML = '<option value="" selected disabled>Selecciona un usuario</option>';
            if (selectModificar) selectModificar.innerHTML = '<option value="" selected disabled>Selecciona un usuario</option>';

            data.forEach(usuario => {
                const opcion = document.createElement("option");
                opcion.value = usuario.id_miembro;
                opcion.textContent = `${usuario.id_miembro} - (${usuario.nombre})`;

                if (selectAgregar) selectAgregar.appendChild(opcion);
                if (selectModificar) selectModificar.appendChild(opcion.cloneNode(true));
            });
        })
        .catch(error => {
            console.error("Error cargando usuarios:", error);
        });
}

function cargarObras() {
    fetch("/Backend/controllers/procesar_mostrar_obras.php")
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                console.error("Error al cargar obras: " + data.message);
                return;
            }

            const selectAgregar = document.getElementById("formIdObra");
            const selectModificar = document.getElementById("modificarIdObra");

            if (selectAgregar) selectAgregar.innerHTML = '<option value="" selected disabled>Selecciona una obra</option>';
            if (selectModificar) selectModificar.innerHTML = '<option value="" selected disabled>Selecciona una obra</option>';

            data.forEach(obra => {
                const opcion = document.createElement("option");
                opcion.value = obra.id_obra;
                opcion.textContent = `${obra.id_obra} - (${obra.titulo})`;

                if (selectAgregar) selectAgregar.appendChild(opcion);
                if (selectModificar) selectModificar.appendChild(opcion.cloneNode(true));
            });
        })
        .catch(error => {
            console.error("Error cargando obras:", error);
        });
}

function cargarAsientos() {
    fetch("/Backend/controllers/procesar_mostrar_asientos.php")
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                console.error("Error al cargar asientos: " + data.message);
                return;
            }

            const selectAgregar = document.getElementById("formIdAsiento");
            const selectModificar = document.getElementById("modificarIdAsiento");

            if (selectAgregar) selectAgregar.innerHTML = '<option value="" selected disabled>Selecciona un asiento</option>';
            if (selectModificar) selectModificar.innerHTML = '<option value="" selected disabled>Selecciona un asiento</option>';

            data.forEach(asiento => {
                const opcion = document.createElement("option");
                opcion.value = asiento.id_asiento;
                const numero = asiento.numero_asiento || asiento.numero || "?";
                opcion.textContent = `Fila ${asiento.fila} - Asiento ${numero}`;

                if (selectAgregar) selectAgregar.appendChild(opcion);
                if (selectModificar) selectModificar.appendChild(opcion.cloneNode(true));
            });
        })
        .catch(error => {
            console.error("Error al cargar asientos:", error);
            mostrarToast("Error al cargar asientos", "error");
        });
}

function agregar(event) {
    event.preventDefault();

    const formulario = event.target;
    const formData = new FormData(formulario);

    fetch("/Backend/controllers/procesar_alta_boleto.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "exito") {
                document.getElementById("formAgregarBoleto").reset();

                mostrarBoletos();
                mostrarToast(data.message, "exito");
            } else {
                mostrarToast(data.message, "error");
            }
        })
        .catch(error => {
            console.error("Error al agregar boleto:", error);
            mostrarToast("Error al agregar boleto", "error");
        });
}

function eliminarBoleto(id) {
    const btnConfirmar = document.getElementById("confirmarEliminarBoleto");
    const newBtn = btnConfirmar.cloneNode(true);
    btnConfirmar.parentNode.replaceChild(newBtn, btnConfirmar);

    const modalConfirmacion = new bootstrap.Modal(document.getElementById("modalEliminarConfirmar"));
    modalConfirmacion.show();

    newBtn.addEventListener("click", () => {
        fetch("/Backend/controllers/procesar_baja_boleto.php", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id_boleto: id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "exito") {
                    mostrarBoletos();
                    mostrarToast(data.message, "exito");
                } else {
                    mostrarToast(data.message, "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                mostrarToast("Error al eliminar boleto", "error");
            });
        const modalEl = document.getElementById("modalEliminarConfirmar");
        const modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();
    });

}

function modificar(event) {
    event.preventDefault();

    const formulario = event.target;
    const formData = new FormData(formulario);
    const formDataObj = Object.fromEntries(formData.entries());

    fetch("/Backend/controllers/procesar_cambio_boleto.php", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formDataObj)
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "exito") {
                const modalEl = document.getElementById("modalModificarBoleto");
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                mostrarBoletos();
                mostrarToast(data.message, "exito");
            } else {
                mostrarToast(data.message, "error");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al modificar boleto", "error");
        });
}

function modificar_mostrar(id) {
    fetch(`/Backend/controllers/procesar_detalle_boleto.php?id_boleto=${id}`, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                mostrarToast(data.error, "error");
                return;
            }

            // Llenado de campos existentes
            document.getElementById("modificarId").value = data.id_boleto;
            document.getElementById("modificarIdUsuario").value = data.id_usuario;
            document.getElementById("modificarIdObra").value = data.id_obra;
            document.getElementById("modificarPrecio").value = data.precio;
            document.getElementById("modificarFechaCompra").value = data.fecha_compra;
            document.getElementById("modificarEstado").value = data.estado;

            document.getElementById("modificarIdAsiento").value = data.id_asiento;

            // Modal
            const modal = new bootstrap.Modal(
                document.getElementById("modalModificarBoleto")
            );
            modal.show();
        })
        .catch((error) => {
            mostrarToast("Error en fetch: " + error.message, "error");
        });
}

function detalle(id) {
    fetch(`/Backend/controllers/procesar_detalle_boleto.php?id_boleto=${id}`, {
        method: "GET"
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                mostrarToast(data.message, "error");
                return;
            }

            document.getElementById("detalleId").value = data.id_boleto;
            document.getElementById("detalleIdUsuario").value = data.id_usuario;
            document.getElementById("detalleEmail").value = data.email;

            document.getElementById("detalleIdAsiento").value = data.id_asiento;
            document.getElementById("detalleFila").value = data.fila;
            document.getElementById("detalleNumeroAsiento").value = data.numero_asiento;

            document.getElementById("detalleIdObra").value = data.id_obra;
            document.getElementById("detalleNombreObra").value = data.nombre_obra;
            document.getElementById("detalleAutor").value = data.autor;

            document.getElementById("detallePrecio").value = data.precio;
            document.getElementById("detalleFechaCompra").value = data.fecha_compra;
            document.getElementById("detalleEstado").value = data.estado;

            const modal = new bootstrap.Modal(document.getElementById("modalDetalleBoleto"));
            modal.show();
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al cargar detalles", "error");
        });
}


function mostrarToast(mensaje, tipo) {
    const toastA = document.getElementById('toastAdvertencia');
    const toastMensaje = document.getElementById('toastMensaje');
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

document.addEventListener("DOMContentLoaded", () => {
    mostrarBoletos();
    cargarUsuarios();
    cargarObras();
    cargarAsientos();
});
