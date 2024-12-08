<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teste_formulario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    die("<script>alert('Você não está logado. Inicie uma sessão.'); window.location.href = 'login.html';</script>");
}

// -- Filtro de Usuários --

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$cepFilter = isset($_GET['cep']) ? $_GET['cep'] : '';
$idadeFilter = isset($_GET['idade']) ? $_GET['idade'] : '';

$sql = "SELECT * FROM usuarios WHERE 1=1";

if ($cepFilter) {
    $sql .= " AND cep LIKE '%$cepFilter%'";
}
if ($idadeFilter) {
    $sql .= " AND idade = $idadeFilter";
}

// -- Lista de Usuários --

$sql .= " ORDER BY nome LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$total_result = $conn->query("SELECT COUNT(*) AS total FROM usuarios WHERE 1=1" .
    ($cepFilter ? " AND cep LIKE '%$cepFilter%'" : '') .
    ($idadeFilter ? " AND idade = $idadeFilter" : ''));
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1 class="title">Administração de Usuários</h1>

        <div id="filter-button">
            <form method="GET" action="">
                <label for="cep">Filtrar por CEP:</label>
                <input type="text" id="cep" name="cep" value="<?= $cepFilter ?>">

                <label for="idade">Filtrar por Idade:</label>
                <input type="text" id="idade" name="idade" value="<?= $idadeFilter ?>">

                <button class="button-filter" type="submit">Filtrar</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOME</th>
                    <th scope="col">IDADE</th>
                    <th scope="col">CEP</th>
                    <th scope="col">RUA</th>
                    <th scope="col">BAIRRO</th>
                    <th scope="col">CIDADE</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">EXCLUIR</th>
                    <th scope="col">EDITAR</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["nome"] ?></td>
                        <td><?= $row["idade"] ?></td>
                        <td><?= $row["cep"] ?></td>
                        <td><?= $row["rua"] ?></td>
                        <td><?= $row["bairro"] ?></td>
                        <td><?= $row["cidade"] ?></td>
                        <td><?= $row["estado"] ?></td>
                        <td><button class="button-crud" id="excluir" data-id="<?= $row['id'] ?>">Excluir</button></td>
                        <td>
                            <button class="button-crud" id="editar" data-id="<?= $row['id'] ?>"
                                data-nome="<?= $row['nome'] ?>"
                                data-idade="<?= $row['idade'] ?>"
                                data-cep="<?= $row['cep'] ?>"
                                data-rua="<?= $row['rua'] ?>"
                                data-bairro="<?= $row['bairro'] ?>"
                                data-cidade="<?= $row['cidade'] ?>"
                                data-estado="<?= $row['estado'] ?>">Editar</button>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="area_restrita.php" class="back-button">Voltar Página</a>
        <dialog id="editDialog">
            <form method="POST" action="editar.php">

                <h2>Editar Usuário</h2>
                <input type="hidden" id="editId" name="id">

                <label for="editNome">Nome:</label>
                <input type="text" id="editNome" name="nome" required>

                <label for="editIdade">Idade:</label>
                <input type="number" id="editIdade" name="idade" required>

                <label for="editCep">CEP:</label>
                <input type="text" id="editCep" name="cep" required>

                <label for="editRua">Rua:</label>
                <input type="text" id="editRua" name="rua" required>

                <label for="editBairro">Bairro:</label>
                <input type="text" id="editBairro" name="bairro" required>

                <label for="editCidade">Cidade:</label>
                <input type="text" id="editCidade" name="cidade" required>

                <label for="editEstado">Estado:</label>
                <input type="text" id="editEstado" name="estado" required>

                <div style="margin-top: 20px;">
                    <button type="submit" class="button-save">Salvar</button>
                    <button type="button" class="button-cancel" onclick="closeDialog()">Cancelar</button>
                </div>
            </form>
        </dialog>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=1&cep=<?= $cepFilter ?>&idade=<?= $idadeFilter ?>">Primeira</a>
                <a href="?page=<?= $page - 1 ?>&cep=<?= $cepFilter ?>&idade=<?= $idadeFilter ?>">Anterior</a>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1 ?>&cep=<?= $cepFilter ?>&idade=<?= $idadeFilter ?>">Próxima</a>
                <a href="?page=<?= $total_pages ?>&cep=<?= $cepFilter ?>&idade=<?= $idadeFilter ?>">Última</a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const token = "token_teste";

        fetch(`http://seu-dominio.com/api.php?action=list&token=${token}`)
            .then(response => response.json())
            .then(data => {
                console.log("Usuários:", data.usuarios);
            })
            .catch(error => console.error("Erro:", error));

        const cep = "12345";
        fetch(`http://seu-dominio.com/api.php?action=search&cep=${cep}&token=${token}`)
            .then(response => response.json())
            .then(data => {
                console.log("Usuários encontrados:", data.usuarios);
            })
            .catch(error => console.error("Erro:", error));

        document.querySelectorAll("#excluir").forEach(button => {
            button.addEventListener("click", async function(event) {
                event.preventDefault();

                const userId = this.getAttribute("data-id");

                const response = await fetch("excluir.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `id=${userId}`,
                });

                const result = await response.text();
                if (result === "success") {
                    alert("Usuário excluído com sucesso!");
                    window.location.reload();
                } else {
                    alert("Erro ao excluir o usuário.");
                }
            });
        });

        document.querySelectorAll("#editar").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nome = this.getAttribute("data-nome");
                const idade = this.getAttribute("data-idade");
                const cep = this.getAttribute("data-cep");
                const rua = this.getAttribute("data-rua");
                const bairro = this.getAttribute("data-bairro");
                const cidade = this.getAttribute("data-cidade");
                const estado = this.getAttribute("data-estado");

                document.getElementById("editNome").value = nome;
                document.getElementById("editIdade").value = idade;
                document.getElementById("editCep").value = cep;
                document.getElementById("editRua").value = rua;
                document.getElementById("editBairro").value = bairro;
                document.getElementById("editCidade").value = cidade;
                document.getElementById("editEstado").value = estado;
                document.getElementById("editId").value = id;

                document.getElementById("editDialog").showModal();
            });
        });

        function closeDialog() {
            document.getElementById("editDialog").close();
        }
    </script>
</body>

</html>