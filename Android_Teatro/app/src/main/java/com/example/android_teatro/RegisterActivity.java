package com.example.android_teatro;

import android.os.Bundle;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import org.json.JSONException;
import org.json.JSONObject;
import controller.AnalizadorJSON;

public class RegisterActivity extends AppCompatActivity {

    private EditText etNombre, etEmail, etUsuario, etPassword;
    private Button btnRegister;
    private TextView tvLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        etNombre = findViewById(R.id.editTextName);
        etEmail = findViewById(R.id.editTextEmailRegister);
        etUsuario = findViewById(R.id.editTextUsername);
        etPassword = findViewById(R.id.editTextPasswordRegister);
        btnRegister = findViewById(R.id.buttonRegister);
        tvLogin = findViewById(R.id.textViewLoginLink);

        btnRegister.setOnClickListener(v -> realizarRegistro());

        tvLogin.setOnClickListener(v -> finish());
    }

    private void realizarRegistro() {
        String nombre = etNombre.getText().toString().trim();
        String email = etEmail.getText().toString().trim();
        String usuario = etUsuario.getText().toString().trim();
        String pass = etPassword.getText().toString().trim();

        if (nombre.isEmpty() || usuario.isEmpty() || pass.isEmpty()) {
            Toast.makeText(this, "Faltan datos obligatorios", Toast.LENGTH_SHORT).show();
            return;
        }

        new Thread(() -> {
            AnalizadorJSON analizador = new AnalizadorJSON();
            String url = "http://10.0.2.2/api_php_mysql/api_registro.php";
            String metodo = "POST";

            JSONObject jsonDatos = new JSONObject();
            try {
                jsonDatos.put("nombre", nombre);
                jsonDatos.put("email", email);
                jsonDatos.put("username", usuario);
                jsonDatos.put("password", pass);
            } catch (JSONException e) {
                e.printStackTrace();
            }

            JSONObject respuesta = analizador.peticionHTTP(url, metodo, jsonDatos);

            runOnUiThread(() -> {
                if (respuesta != null) {
                    try {
                        String status = respuesta.getString("status");
                        if ("exito".equals(status)) {
                            Toast.makeText(RegisterActivity.this, "Registro exitoso, por favor inicia sesión", Toast.LENGTH_LONG).show();
                            finish();
                        } else {
                            Toast.makeText(RegisterActivity.this, respuesta.getString("message"), Toast.LENGTH_LONG).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                } else {
                    Toast.makeText(RegisterActivity.this, "Error de conexión", Toast.LENGTH_SHORT).show();
                }
            });
        }).start();
    }
}