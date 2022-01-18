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
    (2, 'Josian', 'jositron2@gmail.com', 'josian', NULL, NULL, 'Josian',   'Galtor'),
    (3, 'ManCa', 'carrasMan@gmail.com', 'mc', NULL, NULL, 'Manuela',   'Carrasco'),
    (4, 'Iverma', 'dbdtodoeldia@gmail.com', 'iv', NULL, NULL, 'Ivan',   'Delas');


/*  tabla videojuego   */
CREATE TABLE IF NOT EXISTS videojuego (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(90) COLLATE utf8_spanish_ci NOT NULL,
    descripcion varchar(200) COLLATE utf8_spanish_ci NOT NULL,
    precioActual DOUBLE(10,2) COLLATE utf8_spanish_ci NOT NULL,
    precioViejo DOUBLE(10,2) COLLATE utf8_spanish_ci NOT NULL,
    identificadorFoto varchar(90) COLLATE utf8_spanish_ci NOT NULL,
    categoriaId int(4) COLLATE utf8_spanish_ci NOT NULL,
    KEY fk_categoriaIdIdx (categoriaId),
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
TRUNCATE TABLE videojuego;

/*LA IDEA ES QUE el identificador de la foto sea el nombre de la foto (ej: la foto se llama AC1.png; pues su identificador de foto es AC1)*/
INSERT INTO videojuego
(id, nombre, descripcion, precioActual,precioViejo, identificadorFoto, categoriaId)
VALUES
    (1, '2048', 'Mueve casillas hasta llegar a 2048 sumando valores iguales', 0.00, 7.99, '2048',5),
    (2, 'RUN&JUMP', 'Consigue crear puentes para superar cada nivel', 0.00, 11.99, 'R&J', 1),
    (3, 'The Dungeon Game', 'Intenta superar nievles de gran dificultad con tu destreza', 0.00 , 4.99,'dungeon', 1),
    (4, 'Platforms World','Explora la Realidad Pixel para lograr escapar.', 0.00 , 4.99 ,'platformsworld', 1),
    (5, 'Assassin´s Creed', 'Lleva a cabo una serie de asesinatos ordenados por Al Mualim, el líder de los asesinos.', 0.00, 29.99,'AC1', 2);


/*  tabla categoriaVideojuego   */
CREATE TABLE IF NOT EXISTS categoriaVideojuego (
    id int(11) NOT NULL AUTO_INCREMENT,
    categoria varchar(90) COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
TRUNCATE TABLE categoriaVideojuego;


INSERT INTO categoriaVideojuego
(id, categoria)
VALUES
    (1, 'Plataformas-2D'),
    (2, 'Accion-Aventuras'),
    (3, 'Misterio'),
    (4, 'Survival-Horror'),
    (5, 'Puzzle'),
    (6, 'RPG'),
    (7, 'Arcade'),
    (8, 'Sandbox');
