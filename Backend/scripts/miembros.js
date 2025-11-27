function mostrarMiembros() {
  fetch("../controllers/procesar_mostrar.php")
    .then((response) => response.json())
    .then((data) => {

      if (data.status === "error") {
        mostrarToast(data.message, "error");
        return;
      }

      //console.log("Datos recibidos:", data);

      const miembros = data;
      const divMiembros = document.getElementById("mostrarMiembros");

      eliminar_toltips();

      divMiembros.innerHTML = "";

      const row = document.createElement("div");
      row.className = "row pb-4 pt-4 align-items-center";
      divMiembros.appendChild(row);

      for (const m of miembros) {
        //console.log("Miembro individual:", m);

        // Crear elementos dentro del ciclo
        const cardCol = document.createElement("div");
        cardCol.className = "col-lg-3 col-md-4 col-12 pb-4 pt-3";
        const card = document.createElement("div");
        card.className = "card";
        const cardBody = document.createElement("div");
        cardBody.className = "card-body";

        // Imagen de perfil
        const cardImg = document.createElement("img");
        cardImg.className = "card-img-top";
        cardImg.src = "../../Frontend/assets/img/image.png";

        const title = document.createElement("h5");
        title.className = "card-title";
        const cardText = document.createElement("p");
        cardText.className = "card-text";

        // Botones de modificacion
        //...BTN CAMBIOS
        const iconCambio = document.createElement("i");
        iconCambio.className = "fa-solid fa-gear";
        const btnModificar = document.createElement("i");
        btnModificar.className = "btn btn-warning ms-1";
        btnModificar.setAttribute("data-bs-toggle", "tooltip");
        btnModificar.title = "Modificar";
        btnModificar.setAttribute("data-id", m.id_miembro);

        btnModificar.addEventListener("click", function () {
          modificar_mostrar(this.dataset.id);
        });

        btnModificar.appendChild(iconCambio);
        new bootstrap.Tooltip(btnModificar);

        //...BTN ELIMINAR
        const iconEliminar = document.createElement("i");
        iconEliminar.className = "fa-solid fa-trash";
        const btnEliminar = document.createElement("button");
        btnEliminar.className = "btn btn-danger ms-1";
        btnEliminar.setAttribute("data-bs-toggle", "tooltip");
        btnEliminar.title = "Eliminar";
        btnEliminar.setAttribute("data-id", m.id_miembro);

        btnEliminar.addEventListener("click", function () {
          eliminar(this.dataset.id);
        });

        btnEliminar.appendChild(iconEliminar);
        new bootstrap.Tooltip(btnEliminar);

        //...BTN DETALLES
        const iconDetalle = document.createElement("i");
        iconDetalle.className = "fa-solid fa-file-zipper";
        const btnDetalle = document.createElement("button");
        btnDetalle.className = "btn btn-info ms-1";
        btnDetalle.setAttribute("data-bs-toggle", "tooltip");
        btnDetalle.setAttribute("data-id", m.id_miembro);

        btnDetalle.addEventListener("click", function () {
          detalle(this.dataset.id);
        });

        btnDetalle.title = "Detalle";
        btnDetalle.appendChild(iconDetalle);
        new bootstrap.Tooltip(btnDetalle);

        //Lista para botones
        const lista = document.createElement("ul");
        lista.className = "list-group list-group-flush";
        const elementosLista = document.createElement("li");
        elementosLista.className = "list-group-item";

        // Asignacion de los botones estaticos a elemento de lista
        elementosLista.appendChild(btnModificar);
        elementosLista.appendChild(btnEliminar);
        elementosLista.appendChild(btnDetalle);

        // Elemento de lista agregado en la misma
        lista.appendChild(elementosLista);

        // Asignar datos
        title.textContent = `ID: ${m.id_miembro}`;
        cardText.innerHTML = `Nombre: ${m.nombre} <br> Primer Apellido: ${m.primer_apellido} <br> Segundo Apellido: ${m.segundo_apellido}`;

        // Estructura
        card.appendChild(cardImg);
        card.appendChild(cardBody);
        card.appendChild(lista);
        cardBody.appendChild(title);
        cardBody.appendChild(cardText);
        cardCol.appendChild(card);
        row.appendChild(cardCol);
      }
    });
}

function agregar(event) {
  event.preventDefault();

  const formulario = event.target;
  const formData = new FormData(formulario);

  fetch("../../backend/controllers/procesar_alta.php", {
    method: "POST",
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === "exito") {
        document.getElementById("formAgregarMiembro").reset();

        mostrarMiembros();
        mostrarToast(data.message, "exito");
      } else {
        mostrarToast(data.message, "error");
      }
    });
}

function mostrarToast(mensaje, tipo) {

  const toastA = document.getElementById('toastAdvertencia');
  const toastMensaje = document.getElementById('toastMensaje');

  toastMensaje.innerHTML = mensaje;

  if (tipo === "exito") {
    toastA.classList.remove("bg-danger");
    toastA.classList.add("bg-success");
  } else {
    toastA.classList.remove("bg-success");
    toastA.classList.add("bg-danger");
  }

  const toast = new bootstrap.Toast(toastA);
  toast.show();

}


function eliminar(id) {
  fetch("../controllers/procesar_baja.php", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id_miembro: id }),
  })
    .then((response) => response.json())
    .then((data) => {

      if (data.status === "exito") {
        mostrarMiembros();
        mostrarToast(data.message, "exito");
      } else {
        mostrarToast(data.message, "error");
      }


    })
    .catch((error) => {
      mostrarToast("Error en fetch: " + error.message, "error");
    });
}

function modificar(event) {
  event.preventDefault();

  this.blur();

  const formulario = event.target;
  const formData = new FormData(formulario);
  const formDataObj = Object.fromEntries(formData.entries());

  fetch("../../backend/controllers/procesar_cambio.php", {
    method: "PUT",
    body: JSON.stringify(formDataObj)
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === "exito") {
        const formEl = document.getElementById("modalModificarMiembro");
        const formBts = bootstrap.Modal.getInstance(formEl);
        formBts.hide();

        mostrarMiembros();
        mostrarToast(data.message, "exito");
      } else {
        mostrarToast(data.message, "error");
      }
    });
}

function modificar_mostrar(id) {
  fetch(`../controllers/procesar_detalle.php?id_miembro=${id}`, {
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
      document.getElementById("formId").value = data.id_miembro;
      document.getElementById("formNombreModificar").value = data.nombre;
      document.getElementById("formPrimerApModificar").value = data.primer_apellido;
      document.getElementById("formSegundoApModificar").value = data.segundo_apellido;
      document.getElementById("formTelefonoModificar").value = data.telefono;
      document.getElementById("formEmailModificar").value = data.email;
      document.getElementById("formNumCasaModificar").value = data.numero_casa;
      document.getElementById("formCalleModificar").value = data.calle;
      document.getElementById("formColoniaModificar").value = data.colonia;
      document.getElementById("formCPModificar").value = data.cp;
      document.getElementById("formEstadoMembresia").value = data.estado_membresia;

      // Modal
      const modal = new bootstrap.Modal(
        document.getElementById("modalModificarMiembro")
      );
      modal.show();
    })
    .catch((error) => {
      mostrarToast("Error en fetch: " + error.message, "error");
    });
}

function detalle(id) {
  fetch(`../controllers/procesar_detalle.php?id_miembro=${id}`, {
    method: "GET"
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        console.error(data.error);
        return;
      }

      //console.log(data);

      // Llenado de campos existentes
      document.getElementById("formIdDetalle").value = data.id_miembro;
      document.getElementById("formNombreDetalle").value = data.nombre;
      document.getElementById("formPrimerApDetalle").value = data.primer_apellido;
      document.getElementById("formSegundoApDetalle").value = data.segundo_apellido;
      document.getElementById("formTelefonoDetalle").value = data.telefono;
      document.getElementById("formEmailDetalle").value = data.email;
      document.getElementById("formNumCasaDetalle").value = data.numero_casa;
      document.getElementById("formCalleDetalle").value = data.calle;
      document.getElementById("formColoniaDetalle").value = data.colonia;
      document.getElementById("formCPDetalle").value = data.cp;
      document.getElementById("formEstadoMembresiaDetalle").value = data.estado_membresia;
      document.getElementById("formFechaIngresoDetalle").value = data.fecha_ingreso;
      document.getElementById("formFechaPagoDetalle").value = data.fecha_pago_cuota;

      const modal = new bootstrap.Modal(document.getElementById("modalDetalleMiembro"));
      modal.show();
    })
    .catch((error) => {
      console.error("Error en fetch:", error);
    });
}

function eliminar_toltips() {
  const tooltips = document.querySelectorAll('.tooltip');
  tooltips.forEach(t => t.remove());
}
