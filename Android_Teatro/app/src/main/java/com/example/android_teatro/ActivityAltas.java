package com.example.android_teatro;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.Network;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.Nullable;

import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.Calendar;

import controller.AnalizadorJSON;

public class ActivityAltas extends Activity {

    private TextInputEditText etNombre, etApellido1, etApellido2, etEmail, etTelefono,
            etNumCasa, etCalle, etColonia, etCP, etEstado, etFechaPago;
    private Button btnGuardarMiembro;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_form_miembros);

        etNombre = findViewById(R.id.etNombre);
        etApellido1 = findViewById(R.id.etApellido1);
        etApellido2 = findViewById(R.id.etApellido2);
        etEmail = findViewById(R.id.etEmail);
        etTelefono = findViewById(R.id.etTelefono);
        etNumCasa = findViewById(R.id.etNumCasa);
        etCalle = findViewById(R.id.etCalle);
        etColonia = findViewById(R.id.etColonia);
        etCP = findViewById(R.id.etCP);
        etEstado = findViewById(R.id.etEstado);
        etFechaPago = findViewById(R.id.etFechaPago);

        btnGuardarMiembro = findViewById(R.id.btnGuardarMiembro);

        etFechaPago.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mostrarCalendario();
            }
        });
        etFechaPago.setOnFocusChangeListener((v, hasFocus) -> {
            if (hasFocus) mostrarCalendario();
        });

        btnGuardarMiembro.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (validarCampos()) {
                    agregarMiembro();
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

    private void agregarMiembro(){
        AnalizadorJSON analizadorJSON = new AnalizadorJSON();

        ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        Network network = cm.getActiveNetwork();

        if(network!=null && cm.getNetworkCapabilities(network)!=null){

            String url = "http://10.0.2.2:80/api_php_mysql/api_mysql_altas.php"; // Updated URL
            String metodo = "POST";

            JSONObject miembroData = new JSONObject();
            try {
                miembroData.put("nombre", etNombre.getText().toString());
                miembroData.put("primer_apellido", etApellido1.getText().toString());
                miembroData.put("segundo_apellido", etApellido2.getText().toString());
                miembroData.put("telefono", etTelefono.getText().toString());
                miembroData.put("email", etEmail.getText().toString());
                miembroData.put("numero_casa", Integer.parseInt(etNumCasa.getText().toString())); // Assuming integer
                miembroData.put("calle", etCalle.getText().toString());
                miembroData.put("colonia", etColonia.getText().toString());
                miembroData.put("codigo_postal", etCP.getText().toString()); // Assuming string, adjust if int
                miembroData.put("estado_membresia", etEstado.getText().toString());
                miembroData.put("fecha_pago_cuota", etFechaPago.getText().toString());

            } catch (JSONException e) {
                Log.e("MSJ->", "Error al crear JSON de miembro: " + e.getMessage());
                Toast.makeText(getBaseContext(), "Error al preparar datos del miembro.", Toast.LENGTH_LONG).show();
                return;
            } catch (NumberFormatException e) {
                Log.e("MSJ->", "Error de formato numérico: " + e.getMessage());
                Toast.makeText(getBaseContext(), "Por favor, ingrese un número válido para el número de casa.", Toast.LENGTH_LONG).show();
                return;
            }

            new Thread(new Runnable() {
                @Override
                public void run() {
                    JSONObject jsonObject = analizadorJSON.peticionHTTP(url, metodo, miembroData);

                    runOnUiThread(new Runnable() {
                        @Override
                        public void run() {
                            if (jsonObject != null) {
                                try {
                                    String status = jsonObject.getString("status");
                                    String message = jsonObject.getString("message");

                                    if ("exito".equals(status)) {
                                        Toast.makeText(getBaseContext(), message, Toast.LENGTH_LONG).show();
                                        // Optionally clear fields or navigate back
                                    } else {
                                        Toast.makeText(getBaseContext(), "Error: " + message, Toast.LENGTH_LONG).show();
                                    }
                                } catch (JSONException e) {
                                    Log.e("MSJ->", "Error al procesar respuesta JSON: " + e.getMessage());
                                    Toast.makeText(getBaseContext(), "Error al procesar la respuesta del servidor.", Toast.LENGTH_LONG).show();
                                }
                            } else {
                                Toast.makeText(getBaseContext(), "No se recibió respuesta del servidor o hubo un error.", Toast.LENGTH_LONG).show();
                            }
                        }
                    });
                }
            }).start();

        }else {
            Log.e("MSJ->","ERROR EN WIFI/RED INALAMBRICA");
            Toast.makeText(getBaseContext(), "No hay conexion a internet.", Toast.LENGTH_LONG).show();
        }
    }

    private boolean validarCampos() {
        boolean esValido = true;

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
