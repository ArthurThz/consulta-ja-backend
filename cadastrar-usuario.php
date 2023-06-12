<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: Application/JSON; charset=UTF-8");

include_once "connection.php";

$response_json = file_get_contents("php://input");

$dados = json_decode($response_json, true);



if ($dados) {

    $query_usuarios = "INSERT INTO paciente (nome, sobrenome, data_nascimento, cpf, senha, sexo, telefone, email) values
     (:nome,:sobrenome,:data_nascimento,:cpf,:senha,:sexo,:telefone,:email)";

    $cad_user = $conn->prepare($query_usuarios);

    $cad_user->bindParam(':nome', $dados['Nome']);
    $cad_user->bindParam(':sobrenome', $dados['Sobrenome']);
    $cad_user->bindParam(':data_nascimento', $dados['Nascimento']);
    $cad_user->bindParam(':cpf', $dados['cpf']);
    $cad_user->bindParam(':senha', $dados['Senha']);
    $cad_user->bindParam(':sexo', $dados['Sexo']);
    $cad_user->bindParam(':telefone', $dados['Telefone']);
    $cad_user->bindParam(':email', $dados['Email']);

    $cad_user->execute();

    if ($cad_user->rowCount()) {
        $response = [
            'error' => true,
            'message' => 'Usuário cadastrado com sucesso!'
        ];
    } else {
        $response = [
            'error' => true,
            'message' => 'Não foi possivel cadastrar o usuário'
        ];
    }
} else {
    $response = [
        'error' => true,
        'message' => 'Não foi possivel cadastrar o usuário'
    ];
}


http_response_code(200);

echo json_encode($response);
