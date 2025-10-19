<?php
function validarNome($nome)
{
    $nome = trim($nome); // remove espaços
    if (empty($nome)) {
        return "O nome não pode ser vazio.";
    }
    if (strlen($nome) < 2 || strlen($nome) > 100) {
        return "O nome deve ter entre 2 e 100 caracteres.";
    }
    if (!preg_match("/^[a-zA-ZÀ-ú\s'-]+$/u", $nome)) {
        return "O nome contém caracteres inválidos.";
    }
    return true;
}

function validarEmail($email)
{
    $email = trim($email);
    if (empty($email)) {
        return "O email não pode ser vazio.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Email inválido.";
    }
    // Evitar scripts maliciosos
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    return true;
}

function validarTelefone($telefone)
{
    $telefone = preg_replace("/[^0-9]/", "", $telefone); // remove tudo que não for número
    if (empty($telefone)) {
        return "O telefone não pode ser vazio.";
    }
    if (strlen($telefone) < 10 || strlen($telefone) > 13) {
        return "O telefone deve ter entre 10 e 13 números.";
    }
    return true;
}
