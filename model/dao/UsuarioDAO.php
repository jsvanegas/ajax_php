<?php

class UsuarioDAO {

    /**
     *
     * @var ConexionBD 
     */
    private $conexion;

    public function __construct(&$conexion) {
        $this->conexion = $conexion;
    }

    /**
     * 
     * @param String $login
     * @param String $password
     * @return Usuario
     */
    public function login($login, $password) {
        $usuario = null;
        try {
            $sql = 'select * from usuario where login=:login and pass=:pass';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue('login', $login);
            $stmt->bindValue('pass', $password);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            if (!empty($resultado)) {
                $usuario = new Usuario();
                $usuario->setIdUsuario($resultado[0]['idUsuario']);
                $usuario->setLogin($resultado[0]['Login']);
                $usuario->setPassword($resultado[0]['Pass']);
            }
        } catch (Exception $exc) {
            throw new Exception('Error al consultar el usuario', -1);
        }
        return $usuario;
    }

}
