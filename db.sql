DROP TABLE IF EXISTS
news, categories, goods, appeals, goodToCategories;

# Необходимо добавить значения по умолчанию
CREATE TABLE news (
	id INT,
	anounce TEXT,
	header VARCHAR(255),
	content TEXT,
	dt DATE,
	PRIMARY KEY (id)
);

CREATE TABLE categories (
	id INT,
	name VARCHAR(255),
	img VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE goods (
	id INT,
	name VARCHAR(255),
	description TEXT,
	price FLOAT,
	img VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE appeals (
	id INT,
	userName VARCHAR(255),
	email VARCHAR(255),
	phone VARCHAR(20),
	message TEXT,
	dt TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE goodToCategories (
	goodID INT,
	categoryID INT
);