CREATE DATABASE cupcake;

CREATE TABLE produtos (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(45) NOT NULL,
  imagem varchar(80) NOT NULL,
  preco decimal(5,2) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO produtos VALUES (2,'Cupcake de Red Velvet','cupcake-redvelvet.jpeg',10.00),(4,'Cupcake de Mousse','cupcake-mousse.jpeg',13.80),
  (13,'Cupcake de Abacaxi','cupcake-abacaxi.jpeg',12.50);

CREATE TABLE itens_carrinho (
  id int NOT NULL AUTO_INCREMENT,
  id_produto int NOT NULL,
  nome_produto varchar(255) NOT NULL,
  preco decimal(5,2) NOT NULL,
  quantidade int NOT NULL,
  PRIMARY KEY (id),
  KEY id_produto (id_produto),
  CONSTRAINT itens_carrinho_ibfk_1 FOREIGN KEY (id_produto) REFERENCES produtos (id) ON DELETE CASCADE
