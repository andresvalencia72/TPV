CREATE TRIGGER `aumentar_cod_ticket` BEFORE INSERT ON `tickets`
FOR EACH ROW 
BEGIN
    DECLARE next_cod INT;
    SELECT IFNULL(MAX(cod_ticket), 0) + 1 INTO next_cod FROM tickets;
    SET NEW.cod_ticket = next_cod;
END