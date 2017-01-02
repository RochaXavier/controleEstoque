CREATE TABLE `produto` (
	`id` int NOT NULL AUTO_INCREMENT,
	`nome` varchar(64) NOT NULL,
	`descricao` varchar(256) NOT NULL,
	`preco` double NOT NULL,
	PRIMARY KEY (`id`)
);


CREATE TABLE `cliente` (
	`id` int NOT NULL AUTO_INCREMENT,
	`nome` varchar(64) NOT NULL,
	`email` varchar(64) NOT NULL,
	`telefone` varchar(15) NOT NULL,
	PRIMARY KEY (`id`)
);


CREATE TABLE `pedido` (
	`id_produto` int NOT NULL,
	`id_cliente` int NOT NULL
);


ALTER TABLE `pedido` ADD CONSTRAINT `pedido_fk0` FOREIGN KEY (`id_produto`) REFERENCES `produto`(`id`);


ALTER TABLE `pedido` ADD CONSTRAINT `pedido_fk1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente`(`id`);

