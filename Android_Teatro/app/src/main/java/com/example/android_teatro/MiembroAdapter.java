package com.example.android_teatro;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;
import java.util.List;

import modal.Miembro;

public class MiembroAdapter extends RecyclerView.Adapter<MiembroAdapter.MiembroViewHolder> {

    private List<Miembro> listaMiembros;
    private List<Miembro> listaOriginal;
    private final LayoutInflater mInflater;
    private final OnItemClickListener listener;

    public interface OnItemClickListener {
        void onEliminarClick(String idMiembro);
    }

    public MiembroAdapter(Context context, OnItemClickListener listener) {
        mInflater = LayoutInflater.from(context);
        this.listener = listener;
    }

    @NonNull
    @Override
    public MiembroViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = mInflater.inflate(R.layout.item_miembro, parent, false);
        return new MiembroViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull MiembroViewHolder holder, int position) {
        if (listaMiembros != null) {
            Miembro miembro = listaMiembros.get(position);

            holder.tvID.setText("ID: "+miembro.getIdMiembro());
            holder.tvNombre.setText(miembro.getNombreCompleto());
            holder.tvEmail.setText(miembro.getEmail());
            holder.tvEstado.setText(miembro.getEstadoMembresia());

            holder.btnEliminar.setOnClickListener(v -> {
                listener.onEliminarClick(miembro.getIdMiembro());
            });

        } else {
            holder.tvNombre.setText("Sin datos");
        }
    }

    public void filtrar(String textoBusqueda) {
        if (listaOriginal == null) return;

        if (textoBusqueda.isEmpty()) {
            listaMiembros = new ArrayList<>(listaOriginal);
        } else {
            List<Miembro> listaFiltrada = new ArrayList<>();
            String busquedaMinuscula = textoBusqueda.toLowerCase();

            for (Miembro m : listaOriginal) {
                if (m.getNombreCompleto().toLowerCase().contains(busquedaMinuscula)) {
                    listaFiltrada.add(m);
                }
            }
            listaMiembros = listaFiltrada;
        }
        notifyDataSetChanged();
    }

    public void setMiembros(List<Miembro> miembros){
        this.listaMiembros = miembros;
        this.listaOriginal = new ArrayList<>(miembros);
        notifyDataSetChanged();
    }

    @Override
    public int getItemCount() {
        if (listaMiembros != null)
            return listaMiembros.size();
        else return 0;
    }

    class MiembroViewHolder extends RecyclerView.ViewHolder {
        private final TextView tvNombre, tvEmail, tvEstado, tvID;
        private final ImageButton btnEliminar;

        private MiembroViewHolder(View itemView) {
            super(itemView);
            tvID = itemView.findViewById(R.id.tvId);
            tvNombre = itemView.findViewById(R.id.tvNombreCompleto);
            tvEmail = itemView.findViewById(R.id.tvEmail);
            tvEstado = itemView.findViewById(R.id.tvEstado);
            btnEliminar = itemView.findViewById(R.id.btnEliminar);
        }
    }
}
