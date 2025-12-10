package com.example.android_teatro;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import org.json.JSONException;
import org.json.JSONObject;
import controller.AnalizadorJSON;


public class LoginActivity extends AppCompatActivity {

    private EditText etEmail, etPassword;
    private Button btnLogin;
    private TextView tvRegister;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        etEmail = findViewById(R.id.editTextEmail);
        etPassword = findViewById(R.id.editTextPassword);
        btnLogin = findViewById(R.id.buttonLogin);
        tvRegister = findViewById(R.id.textViewRegisterLink);

        btnLogin.setOnClickListener(v -> realizarLogin());

        tvRegister.setOnClickListener(v -> {
            startActivity(new Intent(LoginActivity.this, RegisterActivity.class));
        });
    }

    private void realizarLogin() {
        String user = etEmail.getText().toString().trim();
        String pass = etPassword.getText().toString().trim();

        if (user.isEmpty() || pass.isEmpty()) {
            Toast.makeText(this, "Llena todos los campos", Toast.LENGTH_SHORT).show();
            return;
        }

        new Thread(() -> {
            AnalizadorJSON analizador = new AnalizadorJSON();
            String url = "http://10.0.2.2/api_php_mysql/api_login.php";
            String metodo = "POST";

            JSONObject jsonDatos = new JSONObject();
            try {
                jsonDatos.put("username", user);
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
                            Toast.makeText(LoginActivity.this, respuesta.getString("message"), Toast.LENGTH_SHORT).show();

                            Intent intent = new Intent(LoginActivity.this, ActivityMiembros.class);
                            startActivity(intent);
                            finish();

                        } else {
                            Toast.makeText(LoginActivity.this, respuesta.getString("message"), Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                } else {
                    Toast.makeText(LoginActivity.this, "Error de conexion", Toast.LENGTH_SHORT).show();
                }
            });
        }).start();
    }
}
