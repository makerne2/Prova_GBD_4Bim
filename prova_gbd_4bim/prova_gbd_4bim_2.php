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
	<h1>Cadastro do Produto</h1>
	<form action="" method="POST">
	  <label>Descrição:</label><br>
	  <input type="text" name="descricao" maxlength="45"><br>
	  <label>Quantidade:</label><br>
	  <input type="number" name="quantidade" maxlength="10"><br><br>
	  <button type="submit">Enviar</button>
	</form>
	
	</body>
</html>