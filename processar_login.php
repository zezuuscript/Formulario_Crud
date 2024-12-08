<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teste_formulario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Erro de conexão com o banco de dados."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$login = $conn->real_escape_string($data['login']);
$senha = $conn->real_escape_string($data['senha']);



$sql = "SELECT * FROM usuarios WHERE login = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($senha, $row["senha"])) {
        echo json_encode(["success" => true]);

        session_start();

        $_SESSION['login'] = $row['id'];
    } else {
        echo json_encode(["success" => false, "message" => "Senha incorreta."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Login não encontrado."]);
}

$conn->close();
