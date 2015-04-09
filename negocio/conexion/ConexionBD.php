<?php

require_once './negocio/conexion/Config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConexionBD extends PDO {

    private $conexion;
    //nombre base de datos
    private $dbname = DB_NAME;
    //nombre servidor
    private $host = HOST;
    //nombre usuarios base de datos
    private $user = USER_NAME;
    //password usuario
    private $pass = PASS;
    //puerto 
    private $port = PORT;

    //creamos la conexión a la base de datos prueba
    public function __construct() {
        try {
            $url = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname";
            $this->conexion = parent::__construct($url, $this->user, $this->pass);
        } catch (PDOException $e) {
            throw new Exception('Error al conectar a la base de datos', -3);
        }
    }

    //función para cerrar una conexión pdo
    public function close() {
        $this->conexion = null;
    }

}
