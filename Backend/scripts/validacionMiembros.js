document.addEventListener('DOMContentLoaded', function() {
    // Validar Nombre
    function validarNombre(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el nombre." });
        }
    }

    // Validar Primer Apellido
    function validarPrimerAp(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el primer apellido." });
        }
    }

    // Validar Segundo Apellido
    function validarSegundoAp(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el segundo apellido." });
        }
    }

    // Validar Teléfono
    function validarTelefono(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el teléfono." });
            val.add(Validate.Numericality, { 
                onlyInteger: true, 
                notANumberMessage: "Solo se permiten números" 
            });
            val.add(Validate.Length, { 
                is: 10, 
                wrongLengthMessage: "El teléfono debe tener 10 dígitos." 
            });
        }
    }

    // Validar Email
    function validarEmail(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "El correo es obligatorio" });
            val.add(Validate.Email, { failureMessage: "Formato inválido (ejemplo@correo.com)" });
        }
    }

    // Validar Num. Casa
    function validarNumCasa(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
        }
    }

    // Validar Calle 
    function validarCalle(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
        }
    }

    // Validar Colonia
    function validarColonia(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
        }
    }

    // Validar CP
    function validarCP(id) {
        if (document.getElementById(id)) {
            if(document.getElementById(id).value === 0) 
                return;
        }else {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Numericality, { 
                onlyInteger: true, 
                notANumberMessage: "Debe ser un número" 
            });
            val.add(Validate.Length, { 
                is: 5, 
                wrongLengthMessage: "El CP debe tener 5 dígitos" 
            });
        }
    }


    // --- Formulario AGREGAR 
    validarNombre('formNombre');
    validarPrimerAp('formPrimerAp');
    validarSegundoAp('formSegundoAp');
    validarTelefono('formTelefono');
    validarEmail('formEmail');
    validarNumCasa('formNumCasa');
    validarCalle('formCalle');
    validarColonia('formColonia');
    validarCP('formCP');

    // --- Formulario MODIFICAR 
    validarNombre('formNombreModificar');
    validarPrimerAp('formPrimerApModificar');
    validarSegundoAp('formSegundoApModificar');
    validarTelefono('formTelefonoModificar');
    validarEmail('formEmailModificar');
    validarNumCasa('formNumCasaModificar');
    validarCalle('formCalleModificar');
    validarColonia('formColoniaModificar');
    validarCP('formCPModificar');

});