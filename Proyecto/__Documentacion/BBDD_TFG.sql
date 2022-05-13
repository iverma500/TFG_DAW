DROP DATABASE IF EXISTS bbdd_tfg;
CREATE DATABASE bbdd_tfg;

USE bbdd_tfg;

/*  tabla usuario   */

DROP TABLE IF EXISTS usuario;
CREATE TABLE IF NOT EXISTS usuario (
    id int(11) NOT NULL AUTO_INCREMENT,
    identificador varchar(90) COLLATE utf8_spanish_ci NOT NULL UNIQUE,
    email varchar(40) COLLATE utf8_spanish_ci NOT NULL UNIQUE,
    contrasenna varchar(80) COLLATE utf8_spanish_ci NOT NULL,
    codigoCookie varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
    caducidadCodigoCookie timestamp NULL DEFAULT NULL,
    nombre varchar(50) COLLATE utf8_spanish_ci NOT NULL,
    apellidos varchar(50) COLLATE utf8_spanish_ci NOT NULL,
    codVideojuegos varchar (99) COLLATE utf8_spanish_ci,
    modo varchar(50) COLLATE utf8_spanish_ci default 'oscuro',
    fotoPerfil int (2) default 0,
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
TRUNCATE TABLE usuario;


INSERT INTO usuario
(id, identificador, email, contrasenna, codigoCookie, caducidadCodigoCookie, nombre, apellidos, codVideojuegos, modo, fotoPerfil)
VALUES
    (1, 'pLotudo', 'pepelot@gmail.com', 'c483f6ce851c9ecd9fb835ff7551737c', NULL, NULL, 'Pepe',   'Lotudo', '1,3,5,2', 'oscuro',0),
    (2, 'Josian', 'jositron2@gmail.com', '8a89e5e5072e7ceb40c02b3c3d0fd977', NULL, NULL, 'Josian',   'Galtor','2,5', 'claro',0),
    (3, 'ManCa', 'carrasMan@gmail.com', 'd6fd0924e324f50669ae0295adf59567', NULL, NULL, 'Manuela',   'Carrasco','10,11','claro', 0),
    (4, 'Iverma', 'dbdtodoeldia@gmail.com', 'f0b53b2da041fca49ef0b9839060b345', NULL, NULL, 'Ivan',   'Delas','1,2,13', 'claro', 0);


/*  tabla videojuego   */
CREATE TABLE IF NOT EXISTS videojuego (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(90) COLLATE utf8_spanish_ci NOT NULL,
    descripcion varchar(200) COLLATE utf8_spanish_ci NOT NULL,
    puntosActual DOUBLE(10,2) COLLATE utf8_spanish_ci NOT NULL,
    puntosViejo int (10) COLLATE utf8_spanish_ci NOT NULL,
    categoriaId int(4) COLLATE utf8_spanish_ci NOT NULL,
    KEY fk_categoriaIdIdx (categoriaId),
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
TRUNCATE TABLE videojuego;

/*LA IDEA ES QUE el identificador de la foto sea el nombre de la foto (ej: la foto se llama 5.png; pues su identificador de foto es AC1)*/
INSERT INTO videojuego
(id, nombre, descripcion, puntosActual,puntosViejo, categoriaId)
VALUES
    (1, 'RUN & JUMP', 'Divertido videojuego endless-runner con tabla de clasificación online', 0.00, 450, 1),
    (2, 'PLATFORMS WORLD','Explora la Realidad Pixel para lograr escapar.', 0.00 , 450, 1),
    (3, 'THE DUNGEON GAME', 'Avanza rápidamente por niveles muy difíciles.', 0.00 , 300, 1),
    (4, 'COLORON','Cambia de color todas las plataformas para que la pelota logre avanzar.', 0.00 , 100, 4),
    (5, 'COPYCAT','Consigue pasar los niveles con dos personajes.', 0.00 , 200, 1),
    (6, 'EL AHORCADO','Adivina la palabra antes de que sea demasiado tarde.', 0.00 , 200, 4),
    (7, 'INFINITE RUNNER','Consigue pasar todas las platafomas rápidamente.', 0.00 , 350, 1),
    (8, 'MARBLE LABYRINTH','Usa el ratón para mover la canica por distintos niveles.', 0.00 , 350, 1),
    (9, 'MAZE GRIDPURE','Usa el ratón para pasar por distintos laberintos.', 0.00 , 400, 1),
    (10, 'OUTRUN','Consigue conduciendo todas las monedas posibles.', 0.00 , 400, 7),
    (11, 'STICK HERO','Crea puentes para avanzar por las distintas plataformas.', 0.00 , 250, 1),
    (12, 'SWEET MEMORY','Busca las parejas de las distintas cartas.', 0.00 , 250, 1),
    (13, 'TOWER BLOCKS','Consigue crear la torre más alta posible.', 0.00 , 350, 4),
    (14, 'PLATFORMS GAME','Encuentra el camino para avanzar de nivel.', 0.00 , 400, 1);



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

/*  tabla codigos   */

DROP TABLE IF EXISTS codigos;
CREATE TABLE IF NOT EXISTS codigos (
    id int(11) NOT NULL AUTO_INCREMENT,
    identificador varchar(90) COLLATE utf8_spanish_ci NOT NULL,
    email varchar(40) COLLATE utf8_spanish_ci NOT NULL,
    codigo varchar(50) COLLATE utf8_spanish_ci NOT NULL,
    KEY fk_nicknameUserx (identificador),
    KEY fk_emailUserx (email),
    PRIMARY KEY (id)
    )
    ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
TRUNCATE TABLE codigos;


INSERT INTO codigos
(id, identificador, email, codigo)
VALUES
    (1, 'pLotudo', 'pepelot@gmail.com', '6227cce503a32'),
    (2, 'Josian', 'jositron2@gmail.com', '6227cce503a32'),
    (3, 'ManCa', 'carrasMan@gmail.com', '6227cce503a32'),
    (4, 'Iverma', 'dbdtodoeldia@gmail.com','6227cce503a32');
