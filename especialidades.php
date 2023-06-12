<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: Application/JSON; charset=UTF-8");

include_once "connection.php";

$query_especialidades = "SELECT * FROM especialidades";

$result_especialidades = $conn->prepare($query_especialidades);

$result_especialidades->execute();

if (($result_especialidades) and ($result_especialidades->rowCount() != 0)) {
    while ($row_especialidades = $result_especialidades->fetch(PDO::FETCH_ASSOC)) {
        extract($row_especialidades);

        $especialidades_list["records"][$id] = [
            'id' => $id,
            'especialidade' => $especialidade,

        ];
    }

    http_response_code(200);

    echo json_encode($especialidades_list);
}
