document.addEventListener('DOMContentLoaded', function () {
    // Validar ID Usuario
    function validarIdUsuario(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el ID de usuario." });
            val.add(Validate.Numericality, { onlyInteger: true, notANumberMessage: "Debe ser un número" });
        }
    }

    // Validar ID Asiento
    function validarIdAsiento(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el ID de asiento." });
            val.add(Validate.Numericality, { onlyInteger: true, notANumberMessage: "Debe ser un número" });
        }
    }

    // Validar ID Obra
    function validarIdObra(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el ID de obra." });
            val.add(Validate.Numericality, { onlyInteger: true, notANumberMessage: "Debe ser un número" });
        }
    }

    // Validar Precio
    function validarPrecio(id) {
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

    // Validar Fecha Compra
    function validarFechaCompra(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere la fecha de compra." });
        }
    }

    // Validar Estado
    function validarEstado(id) {
        if (document.getElementById(id)) {
            var val = new LiveValidation(id, { validMessage: "✅" });
            val.add(Validate.Presence, { failureMessage: "Se requiere el estado." });
        }
    }

    // --- Formulario AGREGAR 
    validarIdUsuario('formIdUsuario');
    validarIdAsiento('formIdAsiento');
    validarIdObra('formIdObra');
    validarPrecio('formPrecio');
    validarFechaCompra('formFechaCompra');
    validarEstado('formEstado');

    // --- Formulario MODIFICAR 
    validarIdUsuario('modificarIdUsuario');
    validarIdAsiento('modificarIdAsiento');
    validarIdObra('modificarIdObra');
    validarPrecio('modificarPrecio');
    validarFechaCompra('modificarFechaCompra');
    validarEstado('modificarEstado');

});
