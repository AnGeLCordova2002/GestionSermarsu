<?php
class CompartidosModel extends Query {
    public function __construct() {
        parent::__construct();
    }

    public function getArchivosCompartidos($correo) 
    {
        $sql = "SELECT d.id, d.correo, a.nombre AS archivo, u.nombre FROM detalle_archivos d INNER JOIN archivos a ON d.id_archivo = a.id INNER JOIN usuarios u ON d.id_usuario = u.id WHERE d.correo = '$correo' AND d.estado != 0 ORDER BY d.id DESC";
        return $this->selectAll($sql);
    }

    public function getDetalle($id_detalle) 
    {
        $sql = "SELECT d.id, d.fecha_add, d.correo, a.nombre, a.id_carpeta, u.correo AS compartido, u.nombre AS usuario FROM detalle_archivos d INNER JOIN archivos a ON d.id_archivo = a.id INNER JOIN carpetas c ON a.id_carpeta = c.id INNER JOIN usuarios u ON d.id_usuario = u.id WHERE d.id = $id_detalle";
        return $this->select($sql);
    }

    public function eliminarCompartido($id){
        $sql = "UPDATE detalle_archivos SET estado = ? WHERE id = ?";
        return $this->save($sql, [0, $id]);
    }

}
?>
