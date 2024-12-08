<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    die("<script>alert('Você não está logado. Inicie uma sessão.'); window.location.href = 'login.html';</script>");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1 class="title">Área Restrita</h1>
        <a href="crud.php" class="href-submit">Administração de Usuários</a>
        <a href="logout.php" class="href-submit">Logout</a>

</body>

</html>