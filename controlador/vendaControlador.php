<?php

require_once 'modelo/produtoModelo.php';

function index()
{
	$dados = array();
	$dados['pedidos'] = allPedido();
	exibir("venda/index", $dados);
}

function salvaPedido()
{
	$produtos = $_SESSION['carrinho'];

	$usuario = acessoPegarUsuarioLogado();
	$data = date('Y-m-d');

	addVenda($usuario, $data, $produtos);
	redirecionar("usuario/");
}
