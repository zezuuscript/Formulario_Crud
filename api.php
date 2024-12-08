<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teste_formulario";

$api_token = "token_teste";

if (!isset($_GET['token']) || $_GET['token'] !== $api_token) {
    http_response_code(401);
    echo json_encode(["error" => "Token de acesso inválido ou não fornecido."]);
    exit;
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Falha na conexão com o banco de dados: " . $conn->connect_error]);
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === "list") {
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    $usuarios = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
    }

    echo json_encode(["usuarios" => $usuarios]);
} elseif ($action === "search") {
    $cep = isset($_GET['cep']) ? $_GET['cep'] : '';
    if (empty($cep)) {
        http_response_code(400);
        echo json_encode(["error" => "O parâmetro 'cep' é obrigatório."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cep LIKE ?");
    $cep_like = "%$cep%";
    $stmt->bind_param("s", $cep_like);
    $stmt->execute();
    $result = $stmt->get_result();

    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }

    echo json_encode(["usuarios" => $usuarios]);
} else {
    http_response_code(400);
    echo json_encode(["error" => "Ação inválida. Use 'list' ou 'search'."]);
}

$conn->close();
