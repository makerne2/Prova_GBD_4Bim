<?php

require_once "modelo/produtoModelo.php";

/** admin */
function index()
{
	$dados = array();
	$dados["produtos"] = allProduto();
	exibir("produtos/index", $dados);
}

/** anon */
function visualizar($id)
{
	$dados = array();
	$dados["produto"] = viewProduto($id);
	exibir("produtos/visualizar", $dados);
}

/** admin */
function deletar($id)
{
	delProduto($id);
	redirecionar("produto/");
}

/** admin */
function adicionar()
{
	if (ehPost()) {
		$nome = 			$_POST["nome"];
		$quantidade = 		$_POST["quantidade"];

		addProduto(
			$nome,
			$quantidade
		);

		redirecionar("produto/");
	} else {
		exibir("produtos/adicionar");
	}
}

/** admin */
function editar($id)
{
	if (ehPost()) {
		$nome = 			$_POST["nome"];
		$quantidade = 		$_POST["quantidade"];

		editProduto(
			$id,
			$nome,
			$quantidade
		);

		redirecionar("produto/");
	} else {
		$dados["produto"] = viewProduto($id);
		exibir("produtos/editar", $dados);
	}
}