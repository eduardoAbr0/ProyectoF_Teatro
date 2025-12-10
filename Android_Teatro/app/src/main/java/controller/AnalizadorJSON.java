package controller;

import android.util.Log;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class AnalizadorJSON {
    private InputStream input = null;
    private OutputStream output = null;
    private JSONObject jsonObject = null;
    private HttpURLConnection conexion = null;
    private URL url;

    public JSONObject peticionHTTP(String direccionURL, String metodo, JSONObject dataPayload){

        Log.i("MSJ->", "Iniciando petición " + metodo + " a: " + direccionURL);

        try {
            url = new URL(direccionURL);
            conexion = (HttpURLConnection) url.openConnection();

            // Configuración básica
            conexion.setReadTimeout(15000);
            conexion.setConnectTimeout(15000);
            conexion.setRequestMethod(metodo);
            conexion.setRequestProperty("Content-Type", "application/json");

            if (!metodo.equals("GET")) {
                conexion.setDoOutput(true);

                String cadenaJSON = dataPayload.toString();
                Log.i("MSJ->", "Enviando Payload: " + cadenaJSON);

                output = new BufferedOutputStream((conexion.getOutputStream()));
                output.write(cadenaJSON.getBytes());
                output.flush();
                output.close();
            } else {
                conexion.setDoOutput(false);
            }
            // -------------------------------

        } catch (MalformedURLException e) {
            Log.e("MSJ->", "ERROR DIRECCION URL: "+e);
            return null;
        } catch (IOException e) {
            Log.e("MSJ->", "ERROR CONEXION: "+e);
            return null;
        }

        // RECIBIR Y ANALIZAR RESPUESTA
        try {
            int responseCode = conexion.getResponseCode();
            Log.d("MSJ->", "Response Code: " + responseCode);

            if (responseCode == HttpURLConnection.HTTP_OK) {
                input = new BufferedInputStream(conexion.getInputStream());
            } else {
                input = new BufferedInputStream(conexion.getErrorStream());
            }

            BufferedReader br = new BufferedReader(new InputStreamReader(input));
            StringBuilder cadena = new StringBuilder();
            String fila = null;

            while((fila = br.readLine()) != null){
                cadena.append(fila); // Quité el \n para evitar espacios extra en JSON
            }

            input.close();

            String respuestaString = cadena.toString();
            Log.d("MSJ_RESPUESTA->", "Servidor dice: " + respuestaString);

            if (respuestaString.isEmpty()) {
                Log.e("MSJ->", "El servidor devolvió una cadena vacía.");
                // Devolvemos un JSON de error manual para que la App no truene
                return new JSONObject("{\"status\": \"error\", \"message\": \"Respuesta vacía del servidor\"}");
            }

            jsonObject = new JSONObject(respuestaString);

        } catch (IOException e) {
            Log.e("MSJ->", "ERROR EN RESPUESTA IO: " + e.getMessage());
            try {
                // Corregí la sintaxis del JSON manual (faltaban comillas y cerrar llaves)
                return new JSONObject("{\"status\": \"error\", \"message\": \"Error IO: " + e.getMessage() + "\"}");
            } catch (JSONException jsonE) { return null; }
        } catch (JSONException e) {
            Log.e("MSJ->", "ERROR AL PROCESAR JSON: " + e.getMessage());
            try {
                // Corregí la sintaxis del JSON manual
                return new JSONObject("{\"status\": \"error\", \"message\": \"Error JSON: " + e.getMessage() + "\"}");
            } catch (JSONException jsonE) { return null; }
        } finally {
            if (conexion != null) {
                conexion.disconnect();
            }
        }

        return jsonObject;
    }
}