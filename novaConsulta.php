<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: Application/JSON; charset=UTF-8");

include_once "connection.php";

$response_json = file_get_contents("php://input");

$dados = json_decode($response_json, true);



if ($dados) {

    $query_nova_consulta = "INSERT INTO consulta (nome_medico, nome_paciente, nome_especialidade, cpf_paciente) values
     (:nomeMedico,:nomePaciente,:nomeEspecialidade,:cpfPaciente)";

    $cad_nova_consulta = $conn->prepare($query_nova_consulta);

    $cad_nova_consulta->bindParam(':nomeMedico', $dados['medico']);
    $cad_nova_consulta->bindParam(':nomePaciente', $dados['paciente']);
    $cad_nova_consulta->bindParam(':nomeEspecialidade', $dados['especialidade']);
    $cad_nova_consulta->bindParam(':cpfPaciente', $dados['cpf']);


    $cad_nova_consulta->execute();

    if ($cad_nova_consulta->rowCount()) {
        $response = [
            'error' => false,
            'message' => 'Consulta cadastrada com sucesso!'
        ];
    } else {
        $response = [
            'error' => true,
            'message' => 'Não foi possivel cadastrar a consulta'
        ];
    }
} else {
    $response = [
        'error' => true,
        'message' => 'Não foi possivel cadastrar a consulta'
    ];
}


http_response_code(200);

echo json_encode($response);
