<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>

</head>
	<script>
    function formatar(mascara, documento) {
        var i = documento.value.length;
        var saida = mascara.substring(0, 1);
        var texto = mascara.substring(i)
        if (texto.substring(0, 1) != saida) {
            documento.value += texto.substring(0, 1);
        }
    }
</script>
<body>
	<h1>Cadastro do Cliente</h1>
	<form action="" method="POST">
	  <label>RG:</label><br>
	  <input type="text" name="rg" maxlength="12"><br>
	  <label>Nome:</label><br>
	  <input type="text" name="nome" maxlength="60"><br><br>
	<button type="submit">Enviar</button>

<?php if (isset($clientes)): ?>
	<table class="table" border="1">
        <thead>
            <tr>RG</tr>
            <tr>Nome</tr>
        </thead>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
				<td><?= $cliente['rg'] ?></a></td>
				<td><?= $cliente['nome'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
</body>
</html>

<?php 
require_once "conexao_banco.php";
function sp_cadastro_de_cliente($rg,$nome){}
?>

<?php
function adicionar(){
	if (ehPost()) {
		$rg   = 	$_POST["rg"]
		$nome = 	$_POST["nome"];

		$dados['clientes'] = sp_cadastro_de_cliente($rg,$nome);
		exibir("prova.gbd_4bim.php", $dados);
		}
	else {
		exibir("prova.gbd_4bim.php");
	}
}
?>