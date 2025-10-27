function mostrarMiembros() {
    fetch("./Frontend/miembros.json")
        .then((response) => response.json())
        .then((data) => {
            const miembros = data.miembros;
            const divMiembros = document.getElementById("mostrarMiembros");
            divMiembros.innerHTML = "";

            const row = document.createElement("div");
            row.className = "row pb-4 pt-4 align-items-center";
            divMiembros.appendChild(row);

            for (const m of miembros) {
                // Crear elementos dentro del ciclo
                const cardCol = document.createElement("div");
                cardCol.className = "col-lg-3 col-md-4 col-12 pb-4 pt-3";
                const card = document.createElement("div");
                card.className = "card";
                const cardBody = document.createElement("div");
                cardBody.className = "card-body";
                const cardImg = document.createElement("img");
                cardImg.className = "card-img-top";
                cardImg.src = "image.png";
                const nombre = document.createElement("h5");
                nombre.className = "card-title";
                const cardText = document.createElement("p");
                cardText.className = "card-text";
                const btnModificar = document.createElement("button");
                btnModificar.className = "btn btn-warning ms-1";
                btnModificar.innerHTML = "MODIFICAR";
                const btnEliminar = document.createElement("button");
                btnEliminar.className = "btn btn-danger";
                btnEliminar.innerHTML = "ELIMINAR";

                // Asignar datos
                nombre.textContent = `${m.firstName} ${m.lastName}`;
                cardText.textContent = `Edad: ${m.edad}`;

                // Estructura
                card.appendChild(cardImg);
                card.appendChild(cardBody);
                cardBody.appendChild(nombre);
                cardBody.appendChild(cardText);
                cardBody.appendChild(btnEliminar);
                cardBody.appendChild(btnModificar);
                cardCol.appendChild(card);
                row.appendChild(cardCol);
            }
        });
}