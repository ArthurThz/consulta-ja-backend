<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: Application/JSON; charset=UTF-8");

include_once "connection.php";


$id = $_GET['id'];

$query_delete = "DELETE FROM consulta WHERE id_consulta = $id";

$result_delete = $conn->prepare($query_delete);

if ($result_delete->execute()) {
    $response = [
        "erro" => false,
        "message" => "Consulta desmarcada com sucesso!"
    ];
} else {
    $response = [
        "erro" => true,
        "message" => "Não foi possivel desmarcar a consulta!"
    ];
}

http_response_code(200);
echo json_encode($response);
