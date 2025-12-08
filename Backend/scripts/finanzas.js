function mostrarFinanzas() {
    fetch("/Backend/controllers/procesar_mostrar_finanzas.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "error") {
                mostrarToast(data.message, "error");
                return;
            }

            const finanzas = data;
            const tablaFinanzas = document.getElementById("tablaFinanzas");
            tablaFinanzas.innerHTML = "";

            finanzas.forEach(finanza => {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${finanza.id_finanza}</td>
                    <td>${finanza.fecha}</td>
                    <td>${finanza.tipo}</td>
                    <td>${finanza.concepto}</td>
                    <td>$${finanza.monto}</td>
                    <td>${finanza.id_obra ? finanza.id_obra : 'N/A'}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="modificar_mostrar(${finanza.id_finanza})" data-bs-toggle="tooltip" title="Modificar">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarFinanza(${finanza.id_finanza})" data-bs-toggle="tooltip" title="Eliminar">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                `;
                tablaFinanzas.appendChild(row);
            });

            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (tooltipTrigger) {
                new bootstrap.Tooltip(tooltipTrigger);
            });
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al cargar finanzas", "error");
        });
}

function agregar(event) {
    event.preventDefault();

    const formulario = event.target;
    const formData = new FormData(formulario);

    fetch("/Backend/controllers/procesar_alta_finanza.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "exito") {
                document.getElementById("formAgregarFinanza").reset();
                const modalEl = document.getElementById("modalAgregarFinanza");
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                mostrarFinanzas();
                mostrarToast(data.message, "exito");
            } else {
                mostrarToast(data.message, "error");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al agregar finanza", "error");
        });
}

function eliminarFinanza(id) {
    const modalConfirmacion = new bootstrap.Modal(document.getElementById("modalEliminarConfirmarFinanza"));
    modalConfirmacion.show();

    const btnConfirmar = document.getElementById("confirmarEliminarFinanza");
    const newBtn = btnConfirmar.cloneNode(true);
    btnConfirmar.parentNode.replaceChild(newBtn, btnConfirmar);

    newBtn.addEventListener("click", () => {
        fetch("/Backend/controllers/procesar_baja_finanza.php", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id_finanza: id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "exito") {
                    mostrarFinanzas();
                    mostrarToast(data.message, "exito");
                } else {
                    mostrarToast(data.message, "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                mostrarToast("Error al eliminar finanza", "error");
            });
        modalConfirmacion.hide();
    });
}

function modificar(event) {
    event.preventDefault();

    const formulario = event.target;
    const formData = new FormData(formulario);
    const formDataObj = Object.fromEntries(formData.entries());

    //console.log(formDataObj);

    fetch("/Backend/controllers/procesar_cambio_finanza.php", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formDataObj)
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "exito") {
                const modalEl = document.getElementById("modalModificarFinanza");
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                mostrarFinanzas();
                mostrarToast(data.message, "exito");
            } else {
                mostrarToast(data.message, "error");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al modificar finanza", "error");
        });
}

function modificar_mostrar(id) {
    fetch(`/Backend/controllers/procesar_detalle_finanza.php?id_finanza=${id}`, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                mostrarToast(data.error, "error");
                return;
            }

            console.log(data.id_obra);

            document.getElementById("modificarId").value = data.id_finanza;
            document.getElementById("modificarFecha").value = data.fecha;
            document.getElementById("modificarTipo").value = data.tipo;
            document.getElementById("modificarConcepto").value = data.concepto;
            document.getElementById("modificarMonto").value = data.monto;
            document.getElementById("modificarObra").value = data.id_obra === null ? "seleccion" : data.id_obra;

            const modal = new bootstrap.Modal(document.getElementById("modalModificarFinanza"));
            modal.show();
        })
        .catch((error) => {
            mostrarToast("Error en fetch: " + error.message, "error");
        });
}

function mostrarToast(mensaje, tipo) {
    const toastA = document.getElementById('toastAdvertencia');
    const toastMensaje = document.getElementById('toastMensaje');

    toastMensaje.innerHTML = mensaje;

    if (toastA) {
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
}

function cargarObras() {
    fetch("/Backend/controllers/procesar_mostrar_obras.php")
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                console.error("Error al cargar obras: " + data.message);
                return;
            }

            const selectAgregar = document.getElementById("selectObraAgregar");
            const selectModificar = document.getElementById("modificarObra");

            selectAgregar.innerHTML = '<option value="seleccion">Selecciona una obra</option>';
            selectModificar.innerHTML = '<option value="seleccion">Selecciona una obra</option>';

            data.forEach(obra => {
                const opcionObra = document.createElement("option");
                opcionObra.value = obra.id_obra;
                opcionObra.textContent = obra.id_obra;

                selectAgregar.appendChild(opcionObra);
                selectModificar.appendChild(opcionObra.cloneNode(true));
            });
        })
        .catch(error => {
            console.error("Error:", error);
        });
}
