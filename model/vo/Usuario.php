<?php

class Usuario {

    private $idUsuario;
    private $login;
    private $password;

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    public function getJSON() {
        return get_object_vars($this);
    }

}
