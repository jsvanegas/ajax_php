<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CitaDAO {

    /**
     *
     * @var ConexionBD 
     */
    private $conexion;

    public function __construct(&$conexion) {
        $this->conexion = $conexion;
    }

    public function agregar(Cita $cita) {
        $usuario = null;
        try {
            $sql = 'insert into Cita (idUsuario,Asunto,Descripcion,Lugar,Fecha) '
                    . 'values (:idusuario,:asunto,:descripcion,:lugar,:fecha)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue('idusuario', $cita->getIdUsuario());
            $stmt->bindValue('asunto', $cita->getAsunto());
            $stmt->bindValue('descripcion', $cita->getDescripcion());
            $stmt->bindValue('lugar', $cita->getLugar());
            $stmt->bindValue('fecha', $cita->getFecha());
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Error al agregar la cita', -1);
        }
        return $usuario;
    }

    public function consultar($idUsuario) {
        try {
            $sql = 'select * from Cita where idUsuario=:idusuario';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue('idusuario', $idUsuario);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            throw new Exception('Error al consultar las citas', -1);
        }
    }

    public function consultarPorAsunto($idUsuario, $asunto) {
        try {
            $sql = 'select * from Cita where idUsuario=:idusuario and asunto like :asunto';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue('idusuario', $idUsuario);
            $stmt->bindValue('asunto', '%' . $asunto . '%');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $exc) {
            throw new Exception('Error al consultar la cita', -1);
        }
    }

}
