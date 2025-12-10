package com.example.android_teatro;

import android.app.Application;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.MutableLiveData;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import controller.AnalizadorJSON;
import modal.Miembro;

public class MiembroViewModel extends AndroidViewModel {
    private MutableLiveData<List<Miembro>> listaMiembrosLive;

    public MiembroViewModel(@NonNull Application application) {
        super(application);
        listaMiembrosLive = new MutableLiveData<>();
    }

    public MutableLiveData<List<Miembro>> getMiembros() {
        return listaMiembrosLive;
    }
    public void cargarMiembros() {
        new Thread(() -> {
            AnalizadorJSON analizador = new AnalizadorJSON();
            String url = "http://10.0.2.2:80/api_php_mysql/api_mysql_consulta.php";
            String metodo = "GET";

            JSONObject jsonRespuesta = analizador.peticionHTTP(url, metodo, new JSONObject());

            if (jsonRespuesta != null) {
                try {
                    if ("exito".equals(jsonRespuesta.getString("status"))) {
                        JSONArray jsonArray = jsonRespuesta.getJSONArray("Miembros");
                        List<Miembro> listaTemporal = new ArrayList<>();

                        for (int i = 0; i < jsonArray.length(); i++) {
                            JSONObject obj = jsonArray.getJSONObject(i);

                            listaTemporal.add(new Miembro(
                                    obj.getString("id_miembro"),
                                    obj.getString("nombre"),
                                    obj.getString("primer_apellido"),
                                    obj.getString("segundo_apellido"),
                                    obj.getString("telefono"),
                                    obj.getString("email"),
                                    obj.getString("numero_casa"),
                                    obj.getString("calle"),
                                    obj.getString("colonia"),
                                    obj.getString("cp"),
                                    obj.getString("estado_membresia"),
                                    obj.getString("fecha_pago_cuota")));
                        }
                        listaMiembrosLive.postValue(listaTemporal);
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }).start();
    }
}
