function mostrarObras() {
    fetch("../controllers/procesar_mostrar_obras.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "error") {
                mostrarToast(data.message, "error");
                return;
            }

            //console.log(data);

            const obras = data;
            const tablaObras = document.getElementById("tablaObras");
            tablaObras.innerHTML = "";

            obras.forEach(obra => {
                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${obra.id_obra}</td>
                    <td>${obra.titulo}</td>
                    <td>${obra.autor}</td>
                    <td>${obra.tipo}</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="verAsientos(${obra.id_obra}, '${obra.titulo}')" data-bs-toggle="tooltip" title="Ver Asientos">
                            <i class="fa-solid fa-chair"></i>
                        </button>
                        <button class="btn btn-warning btn-sm" onclick="modificar_mostrar(${obra.id_obra})" data-bs-toggle="tooltip" title="Modificar">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                        <button class="btn btn-info btn-sm" onclick="detalle(${obra.id_obra})" data-bs-toggle="tooltip" title="Detalle">
                            <i class="fa-solid fa-file-zipper"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarObra(${obra.id_obra})" data-bs-toggle="tooltip" title="Eliminar">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                `;
                tablaObras.appendChild(row);
            });

            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (tooltipTrigger) {
                new bootstrap.Tooltip(tooltipTrigger);
            });
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al cargar obras", "error");
        });
}

function agregar(event) {
    event.preventDefault();

    const formulario = event.target;
    const formData = new FormData(formulario);

    fetch("../../backend/controllers/procesar_alta_obra.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "exito") {
                document.getElementById("formAgregarObra").reset();

                mostrarObras();
                mostrarToast(data.message, "exito");
            } else {
                mostrarToast(data.message, "error");
            }
        });
}

function eliminarObra(id) {
    const btnConfirmar = document.getElementById("confirmarEliminarObra");
    const newBtn = btnConfirmar.cloneNode(true);
    btnConfirmar.parentNode.replaceChild(newBtn, btnConfirmar);

    newBtn.addEventListener("click", () => {
        fetch("../../Backend/controllers/procesar_baja_obra.php", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id_obra: id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "exito") {
                    mostrarObras();
                    mostrarToast(data.message, "exito");
                } else {
                    mostrarToast(data.message, "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                mostrarToast("Error al eliminar obra", "error");
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

    fetch("../../Backend/controllers/procesar_cambio_obra.php", {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formDataObj)
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "exito") {
                const modalEl = document.getElementById("modalModificarObra");
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                mostrarObras();
                mostrarToast(data.message, "exito");
            } else {
                mostrarToast(data.message, "error");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mostrarToast("Error al modificar obra", "error");
        });
}

function modificar_mostrar(id) {
    fetch(`../controllers/procesar_detalle_obra.php?id_obra=${id}`, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                mostrarToast(data.error, "error");
                return;
            }
            
            //console.log(data);

            // Llenado de campos existentes
            document.getElementById("modificarId").value = data.id_obra;
            document.getElementById("modificarTitulo").value = data.titulo;
            document.getElementById("modificarAutor").value = data.autor;
            if(data.tipo === ""){
                document.getElementById("modificarTipo").value = "Drama";
            }else{
                document.getElementById("modificarTipo").value = data.tipo;
            }
            document.getElementById("modificarNumActos").value = data.num_actos;
            document.getElementById("modificarAnio").value = data.anio_presentacion;
            document.getElementById("modificarProductor").value = data.productor;
            if(data.temporada === ""){
                document.getElementById("modificarTemporada").value = "Primavera";
            }else{
                document.getElementById("modificarTemporada").value = data.temporada;
            }
            document.getElementById("modificarDescripcion").value = data.descripcion;

            // Modal
            const modal = new bootstrap.Modal(
                document.getElementById("modalModificarObra")
            );
            modal.show();
        })
        .catch((error) => {
            mostrarToast("Error en fetch: " + error.message, "error");
        });
}

function detalle(id) {
    fetch(`../../Backend/controllers/procesar_detalle_obra.php?id_obra=${id}`, {
        method: "GET"
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                mostrarToast(data.message, "error");
                return;
            }

            document.getElementById("detalleId").value = data.id_obra;
            document.getElementById("detalleTitulo").value = data.titulo;
            document.getElementById("detalleAutor").value = data.autor;
            document.getElementById("detalleTipo").value = data.tipo;
            document.getElementById("detalleNumActos").value = data.num_actos;
            document.getElementById("detalleAnio").value = data.anio_presentacion;
            document.getElementById("detalleProductor").value = data.productor;
            document.getElementById("detalleTemporada").value = data.temporada;
            document.getElementById("detalleDescripcion").value = data.descripcion;

            const modal = new bootstrap.Modal(document.getElementById("modalDetalleObra"));
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

