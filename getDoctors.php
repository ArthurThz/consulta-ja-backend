<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: Application/JSON; charset=UTF-8");

include_once "connection.php";

$especialidade = $_GET['especialidade'];


$query_doctors = "SELECT * FROM medico WHERE id_especialidade = $especialidade";

$result_doctors = $conn->prepare($query_doctors);

$result_doctors->execute();

if (($result_doctors) and ($result_doctors->rowCount() != 0)) {
    while ($row_doctors = $result_doctors->fetch(PDO::FETCH_ASSOC)) {
        extract($row_doctors);

        $doctors_list["doctors"][$id] = [
            'id' => $id,
            'nome' => $nome,
            'id_especialidade' => $id_especialidade,
            'nome_especialidade' => $nome_especialidade,


        ];
    }

    http_response_code(200);

    echo json_encode($doctors_list);
}
