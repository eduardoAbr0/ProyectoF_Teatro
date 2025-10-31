function mostrarMiembros() {
  fetch("../controllers/procesar_mostrar.php")
    .then((response) => response.json())
    .then((data) => {
      console.log("Datos recibidos:", data);

      const miembros = data;
      const divMiembros = document.getElementById("mostrarMiembros");
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
        cardImg.src = "/assets/img/image.png";

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
        btnModificar.setAttribute("data-id", m.id);

        btnModificar.addEventListener("click", function () {
          modificar(this.dataset.id);
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
        btnEliminar.setAttribute("data-id", m.id);

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
        btnEliminar.setAttribute("data-bs-toggle", "tooltip");
        btnDetalle.setAttribute("data-id", m.id);

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
        title.textContent = `ID: ${m.id}`;
        cardText.innerHTML = `Nombre: ${m.Nombre} <br> Primer Apellido: ${m.Primer_apellido} <br> Segundo Apellido: ${m.Segundo_apellido}`;

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

function eliminar(id) {
  fetch("../controllers/procesar_baja.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id: id }),
  })
    .then((response) => response.text())
    .then((data) => {
      //console.log("Respuesta PHP:", data);
      location.reload();
    })
    .catch((error) => {
      console.error("Error en fetch:", error);
    });
}

function modificar(id) {
  fetch("../controllers/procesar_detalle.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id: id }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        console.error(data.error);
        return;
      }
      //console.log(data);

      document.getElementById("formId").value = data.id;
      document.getElementById("formNombreModificar").value = data.Nombre;
      document.getElementById("formPrimerApModificar").value = data.Primer_apellido;
      document.getElementById("formSegundoApModificar").value = data.Segundo_apellido;
      document.getElementById("formTelefonoModificar").value = data.Telefono;
      document.getElementById("formEmailModificar").value = data.email;
      document.getElementById("formNumCasaModificar").value = data.numCasa;
      document.getElementById("formCalleModificar").value = data.Calle;
      document.getElementById("formColoniaModificar").value = data.Colonia;
      document.getElementById("formCPModificar").value = data.Codigo_postal;

      // Modal
      const modal = new bootstrap.Modal(
        document.getElementById("modalModificarMiembro")
      );
      modal.show();
    })
    .catch((error) => {
      console.error("Error en fetch:", error);
    });
}

function detalle(id) {
  fetch("../controllers/procesar_detalle.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id: id }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        console.error(data.error);
        return;
      }
      //console.log(data);

      document.getElementById("formNombreDetalle").value = data.Nombre;
      document.getElementById("formPrimerApDetalle").value =
        data.Primer_apellido;
      document.getElementById("formSegundoApDetalle").value =
        data.Segundo_apellido;
      document.getElementById("formTelefonoDetalle").value = data.Telefono;
      document.getElementById("formEmailDetalle").value = data.email;
      document.getElementById("formNumCasaDetalle").value = data.numCasa;
      document.getElementById("formCalleDetalle").value = data.Calle;
      document.getElementById("formColoniaDetalle").value = data.Colonia;
      document.getElementById("formCPDetalle").value = data.Codigo_postal;

      // Modal
      const modal = new bootstrap.Modal(
        document.getElementById("modalDetalleMiembro")
      );
      modal.show();
    })
    .catch((error) => {
      console.error("Error en fetch:", error);
    });
}
