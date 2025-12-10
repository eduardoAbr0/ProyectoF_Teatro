package modal;

public class Miembro {
    // Campos mapeados del JSON
    private String idMiembro;
    private String nombre;
    private String primerApellido;
    private String segundoApellido;
    private String telefono;
    private String email;
    private String numeroCasa;
    private String calle;
    private String colonia;
    private String cp;
    private String estadoMembresia;
    private String fechaPagoCuota;

    // Constructor completo
    public Miembro(String idMiembro, String nombre, String primerApellido, String segundoApellido,
                   String telefono, String email, String numeroCasa, String calle,
                   String colonia, String cp, String estadoMembresia, String fechaPagoCuota) {
        this.idMiembro = idMiembro;
        this.nombre = nombre;
        this.primerApellido = primerApellido;
        this.segundoApellido = segundoApellido;
        this.telefono = telefono;
        this.email = email;
        this.numeroCasa = numeroCasa;
        this.calle = calle;
        this.colonia = colonia;
        this.cp = cp;
        this.estadoMembresia = estadoMembresia;
        this.fechaPagoCuota = fechaPagoCuota;
    }

    // Método útil para mostrar el nombre completo en la lista
    public String getNombreCompleto() {
        return nombre + " " + primerApellido + " " + segundoApellido;
    }

    // Getters
    public String getIdMiembro() { return idMiembro; }
    public String getTelefono() { return telefono; }
    public String getEmail() { return email; }
    public String getDireccion() { return calle + " #" + numeroCasa + ", " + colonia; }
    public String getEstadoMembresia() { return estadoMembresia; }
    public String getFechaPagoCuota() { return fechaPagoCuota; }

    // (Puedes agregar los demás getters si los necesitas)
}