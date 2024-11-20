<?php
class UsuariosModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuarios()
{
    $sql = "SELECT id, nombre, apellido, correo, telefono, direccion, rol, perfil, fecha FROM usuarios WHERE estado = 1";
    return $this->selectAll($sql);
}

public function getVerificar($campo, $valor)
{
    $sql = "SELECT id FROM usuarios WHERE $campo = ? AND estado = 1";
    return $this->select($sql, [$valor]);
}

public function guardar($nombre, $apellido, $correo, $telefono, $direccion, $clave, $rol)
{
    $sql = "INSERT INTO usuarios (nombre, apellido, correo, telefono, direccion, clave, rol) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $datos = [$nombre, $apellido, $correo, $telefono, $direccion, $clave, $rol];
    return $this->insertar($sql, $datos);
}


}

?>