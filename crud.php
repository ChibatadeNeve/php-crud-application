<?php
// ======= CONEXÃO COM O BANCO =======
$host = "localhost";
$user = "root";
$pass = "";
$db   = "crud";

$conexao = new mysqli($host, $user, $pass, $db);
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// ======= FUNÇÕES =======
require_once "funcoes.php"; // Certifique-se de que esse arquivo existe

// ======= VARIÁVEIS =======
$acao = $_GET['acao'] ?? '';
$id = $_GET['id'] ?? 0;
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$postAcao = $_POST['acao'] ?? '';
$cliente = null;

// ======= EDITAR (CARREGAR DADOS) =======
if ($acao === "editar" && $id > 0) {
    $resultado = $conexao->query("SELECT * FROM usuarios WHERE id = $id");
    if ($resultado && $resultado->num_rows > 0) {
        $cliente = $resultado->fetch_assoc();
    }
}

// ======= EXCLUIR =======
if ($acao === "excluir" && $id > 0) {
    $conexao->query("DELETE FROM usuarios WHERE id=$id");
    header("Location: crud.php");
    exit;
}

// ======= INSERIR / ATUALIZAR =======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erroNome = validarNome($nome);
    $erroEmail = validarEmail($email);
    $erroTelefone = validarTelefone($telefone);

    if ($erroNome === true && $erroEmail === true && $erroTelefone === true) {
        if ($postAcao === 'inserir') {
            $conexao->query("INSERT INTO usuarios (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')");
        } elseif ($postAcao === 'atualizar' && $_POST['id'] > 0) {
            $conexao->query("UPDATE usuarios SET nome='$nome', email='$email', telefone='$telefone' WHERE id=" . $_POST['id']);
        }
        header("Location: crud.php");
        exit;
    } else {
        echo $erroNome !== true ? $erroNome . "<br>" : "";
        echo $erroEmail !== true ? $erroEmail . "<br>" : "";
        echo $erroTelefone !== true ? $erroTelefone . "<br>" : "";
    }
}
?>
<!DOCTYPE html>
<html lang="PT-BT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pietro - Cadastro de Clientes</title>
    <link rel="icon" href="IMG/IMG Config.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
        }

        .titulo,
        .rodape {
            text-align: center;
            margin-bottom: 20px;
        }

        h1,
        h2 {
            margin-bottom: 15px;
            text-align: center;
        }

        .formulario form {
            display: flex;
            flex-direction: column;
            max-width: 600px;
            width: 100%;
            margin: 0 auto 30px auto;
        }

        .formulario label {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .formulario input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .formulario button {
            margin-top: 15px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .formulario button:hover {
            background-color: #218838;
        }

        .lista table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        .lista th,
        .lista td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .lista th {
            background-color: #007bff;
            color: white;
        }

        button.editar,
        button.excluir {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button.editar {
            background-color: #ffc107;
            color: #333;
        }

        button.excluir {
            background-color: #dc3545;
            color: white;
        }

        .rodape {
            margin-top: 40px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <header class="titulo">
        <h1>Sistema de Cadastro de Clientes</h1>
    </header>

    <main>
        <section class="formulario">
            <h2><?= $cliente ? 'Editar Cliente' : 'Cadastrar Cliente' ?></h2>
            <form method="POST" class="formulario">
                <input type="hidden" id="id" name="id" value="<?= $cliente['id'] ?? '' ?>">

                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cliente['nome'] ?? '') ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente['email'] ?? '') ?>" required>

                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente['telefone'] ?? '') ?>" required>

                <button type="submit" name="acao" value="<?= $cliente ? 'atualizar' : 'inserir' ?>">
                    <?= $cliente ? 'Atualizar' : 'Salvar' ?>
                </button>
            </form>
        </section>

        <section class="lista">
            <h2>Lista de Clientes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tabela-clientes">
                    <?php
                    $resultado = $conexao->query("SELECT * FROM usuarios ORDER BY id DESC");
                    if ($resultado && $resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$linha['id']}</td>";
                            echo "<td>" . htmlspecialchars($linha['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($linha['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($linha['telefone']) . "</td>";
                            echo "<td>
                                <a href='crud.php?acao=editar&id={$linha['id']}'><button class='editar'>Editar</button></a>
                                <a href='crud.php?acao=excluir&id={$linha['id']}' onclick='return confirm(\"Deseja excluir este cliente?\");'><button class='excluir'>Excluir</button></a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum cliente cadastrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer class="rodape">
        <p>CRUD Sistema - Desenvolvido por Pietro Miguel</p>
    </footer>
</body>

</html>