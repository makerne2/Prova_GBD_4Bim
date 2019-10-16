<?php

function allProduto()
{
	$sql = "SELECT * 
			FROM produto";
	$resultado = mysqli_query(conn(), $sql);
	$produtos = array();
	while ($linha = mysqli_fetch_assoc($resultado)) {
		$produtos[] = $linha;
	}
	return $produtos;
}

function viewProduto($id)
{
	$sql = "SELECT *
			FROM produto
			WHERE codProduto = '$id'";
	$resultado = mysqli_query(conn(), $sql);
	$produto = mysqli_fetch_assoc($resultado);
	return $produto;
}

function delProduto($id)
{
	$sql = "DELETE FROM produto 
			WHERE codProduto = '$id'";
	$resultado = mysqli_query(conn(), $sql);
	if (!$resultado) {die('Erro ao deletar produto' . mysqli_error(conn()));}
	return 'Produto deletado com sucesso!';
}

function addProduto(
	$nome,
	$quantidade
)
{
	$sql = "INSERT INTO produto 
			VALUES(
				NULL,
				'$nome',
				'$quantidade'
			)";
	$resultado = mysqli_query(conn(), $sql);
	if (!$resultado) {die('Erro ao cadastrar produto!' . mysqli_error(conn()));}
	return 'Produto cadastrado com sucesso!';
}

function editProduto(
	$id,
	$nome,
	$quantidade
)
{
	$sql = "UPDATE produto 
			SET descricao = 	'$nome',
				quantidade = 	'$quantidade'
			WHERE codProduto = '$id'";
	$resultado = mysqli_query(conn(), $sql);
	if (!$resultado) {die('Erro ao alterar produto' . mysqli_error(conn()));}
	return 'Produto alterado com sucesso!';
}