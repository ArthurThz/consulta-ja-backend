<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: Application/JSON; charset=UTF-8");

include_once "connection.php";


$cpf_paciente = $_GET['cpf'];

$query_appointment = "SELECT * FROM consulta WHERE cpf_paciente = $cpf_paciente";

$result_appointment = $conn->prepare($query_appointment);

$result_appointment->execute();

if (($result_appointment) and ($result_appointment->rowCount() != 0)) {
    while ($row_appointment = $result_appointment->fetch(PDO::FETCH_ASSOC)) {
        extract($row_appointment);

        $appointment_list["appointment"][$id_consulta] = [
            'id_consulta' => $id_consulta,
            'nome_medico' => $nome_medico,
            'nome_paciente' => $nome_paciente,
            'nome_especialidade' => $nome_especialidade,
            'cpf_paciente' => $cpf_paciente,
        ];
    }

    http_response_code(200);

    echo json_encode($appointment_list);
}
