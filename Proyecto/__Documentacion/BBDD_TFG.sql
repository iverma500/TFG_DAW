DROP DATABASE IF EXISTS bbdd_tfg;
CREATE DATABASE bbdd_tfg;

USE bbdd_tfg;

/*  tabla usuario   */

DROP TABLE IF EXISTS usuario;
CREATE TABLE IF NOT EXISTS usuario (
    id int(11) NOT NULL AUTO_INCREMENT,
    identificador varchar(90) COLLATE utf8_spanish_ci NOT NULL,
    email varchar(40) COLLATE utf8_spanish_ci NOT NULL,
    contrasenna varchar(80) COLLATE utf8_spanish_ci NOT NULL,
    codigoCookie varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
    caducidadCodigoCookie timestamp NULL DEFAULT NULL,
    nombre varchar(50) COLLATE utf8_spanish_ci NOT NULL,
    apellidos varchar(50) COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
TRUNCATE TABLE usuario;


INSERT INTO usuario
(id, identificador, email, contrasenna, codigoCookie, caducidadCodigoCookie, nombre, apellidos)
VALUES
    (1, 'pLotudo', 'pepelot@gmail.com', 'pp', NULL, NULL, 'Pepe',   'Lotudo'),
    (2, 'Josian', 'jositron3@gmail.com', 'josian', NULL, NULL, 'Josian',   'Galtor'),
    (3, 'ManCa', 'carrasMan@gmail.com', 'mc', NULL, NULL, 'Manuela',   'Carrasco'),
    (4, 'Iverma', 'dbdtodoeldia@gmail.com', 'iv', NULL, NULL, 'Ivan',   'Delas');


