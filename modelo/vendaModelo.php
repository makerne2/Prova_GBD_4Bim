<?php
function allPedido()
{
	$sql = "SELECT *endereco.* 
			FROM pedido 
			ORDER BY dataCompra";
	$resultado = mysqli_query(conn(), $sql);
	$pedidos = array();
	while ($linha = mysqli_fetch_assoc($resultado)) {
		$pedidos[] = $linha;
	}
	return $pedidos;
}

function getVendaByUser($idUsuario)
{
	$sql = "CALL sp_selVendaPorUsuario($idUsuario)";
	$resultado = mysqli_query(conn(), $sql);
	$vendas = array();
	while ($linha = mysqli_fetch_assoc($resultado)) {
		$vendas[] = $linha;
	}
	return $vendas;
}

function addVenda(
	$usuario,
	$dataVenda,
	$produtos
)
{
	$sql = "CALL sp_addVenda ('$usuario', '$dataVenda')";
	$resultado = mysqli_query(conn(), $sql);

	$id_venda = mysqli_insert_id(conn());

	foreach ($produtos as $produto) {
		$id_produto = $produto['codVenda'];
		$quantidade = $produto['quantidade'];

		$sql = "CALL sp_addItemVenda ('$id_venda', '$id_produto', '$quantidade')";
		$resultado = mysqli_query(conn(), $sql);
	}
	return true;
}
