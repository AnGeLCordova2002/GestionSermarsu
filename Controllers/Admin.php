<?php
class Admin extends Controller
{
    private $id_usuario;
    public function __construct() {
        parent::__construct();
        session_start();
        $this->id_usuario = $_SESSION['id'];
    }

    public function index()
    {
        $data['title'] = 'Panel de administracion';
        $data['script'] = 'files.js';
        $data['active'] = 'recent';
        $carpetas = $this->model->getCarpetas($this->id_usuario);
        $data['archivos'] = $this->model->getArchivosRecientes($this->id_usuario);
        for ($i=0; $i < count($carpetas); $i++) { 
            $carpetas[$i]['color'] = substr(md5($carpetas[$i]['id']), 0, 6);
            $carpetas[$i]['fecha'] = time_ago(strtotime($carpetas[$i]['fecha_create']));
        }
        $data['carpetas'] = $carpetas;
        $this->views->getView('admin', 'home', $data);
    }

    public function crearcarpeta()
    {
        $nombre = $_POST['nombre'];
        if (empty($nombre)) {
            $res = array('tipo' => 'warning', 'mensaje' => 'EL NOMBRE ES REQUERIDO');
        } else {
            $verificarNom = $this->model->getVerificar('nombre', $nombre, $this->id_usuario, 0);
            if (empty($verificarNom)) {
                $data = $this->model->crearcarpeta($nombre, $this->id_usuario);
                if ($data > 0) {
                    $res = array('tipo' => 'success', 'mensaje' => 'CARPETA CREADA');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL CREAR CARPETA');
                }
            } else {
                $res = array('tipo' => 'warning', 'mensaje' => 'LA CARPETA YA EXISTE');
            }
            
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function subirarchivo()
    {
        $id_carpeta = (empty($_POST['id_carpeta'])) ? 1 : $_POST['id_carpeta'];
        $archivo = $_FILES['file'];
        $name = $archivo['name'];
        $tmp = $archivo['tmp_name'];
        $tipo = $archivo['type'];
        $data = $this->model->subirArchivo($name, $tipo, $id_carpeta);
        if ($data > 0) {
            $destino = 'Assets/archivos';
            if (!file_exists($destino)) {
                mkdir($destino);
            }
            $carpeta = $destino . '/' . $id_carpeta;
            if (!file_exists($carpeta)) {
                mkdir($carpeta);
            }
            move_uploaded_file($tmp, $carpeta . '/' . $name);
            $res = array('tipo' => 'success', 'mensaje' => 'ARCHIVO SUBIDO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL SUBIR ARCHIVO');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ver($id_carpeta)
    {
        $data['title'] = 'LISTADO DE ARCHIVOS';
        $data['active'] = 'detail';
        // Aquí ajustamos para que `getArchivos` reciba los parámetros correctos
        $data['archivos'] = $this->model->getArchivos($id_carpeta, $this->id_usuario);
        $this->views->getView('admin', 'archivos', $data);
    }

    
}
