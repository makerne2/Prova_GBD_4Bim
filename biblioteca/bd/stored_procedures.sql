-- Cadastro de venda.
DROP PROCEDURE IF EXISTS sp_addVenda;
DELIMITER $$
	CREATE PROCEDURE sp_addVenda (v_idUsuario INT, v_dataVenda DATE)
	BEGIN
		IF(v_idUsuario != 0) AND (v_dataVenda != 0) THEN
		INSERT INTO venda 
			VALUES (NULL, v_idUsuario, v_dataVenda);
		ELSE
			SELECT "Informe valores válidos" AS Msg;
		END IF;
	END;$$
DELIMITER ;

-- Cadastro de ItemVenda
DROP PROCEDURE IF EXISTS sp_addItemVenda;
DELIMITER $$
	CREATE PROCEDURE sp_addItemVenda (v_codVenda INT, v_codProduto INT, v_quantidade INT)
	BEGIN
		IF(v_codVenda != 0) AND (v_codProduto != 0) AND (v_quantidade != 0) THEN
			SET @quantidadeProduto = (SELECT quantidade FROM produto WHERE codProduto = v_codProduto);
			IF(v_quantidade < @quantidadeProduto) THEN
				INSERT INTO itemVenda 
				VALUES (v_codVenda, v_codProduto, v_quantidade);
			ELSE
				SELECT "Estoque Insuficiente" AS Msg;
			END IF;
		ELSE
			SELECT "Informe valores válidos" AS Msg;
		END IF;
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

