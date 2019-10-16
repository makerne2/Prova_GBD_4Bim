<?php

function allUsuario()
{
    $sql = "SELECT * 
            FROM usuario
            ORDER BY papel,nome ASC";
    $resultado = mysqli_query(conn(), $sql);
    $usuarios = array();
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $usuarios[] = $linha;
    }
    return $usuarios;
}

function viewUsuario($id)
{
    $sql = "SELECT * 
            FROM usuario 
            WHERE idUsuario = '$id'";
    $resultado = mysqli_query(conn(), $sql);
    $usuario = mysqli_fetch_assoc($resultado);
    return $usuario;
}

function delUsuario($id)
{
    $sql = "DELETE FROM usuario 
            WHERE idUsuario = '$id'";
    $resultado = mysqli_query($cnx = conn(), $sql);
    if(!$resultado) { die('Erro ao deletar usuário' . mysqli_error($cnx)); }
    return 'Usuario deletado com sucesso!';
}

function convertUsuarioAdm($id)
{
    $sql = "UPDATE usuario 
            SET papel = 'admin' 
            WHERE idUsuario = '$id'";
    $resultado = mysqli_query(conn(), $sql);
    if (!$resultado) {die('Erro ao tornar adm' . mysqli_error(conn()));}
    return 'Bem Vindo Adm';
}

function getUsuarioByNome($nome)
{
    $sql = "SELECT * 
            FROM usuario 
            WHERE nome LIKE '%$nome%' 
            ORDER BY papel,nome ASC";
    $resultado = mysqli_query(conn(), $sql);
    $usuarios = array();
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $usuarios[] = $linha;
    }
    return $usuarios;
}

function getUsuarioByRGSenha(
    $rg,
    $senha
)
{
    $sql = "SELECT * 
            FROM usuario 
            WHERE rg = '$rg' AND senha = '$senha'";
    $resultado = mysqli_query(conn(), $sql);
    $usuario = mysqli_fetch_assoc($resultado);
    return $usuario;
}

function addUsuario(
    $nome,
    $rg,
    $senha,
    $papel
)
{
    $sql = "INSERT INTO usuario 
            VALUES (
                NULL,
                '$nome',
                '$rg',
                '$senha',
                '$papel'
            )";
    $resultado = mysqli_query(conn(), $sql);
    if(!$resultado) { die('Erro ao cadastrar usuário' . mysqli_error(conn())); }
    return 'Usuario cadastrado com sucesso!';
}

function editUsuario(
    $id,
    $nome,
    $rg,
    $senha
)
{
    $sql = "UPDATE usuario 
            SET nome =          '$nome',
                rg =            '$rg',
                senha =         '$senha'
            WHERE idUsuario = '$id'";
    $resultado = mysqli_query(conn(), $sql);
    if(!$resultado) { die('Erro ao alterar usuário' . mysqli_error(conn())); }
    return 'Usuário alterado com sucesso!';
}