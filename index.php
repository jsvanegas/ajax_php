<?php

require_once './negocio/Service.php';
$op = $_GET['op'];
session_start();
$service = new Service();
$resultado['codigoRespuesta'] = 1;
try {
    switch ($op) {
        case 1: {
                $resultado['datos'] = $service->login();
                break;
            }
        case 2: {
                $service->agregarCita();
                $resultado['mensaje'] = 'se insertó correctamente la cita';
                break;
            }
        case 3: {
                $resultado['datos'] = $service->consultarCita();
                $resultado['mensaje'] = (empty($resultado['datos'])) ? 'No hay citas' : 'Se encontraron registros';
                break;
            }
        case 4: {
                $resultado['datos'] = $service->consultarCitaPorAsunto();
                $resultado['mensaje'] = (empty($resultado['datos'])) ? 'No hay citas' : 'Se encontraron registros';
                break;
            }
        case 5: {
                session_destroy();
                $resultado['mensaje'] = 'se cerró correctamente la sesión';
                break;
            }
    }
} catch (Exception $e) {
    $resultado['codigoRespuesta'] = $e->getCode();
    $resultado['mensaje'] = $e->getMessage();
}
header('Content-Type: application/json');
echo(json_encode($resultado));


