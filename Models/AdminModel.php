<?php
class AdminModel extends Query {
    public function __construct() {
        parent::__construct();
    }

    public function getCarpetas($id_usuario) {
        $sql = "SELECT * FROM carpetas WHERE id_usuario = $id_usuario AND estado = 1";
        return $this->selectAll($sql);
    }

    public function getVerificar($item, $nombre, $id_usuario, $id) {
        if ($id > 0) {
            $sql = "SELECT id FROM carpetas WHERE $item = '$nombre' AND id_usuario = $id_usuario AND id != $id AND estado = 1";
        } else {
            $sql = "SELECT id FROM carpetas WHERE $item = '$nombre' AND id_usuario = $id_usuario AND estado = 1";
        }
        return $this->select($sql);
    }

    public function crearcarpeta($nombre, $id_usuario) {
        $sql = "INSERT INTO carpetas (nombre, id_usuario) VALUES (?, ?)";
        $datos = array($nombre, $id_usuario);
        return $this->insertar($sql, $datos);
    }

    public function delete($id) {
        $sql = "UPDATE carpetas SET estado = ? WHERE id = ?";
        $datos = array(0, $id);
        return $this->save($sql, $datos);
    }

    // Obtener todos los archivos sin usar id_usuario
    public function getArchivosRecientes($id_usuario) {
        $sql = "SELECT a.* FROM archivos a INNER JOIN carpetas c ON a.id_carpeta = c.id WHERE c.id_usuario = $id_usuario ORDER BY a.id DESC";
        return $this->selectAll($sql);
    }

    public function subirArchivo($name, $tipo, $id_carpeta) {
        $sql = "INSERT INTO archivos (nombre, tipo, id_carpeta) VALUES (?, ?, ?)";
        $datos = array($name, $tipo, $id_carpeta);
        return $this->insertar($sql, $datos);
    }

    public function getArchivos($id_carpeta, $id_usuario) {
        $sql = "SELECT a.* FROM archivos a INNER JOIN carpetas c ON a.id_carpeta = c.id WHERE a.id_carpeta = $id_carpeta AND c.id_usuario = $id_usuario ORDER BY a.id DESC";
        return $this->selectAll($sql);
    }
}
?>
