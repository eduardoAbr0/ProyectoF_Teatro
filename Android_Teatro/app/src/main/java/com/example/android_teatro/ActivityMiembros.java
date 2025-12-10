package com.example.android_teatro;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.ViewModelProvider;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONException;
import org.json.JSONObject;
import android.app.AlertDialog;

import controller.AnalizadorJSON;

public class ActivityMiembros extends AppCompatActivity {

    private MiembroViewModel miembroViewModel;
    private MiembroAdapter adapter;
    private TextInputEditText etFiltro;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_miembros_list);

        RecyclerView recyclerView = findViewById(R.id.rvMiembros);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        etFiltro = findViewById(R.id.etBuscar);

        etFiltro.addTextChangedListener(new TextWatcher() {
            @Override
            public void afterTextChanged(Editable s) {

            }

            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                if (adapter != null) {
                    adapter.filtrar(s.toString());
                }
            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {

            }
        });

        adapter = new MiembroAdapter(this, new MiembroAdapter.OnItemClickListener() {
            @Override
            public void onEliminarClick(String idMiembro) {
                mostrarDialogoConfirmacion(idMiembro);
            }
        });

        recyclerView.setAdapter(adapter);

        miembroViewModel = new ViewModelProvider(this).get(MiembroViewModel.class);

        miembroViewModel.getMiembros().observe(this, miembros -> {
            adapter.setMiembros(miembros);
        });

        findViewById(R.id.fabAgregarMiembro).setOnClickListener(v ->
                startActivity(new Intent(this, ActivityAltas.class))
        );

        findViewById(R.id.fabIrAModificar).setOnClickListener(v ->
                startActivity(new Intent(this, ActivityModificar.class))
        );
    }

    private void mostrarDialogoConfirmacion(String idMiembro) {
        new AlertDialog.Builder(this)
                .setTitle("Eliminar Miembro")
                .setMessage("¿Deseas eliminar este registro?")
                .setPositiveButton("SI", (dialog, which) -> {
                    eliminarMiembroDeBD(idMiembro);
                })
                .setNegativeButton("CANCELAR", null)
                .show();
    }

    private void eliminarMiembroDeBD(String idParaBorrar) {
        new Thread(() -> {
            AnalizadorJSON analizador = new AnalizadorJSON();
            String url = "http://10.0.2.2/api_php_mysql/api_mysql_bajas.php";
            String metodo = "DELETE";

            JSONObject jsonDatos = new JSONObject();
            try {
                jsonDatos.put("id", idParaBorrar);
            } catch (JSONException e) {
                e.printStackTrace();
            }

            JSONObject respuesta = analizador.peticionHTTP(url, metodo, jsonDatos);

            runOnUiThread(() -> {
                if (respuesta != null) {
                    try {
                        String status = respuesta.getString("status");
                        if ("exito".equals(status)) {
                            Toast.makeText(this, "Eliminado correctamente", Toast.LENGTH_SHORT).show();
                            miembroViewModel.cargarMiembros();
                        } else {
                            String msg = respuesta.optString("message", "Error desconocido");
                            Toast.makeText(this, "Error: " + msg, Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                } else {
                    Toast.makeText(this, "Error de conexion con el servidor", Toast.LENGTH_SHORT).show();
                }
            });
        }).start();
    }

    @Override
    protected void onResume() {
        super.onResume();
        miembroViewModel.cargarMiembros();
    }
}
