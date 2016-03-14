CREATE TABLE unidades (
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(100) NOT NULL
);

CREATE TABLE unidade_restaurantes (
	id int PRIMARY KEY AUTO_INCREMENT,
	unidade_id int NOT NULL,
	name varchar(100) NOT NULL,
	FOREIGN KEY(unidade_id) references unidades(id)
);

CREATE TABLE item_categories (
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(100) NOT NULL
);

CREATE TABLE items (
	id int PRIMARY KEY AUTO_INCREMENT,
	item_category_id int NOT NULL,
	name varchar(100) NOT NULL,
	FOREIGN KEY(item_category_id) references item_categories(id)
);

CREATE TABLE types (
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(100) NOT NULL
);

CREATE TABLE cardapios(
	id int PRIMARY KEY AUTO_INCREMENT,
	unidade_restaurante_id int(10) NOT NULL,
	type_id int not null,
	day DATE NOT NULL,
	horario VARCHAR(50) NOT NULL,
	FOREIGN KEY(unidade_restaurante_id) references unidade_restaurantes(id),
	FOREIGN KEY(type_id) references types(id)
);


CREATE TABLE cardapio_items(
	id int PRIMARY KEY AUTO_INCREMENT,
	cardapio_id int NOT NULL,
	item_id int NOT NULL,
	FOREIGN KEY(cardapio_id) references cardapios(id),
	FOREIGN KEY(item_id) references items(id)
);

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `unidade_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  FOREIGN KEY(unidade_id) references unidades(id)
);

create table registrations_ids(
	id int primary key auto_increment,
    registration_id varchar(100) not null,
	unidade_id int not null,
    foreign key (unidade_id) references unidades(id)
);