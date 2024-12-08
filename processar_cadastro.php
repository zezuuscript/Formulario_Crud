<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teste_formulario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $conn->real_escape_string($_POST['login']);
    $senha = $conn->real_escape_string($_POST['senha']);
    $nome = $conn->real_escape_string($_POST['nome']);
    $idade = $conn->real_escape_string($_POST['idade']);
    $cep = $conn->real_escape_string($_POST['cep']);
    $rua = $conn->real_escape_string($_POST['rua']);
    $bairro = $conn->real_escape_string($_POST['bairro']);
    $cidade = $conn->real_escape_string($_POST['cidade']);
    $estado = $conn->real_escape_string($_POST['estado']);

    if (empty($login) || empty($senha) || empty($nome) || empty($idade) || empty($cep) || empty($rua) || empty($bairro) || empty($cidade) || empty($estado)) {
        header("Location: cadastro.html");
        exit;
    }

    $sql_check_login = "SELECT * FROM usuarios WHERE login = ?";
    $stmt = $conn->prepare($sql_check_login);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Este login já está em uso. Escolha outro.'); window.location.href = 'cadastro.html';</script>";
        exit;
    }

    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (login, senha, nome, idade, cep, rua, bairro, cidade, estado) 
            VALUES ('$login', '$senha_criptografada', '$nome', '$idade', '$cep', '$rua', '$bairro', '$cidade', '$estado')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = 'index.html';</script>";;
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
