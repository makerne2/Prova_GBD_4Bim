-- Cadastro de venda.
DROP PROCEDURE IF EXISTS sp_addUsuario;
DELIMITER $$
	CREATE PROCEDURE sp_addUsuario
	BEGIN
		INSERT INTO usuario
		VALUES ();
	END;$$
DELIMITER ;

-- Mostra vendas do usuario
DROP PROCEDURE IF EXISTS sp_selVendaPorUsuario;
DELIMITER $$
	CREATE PROCEDURE sp_selVendaPorUsuario (v_idUsuario INT)
	BEGIN
		SELECT * 
		FROM venda 
		WHERE idUsuario = v_idUsuario
		ORDER BY dataVenda;
	END; $$
DELIMITER ;

-- Cadastro de venda.
DROP PROCEDURE IF EXISTS sp_addVenda;
DELIMITER $$
	CREATE PROCEDURE sp_addVenda (v_idUsuario INT, v_dataVenda DATE)
	BEGIN
		INSERT INTO venda 
		VALUES (NULL, v_idUsuario, v_dataVenda);
	END;$$
DELIMITER ;

-- Cadastro de ItemVenda
DROP PROCEDURE IF EXISTS sp_addItemVenda;
DELIMITER $$
	CREATE PROCEDURE sp_addItemVenda (v_codVenda INT, v_codProduto INT, v_quantidade INT)
	BEGIN
		INSERT INTO itemVenda 
		VALUES (v_codVenda, v_codProduto, v_quantidade);
	END;$$
DELIMITER ;

-- Delete ItemVenda
DROP PROCEDURE IF EXISTS sp_remItemVenda;
DELIMITER $$
	CREATE PROCEDURE sp_remItemVenda(v_codVenda INT, v_codProduto INT)
	BEGIN
		DELETE FROM itemvenda 
		WHERE codVenda = v_codVenda AND codProduto = v_codProduto;
	END;$$
DELIMITER ;