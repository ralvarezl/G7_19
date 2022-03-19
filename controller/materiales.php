<?php
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-header: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Materiales.php");    
    $materiales =new Materiales();// materiales es una nueva clase de la funcion que se encuentra en models//

    $body = json_decode(file_get_contents("php://input"),true);

    switch($_GET["op"]){

        case "GetMateriales":   //Obtener todos los materiales
            $datos=$materiales->get_materiales();
            echo json_encode($datos);   //Devuelve datos
        break;

        case "GetMaterial":     //Obtener un solo material
            $datos=$materiales->get_material($body["ID"]);
            echo json_encode($datos);   //Devuelve datos
        break;
            
        case "InsertMaterial":  //Insertar un material nuevo, recordando que el ID es autoincremental
            $datos=$materiales->insert_material($body["DESCRIPCION"],$body["UNIDAD"],$body["COSTO"],$body["PRECIO"],$body["APLICA_ISV"],$body["PORCENTAJE_ISV"],$body["ESTADO"],$body["ID_SOCIO"]);
            echo json_encode("Material Agregado");  //No devuelve datos
        break;
        
        case "UpdateMaterial":  //Actualizar un material existente
            $datos=$materiales->update_material($body["ID"],$body["DESCRIPCION"],$body["UNIDAD"],$body["COSTO"],$body["PRECIO"],$body["APLICA_ISV"],$body["PORCENTAJE_ISV"],$body["ESTADO"],$body["ID_SOCIO"]);
            echo json_encode("Material Actualizado");   //No devuelve datos
        break;

        case "DeleteMaterial":  //Eliminar un material existente
            $datos=$materiales->delete_material($body["ID"]);
            echo json_encode("Material Eliminado");     //No devuelve datos
        break;
    }
?>