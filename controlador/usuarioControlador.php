<?php

require_once "modelo/usuarioModelo.php";

/** admin */
function index()
{
	$dados = array();
	$dados["usuarios"] = allUsuario();
	exibir("usuario/index", $dados);
}

/** anon */
function visualizar($id)
{
	$dados = array();
	$dados["usuario"] = 	viewUsuario($id);
	exibir("usuario/visualizar", $dados);
}

/** anon */
function deletar($id) {
	delUsuario($id);
	redirecionar("usuario/");
}

/** anon */
function adicionar()
{
	if (ehPost()) {
		$nome = 		$_POST["nome"];
		$rg = 			$_POST["rg"];
		$senha = 		$_POST["senha"];

		addUsuario(
			$nome,
			$rg,
			$senha,
			'user'
		);

		redirecionar("login/index");
	} else {
		exibir("usuario/cadastro");
	}
}

/** anon */
function editar($id)
{
	if (ehPost()) {
		$nome = 		$_POST["nome"];
		$rg = 			$_POST["rg"];
		$senha = 		$_POST["senha"];

		editUsuario(
			$id,
			$nome,
			$rg,
			$senha
		);

		redirecionar("usuario/visualizar/$id");
	} else {
		$dados["usuario"] = viewUsuario($id);
		exibir("usuario/editar", $dados);
	}
}