<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: Application/JSON; charset=UTF-8");

include_once "connection.php";

$id_user = $_GET['cpf'];
$senha_user = $_GET['senha'];

$query_users = "SELECT * FROM paciente WHERE cpf = $id_user AND senha = $senha_user";

$result_users = $conn->prepare($query_users);

$result_users->execute();

if (($result_users) and ($result_users->rowCount() != 0)) {
    while ($row_users = $result_users->fetch(PDO::FETCH_ASSOC)) {
        extract($row_users);

        $users_list["user"] = [
            'cpf' => $cpf,
            'nome' => $nome,
            'sobrenome' => $sobrenome,
            'data de nascimento' => $data_nascimento,
            'senha' => $senha,
            'sexo' => $sexo,
            'telefone' => $telefone,
            'email' => $email
        ];
    }

    http_response_code(200);

    echo json_encode($users_list);
}
