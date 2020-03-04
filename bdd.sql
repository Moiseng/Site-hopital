/* Création de la table services */
CREATE TABLE services(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    content TEXT(100000) NOT NULL,
    what_we_do TEXT(100000) NOT NULL,
    procedure TEXT(100000) NOT NULL,
    PRIMARY KEY (id)
)


/* Création de la table doctors */
CREATE TABLE doctors(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    phone INT NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    picture VARCHAR(27) NULLABLE,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (id)
)
