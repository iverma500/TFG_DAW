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
    categoriaId int(4) COLLATE utf8_spanish_ci NOT NULL,
    KEY fk_categoriaIdIdx (categoriaId),
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
TRUNCATE TABLE videojuego;

/*LA IDEA ES QUE el identificador de la foto sea el nombre de la foto (ej: la foto se llama 5.png; pues su identificador de foto es AC1)*/
INSERT INTO videojuego
(id, nombre, descripcion, precioActual,precioViejo, categoriaId)
VALUES
    (1, 'RUN&JUMP', 'Divertido videojuego endless-runner con tabla de clasificación online', 0.00, 11.99, 1),
    (2, 'Platforms World','Explora la Realidad Pixel para lograr escapar.', 0.00 , 4.99, 1),
    (3, 'The Dungeon Game', 'Avanza rápidamente por niveles muy difíciles.', 0.00 , 9.99, 1),
    (4, 'Coloron','Cambia de color todas las plataformas para que la pelota logre avanzar.', 0.00 , 7.99, 1),
    (5, 'Copycat','Consigue pasar los niveles con dos personajes.', 0.00 , 14.99, 1),
    (6, 'El Ahorcado','Adivina la palabra antes de que sea demasiado tarde.', 0.00 , 4.99, 1),
    (7, 'Infinite Runner','Consigue pasar todas las platafomas rápidamente.', 0.00 , 6.99, 1),
    (8, 'Marble Labyrinth','Usa el ratón para mover la canica por distintos niveles.', 0.00 , 12.99, 1),
    (9, 'Maze Gridpure','Usa el raon para pasar por distintos laberintos.', 0.00 , 4.99, 1),
    (10, 'Outrun','Consigue conduciendo todas las monedas posibles.', 0.00 , 19.99, 1),
    (11, 'Stick Hero','Crea puentes para avanzar por las distintas plataformas.', 0.00 , 11.99, 1),
    (12, 'Sweet Memory','Busca las parejas de las distintas cartas.', 0.00 , 5.99, 1),
    (13, 'Tower Blocks','Consigue crear la torre más alta posible.', 0.00 , 16.99, 1),
    (14, 'Platform Game','Encuentra el camino para avanzar de nivel.', 0.00 , 24.99, 1);



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
