document.addEventListener('DOMContentLoaded', function () {
    // Validar Monto
    function validarMonto(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el monto." });
            val.add(Validate.Numericality, {
                notANumberMessage: "Solo se permiten números",
                minimum: 0.1,                    
                tooLowMessage: "Ingresa una cantidad correcta." 
            });
        }
    }

    // Validar Concepto
    function validarConcepto(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el concepto." });
        }
    }

    // --- Formulario AGREGAR 
    validarMonto('formMonto');
    validarConcepto('formConcepto');

    // --- Formulario MODIFICAR 
    validarMonto('modificarMonto');
    validarConcepto('modificarConcepto');
});
