<?php

header("Acess-Control-Allow-Origin: *");
header("Content-Type: Application/JSON; charset=UTF-8");

include_once "connection.php";

$query_users = "SELECT * FROM usuario";

$result_users = $conn->prepare($query_users);

$result_users->execute();

if (($result_users) and ($result_users->rowCount() != 0)) {
    while ($row_user = $result_users->fetch(PDO::FETCH_ASSOC)) {
        extract($row_user);

        $users_list["records"][$id] = [
            'id' => $id,
            'nome' => $nome,
            'senha' => $senha
        ];
    }

    http_response_code(200);

    echo json_encode($users_list);
}
