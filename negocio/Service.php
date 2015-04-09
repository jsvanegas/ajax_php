<?php

require_once './negocio/conexion/ConexionBD.php';
require_once './model/dao/UsuarioDAO.php';
require_once './model/dao/CitaDAO.php';
require_once './model/vo/Usuario.php';
require_once './model/vo/Cita.php';

class Service {

    /**
     *
     * @var ConexionBD 
     */
    private $conexion;

    public function __construct() {
        $this->conexion = new ConexionBD();
    }

    public function login() {
        $login = $_GET['login'];
        $password = $_GET['pass'];
        $usuarioDAO = new UsuarioDAO($this->conexion);
        $usuario = $usuarioDAO->login($login, $password);
        if ($usuario == null) {
            throw new Exception('Error en el login o pass', -1);
        }
        $_SESSION['usuario'] = $usuario;
        return $usuario->getJSON();
    }

    public function agregarCita() {
        if (!isset($_SESSION['usuario'])) {
            throw new Exception('Debe iniciar sesión', -2);
        }
        $idUsuario = $_SESSION['usuario']->getIdUsuario();
        $asunto = isset($_GET['asunto']) ? $_GET['asunto'] : NULL;
        $descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : NULL;
        $lugar = isset($_GET['lugar']) ? $_GET['lugar'] : NULL;
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : NULL;
        $cita = new Cita($asunto, $descripcion, $idUsuario, $fecha, $lugar);
        $citaDao = new CitaDAO($this->conexion);
        $citaDao->agregar($cita);
    }

    public function consultarCita() {
        if (!isset($_SESSION['usuario'])) {
            throw new Exception('Debe iniciar sesión', -2);
        }
        $citaDao = new CitaDAO($this->conexion);
        $idUsuario = $_SESSION['usuario']->getIdUsuario();
        return $citaDao->consultar($idUsuario);
    }

    public function consultarCitaPorAsunto() {
        if (!isset($_SESSION['usuario'])) {
            throw new Exception('Debe iniciar sesión', -2);
        }
        $asunto = $_GET['asunto'];
        $citaDao = new CitaDAO($this->conexion);
        return $citaDao->consultarPorAsunto($_SESSION['usuario']->getIdUsuario(), $asunto);
    }

    public function __destruct() {
        $this->conexion->close();
    }

}
