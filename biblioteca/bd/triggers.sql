-- Update quantidade do produto pós-venda
DROP TRIGGER IF EXISTS tr_attQuantProduto;
DELIMITER $$
	CREATE TRIGGER tr_attQuantProduto
	AFTER INSERT ON itemVenda
	FOR EACH ROW
	BEGIN
		UPDATE produto 
		SET quantidade = quantidade - NEW.quantidade
		WHERE produto.codProduto = NEW.codProduto;
	END;$$
DELIMITER ;

-- Restaurar quantidade de produto
DROP TRIGGER IF EXISTS tr_resQuantProduto;
DELIMITER $$
	CREATE TRIGGER tr_resQuantProduto
	AFTER DELETE ON itemVenda
	FOR EACH ROW 
	BEGIN
		UPDATE produto
		SET produto.quantidade = produto.quantidade + OLD.quantidade
		WHERE produto.codProduto = OLD.codProduto;
	END;$$
DELIMITER ;

-- Cancelar cadastro de venda
DROP TRIGGER IF EXISTS tr_cancelAddVenda;
DELIMITER $$
	CREATE TRIGGER tr_cancelAddVenda
	BEFORE INSERT ON venda
	FOR EACH ROW
	BEGIN
		IF (NEW.dataVenda = 0) OR (NEW.dataVenda > CURDATE()) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data de Venda inválida!";
		END IF;
	END;$$
DELIMITER ;


-- Insert LOGPRODUTO
DROP TRIGGER IF EXISTS tr_addLogProduto;
DELIMITER $$
	CREATE TRIGGER tr_addLogProduto
	AFTER INSERT ON produto
	FOR EACH ROW
	BEGIN
		SET @dadosNovos = CONCAT(NEW.codProduto, ' # ', NEW.descricao, ' # ', NEW.quantidade);
		SET @DataProduto = SYSDATE();
		SET @usuario = CURRENT_USER();
		INSERT INTO log_produto VALUES(NULL, @DataProduto, @usuario, "INSERT", " - # - # - ", @dadosNovos);
	END;$$
DELIMITER ;

-- Update LOGPRODUTO
DROP TRIGGER IF EXISTS tr_uptLogProduto;
DELIMITER $$
	CREATE TRIGGER tr_uptLogProduto
	AFTER UPDATE ON produto
	FOR EACH ROW
	BEGIN
		SET @dadosAntigos = CONCAT(OLD.codProduto, " # ", OLD.descricao, " # ", OLD.quantidade);
		SET @dadosNovos = CONCAT(NEW.codProduto, ' # ', NEW.descricao, ' # ', NEW.quantidade);
		SET @DataProduto = SYSDATE();
		SET @usuario = CURRENT_USER();

		INSERT INTO log_produto VALUES(NULL, @DataProduto, @usuario, "UPDATE", @dadosAntigos, @dadosNovos);
	END;$$
DELIMITER ;

-- Delete LOGPRODUTO
DROP TRIGGER IF EXISTS tr_remLogProduto;
DELIMITER $$
	CREATE TRIGGER tr_remLogProduto
	BEFORE DELETE ON produto
	FOR EACH ROW
	BEGIN
		SET @dadosAntigos = CONCAT(OLD.codProduto, " # ", OLD.descricao, " # ", OLD.quantidade);
		SET @DataProduto = SYSDATE();
		SET @usuario = CURRENT_USER();

		INSERT INTO log_produto VALUES(NULL, @DataProduto, @usuario, "DELETE", @dadosAntigos, " - # - # - ");
	END;$$
DELIMITER ;

-- Insert LOGVENDA
DROP TRIGGER IF EXISTS tr_addLogVenda;
DELIMITER $$
	CREATE TRIGGER tr_addLogVenda
	AFTER INSERT ON venda
	FOR EACH ROW
	BEGIN
		SET @dadosNovos = CONCAT(NEW.codVenda, ' # ', NEW.idCliente, ' # ', NEW.dataVenda);
		SET @DataVenda = SYSDATE();
		SET @usuario = CURRENT_USER();
		INSERT INTO log_venda VALUES(NULL, @DataVenda, @usuario, "INSERT", " - # - # - ", @dadosNovos);
	END;$$
DELIMITER ;

-- Update LOGVENDA
DROP TRIGGER IF EXISTS tr_uptLogVenda;
DELIMITER $$
	CREATE TRIGGER tr_uptLogVenda
	AFTER UPDATE ON venda
	FOR EACH ROW
	BEGIN
		SET @dadosAntigos = CONCAT(OLD.codVenda, " # ", OLD.idCliente, " # ", OLD.dataVenda);
		SET @dadosNovos = CONCAT(NEW.codVenda, ' # ', NEW.idCliente, ' # ', NEW.dataVenda);
		SET @DataVenda = SYSDATE();
		SET @usuario = CURRENT_USER();

		INSERT INTO log_venda VALUES(NULL, @DataVenda, @usuario, "UPDATE", @dadosAntigos, @dadosNovos);
	END;$$
DELIMITER ;
