document.addEventListener('DOMContentLoaded', function () {
    // Validar Titulo
    function validarTitulo(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el título." });
        }
    }

    // Validar Autor
    function validarAutor(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el autor." });
        }
    }

    // Validar Num. Actos
    function validarNumActos(id) {
        if (document.getElementById(id)) {
            
            var val = new LiveValidation(id, { validMessage: "✅" });
            
            val.add(Validate.Presence, { failureMessage: "Se requiere el número de actos." });

            val.add(Validate.Numericality, { 
                onlyInteger: true,             
                minimum: 1,                    
                notANumberMessage: "Solo se permiten números",
                notIntMessage: "Debe ser un número entero",
                tooLowMessage: "Debe ser al menos 1 acto" 
            });
        }
    }

    // Validar Año
    function validarAnio(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Numericality, {
                onlyInteger: true,
                notANumberMessage: "Solo se permiten números"
            });
            val.add(Validate.Length, {
                is: 4,
                wrongLengthMessage: "El año debe tener 4 dígitos."
            });
        }
    }

    // Validar Descripcion
    function validarDescripcion(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });

            val.add(Validate.Presence, { failureMessage: "Ingresa una descripción." });
        }
    }

    // --- Formulario AGREGAR 
    validarTitulo('formTitulo');
    validarAutor('formAutor');
    validarNumActos('formNumActos');
    validarAnio('formAnioPresentacion');
    validarDescripcion('formDescripcion');

    // --- Formulario MODIFICAR 
    validarTitulo('modificarTitulo');
    validarAutor('modificarAutor');
    validarNumActos('modificarNumActos');
    validarAnio('modificarAnio');
    validarDescripcion('modificarDescripcion');

});
