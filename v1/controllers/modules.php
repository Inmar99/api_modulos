<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  

require "../config/connection.php";
require "../models/modules.php";

$connection = new Connection();
$database = $connection->getConnection();

/* Inicializando objeto Modulos */
$modules = new Modules($database);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $modules->ListDataToId($id);
	}
    else {
        $stmt = $modules->ListData();
    }
    $num = $stmt->rowCount();
        if($num>0){
            $modules_arr=array();
            $modules_arr["modules"]=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $modules_item=array(
                    "id" => $id,
                    "internal_code" => $internal_code,
                    "name" => html_entity_decode($name),
                    "description" => html_entity_decode($description),
                );
                array_push($modules_arr["modules"], $modules_item);
            }
            // Enviamos un mensaje de respuesta "200 OK"
            http_response_code(200);
            echo json_encode($modules_arr);
        }else{
        // Enviamos un mensaje de respuesta de error "404 Not found"
        http_response_code(404);
        echo json_encode(
            array("message" => "No se encontraron modulos que listar.")
        );
    }
    
}else if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));
        if(
            !empty($data->internal_code) &&
            !empty($data->name) &&
            !empty($data->description) 
        ){
            $modules->internal_code = $data->internal_code;
            $modules->name = $data->name;
            $modules->description = $data->description;
        
            if($modules->Created()){
                http_response_code(201);
                echo json_encode(array("message" => "El nuevo modulo ha sido creado."));
            }else{
        
                http_response_code(503);
                echo json_encode(array("message" => "No se puede crear el modulo."));
            }
        }
        else{
            http_response_code(400);
            echo json_encode(array("message" => "No se puede crear el modulo, los datos estan incompletos."));
        }
}else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    $data = json_decode(file_get_contents("php://input"));

    $modules->id = $data->id;
    $modules->internal_code = $data->internal_code;
    $modules->name = $data->name;
    $modules->description = $data->description;

    if($modules->Updated()){
        http_response_code(201);
        echo json_encode(array("message" => "El modulo ha sido actualizado."));
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "No se puede actualizar el modulo."));
    }
    
}else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
   
    $data = json_decode(file_get_contents("php://input"));
    $modules->id = $data->id;
  
    if($modules->Deleted()){
        http_response_code(200);
        echo json_encode(array("message" => "El modulo con id ". $data->id ." ha sido eliminado"));
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "No se puede eliminar el modulo"));
}
}else{
    header("HTTP/1.1 400 Bad Request");
}



  

?>