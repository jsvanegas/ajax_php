<?php

class Cita {

    private $idCita;
    private $asunto;
    private $descripcion;
    private $idUsuario;
    private $fecha;
    private $lugar;

    public function __construct($asunto, $descripcion, $idUsuario, $fecha, $lugar, $idCita = NULL) {
        $this->idCita = $idCita;
        $this->asunto = $asunto;
        $this->descripcion = $descripcion;
        $this->idUsuario = $idUsuario;
        $this->fecha = $fecha;
        $this->lugar = $lugar;
    }

    function getIdCita() {
        return $this->idCita;
    }

    function getAsunto() {
        return $this->asunto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getLugar() {
        return $this->lugar;
    }

    function setIdCita($idCita) {
        $this->idCita = $idCita;
    }

    function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    public function getJSON() {
        return get_object_vars($this);
    }

}
