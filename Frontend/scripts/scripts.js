function mostrarMiembros() {
    fetch("/Backend/controllers/procesar_mostrar.php")
        .then((response) => response.json())
        .then((data) => {
            const miembros = data;
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
                cardImg.src = "/Frontend/assets/img/image.png";
                const nombre = document.createElement("h5");
                nombre.className = "card-title";
                const cardText = document.createElement("p");
                cardText.className = "card-text";
                cardText.textContent = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.";
                cardText.style.color = 'black';

                // Asignar datos
                nombre.textContent = `${m.nombre} ${m.primer_apellido}`;

                // Estructura
                card.appendChild(cardImg);
                card.appendChild(cardBody);
                cardBody.appendChild(nombre);
                cardBody.appendChild(cardText);
                cardCol.appendChild(card);
                row.appendChild(cardCol);
            }
        });
}