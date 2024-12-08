<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teste_formulario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    if (empty($nome) || empty($idade) || empty($cep) || empty($rua) || empty($bairro) || empty($cidade) || empty($estado)) {
        echo "<script>alert('Todos os campos são obrigatórios!'); window.location.href = 'crud.php';</script>";
        exit;
    }

    $sql = "UPDATE usuarios SET nome=?, idade=?, cep=?, rua=?, bairro=?, cidade=?, estado=? WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssssi", $nome, $idade, $cep, $rua, $bairro, $cidade, $estado, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!'); window.location.href = 'crud.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar os dados.'); window.location.href = 'crud.php';</script>";
    }

    $stmt->close();
}

$conn->close();
