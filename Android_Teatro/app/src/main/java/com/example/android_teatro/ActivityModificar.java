package com.example.android_teatro;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.Calendar;

import controller.AnalizadorJSON;

public class ActivityModificar extends AppCompatActivity {

    private TextInputEditText etId, etNombre, etApellido1, etApellido2, etEmail, etTelefono,
            etNumCasa, etCalle, etColonia, etCP, etEstado, etFechaPago;
    private Button btnGuardar;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_modificar_miembros);

        etId = findViewById(R.id.etId);
        etNombre = findViewById(R.id.etNombre);
        etApellido1 = findViewById(R.id.etApellido1);
        etApellido2 = findViewById(R.id.etApellido2);
        etEmail = findViewById(R.id.etEmail);
        etTelefono = findViewById(R.id.etTelefono);
        etCalle = findViewById(R.id.etCalle);
        etNumCasa = findViewById(R.id.etNumCasa);
        etColonia = findViewById(R.id.etColonia);
        etCP = findViewById(R.id.etCP);
        etEstado = findViewById(R.id.etEstado);
        etFechaPago = findViewById(R.id.etFechaPago);
        btnGuardar = findViewById(R.id.btnGuardarMiembro);


        etFechaPago.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mostrarCalendario();
            }
        });
        etFechaPago.setOnFocusChangeListener((v, hasFocus) -> {
            if (hasFocus) mostrarCalendario();
        });

        btnGuardar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (validarCampos()) {
                    realizarModificacion();
                } else {
                    Toast.makeText(getBaseContext(), "Error en los campos.", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    private void mostrarCalendario() {
        final Calendar c = Calendar.getInstance();
        int year = c.get(Calendar.YEAR);
        int month = c.get(Calendar.MONTH);
        int day = c.get(Calendar.DAY_OF_MONTH);

        DatePickerDialog datePickerDialog = new DatePickerDialog(this,
                new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                        String fecha = year + "-" + (monthOfYear + 1) + "-" + dayOfMonth;
                        etFechaPago.setText(fecha);
                    }
                }, year, month, day);
        datePickerDialog.show();
    }

    private void realizarModificacion() {
        new Thread(() -> {
            AnalizadorJSON analizadorJSON = new AnalizadorJSON();
            String url = "http://10.0.2.2/api_php_mysql/api_mysql_cambios.php";
            String metodo = "POST";

            JSONObject jsonDatos = new JSONObject();
            try {
                jsonDatos.put("id_miembro", etId.getText().toString());
                jsonDatos.put("nombre", etNombre.getText().toString());
                jsonDatos.put("primer_apellido", etApellido1.getText().toString());
                jsonDatos.put("segundo_apellido", etApellido2.getText().toString());
                jsonDatos.put("email", etEmail.getText().toString());
                jsonDatos.put("telefono", etTelefono.getText().toString());
                jsonDatos.put("calle", etCalle.getText().toString());
                jsonDatos.put("numero_casa", etNumCasa.getText().toString());
                jsonDatos.put("colonia", etColonia.getText().toString());
                jsonDatos.put("cp", etCP.getText().toString());
                jsonDatos.put("estado_membresia", etEstado.getText().toString());
                jsonDatos.put("fecha_pago_cuota", etFechaPago.getText().toString());

            } catch (JSONException e) {
                e.printStackTrace();
            }

            JSONObject respuesta = analizadorJSON.peticionHTTP(url, metodo, jsonDatos);
            runOnUiThread(() -> {
                if (respuesta != null) {
                    try {
                        String status = respuesta.getString("status");
                        String message = respuesta.getString("message");

                        if ("exito".equals(status)) {
                            Toast.makeText(ActivityModificar.this, "Modificacion correcta", Toast.LENGTH_SHORT).show();
                            finish();
                        } else {
                            Toast.makeText(ActivityModificar.this, "Error: " + message, Toast.LENGTH_LONG).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                        Toast.makeText(ActivityModificar.this, "Error al leer respuesta del servidor", Toast.LENGTH_SHORT).show();
                    }
                } else {
                    Toast.makeText(ActivityModificar.this, "Error de conexinn", Toast.LENGTH_SHORT).show();
                }
            });
        }).start();
    }

    private boolean validarCampos() {
        boolean esValido = true;

        if (etId.getText().toString().trim().isEmpty()) {
            etId.setError("El ID es obligatorio");
            esValido = false;
        }

        if (etNombre.getText().toString().trim().isEmpty()) {
            etNombre.setError("El nombre es obligatorio");
            esValido = false;
        }

        if (etApellido1.getText().toString().trim().isEmpty()) {
            etApellido1.setError("El primer apellido es obligatorio");
            esValido = false;
        }

        String email = etEmail.getText().toString().trim();
        if (email.isEmpty()) {
            etEmail.setError("El correo es obligatorio");
            esValido = false;
        } else if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            etEmail.setError("Ingrese un correo válido");
            esValido = false;
        }

        if (etTelefono.getText().toString().trim().length() < 10) {
            etTelefono.setError("El teléfono debe tener 10 dígitos");
            esValido = false;
        }

        if (etNumCasa.getText().toString().trim().isEmpty()) {
            etNumCasa.setError("Falta el número");
            esValido = false;
        }

        if (etFechaPago.getText().toString().trim().isEmpty()) {
            etFechaPago.setError("Seleccione una fecha");
            esValido = false;
        }
        return esValido;
    }
}
