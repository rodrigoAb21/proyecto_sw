drop database if exists software;
create database software;
use software;

CREATE TABLE cuenta (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nro VARCHAR(255) NOT NULL,
    saldo FLOAT NOT NULL
);

CREATE TABLE movimiento (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    monto FLOAT NOT NULL,
    fecha INT UNSIGNED NOT NULL,
    cuenta_id INT NOT NULL,
    FOREIGN KEY (cuenta_id)
        REFERENCES cuenta (id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    carnet VARCHAR(255) NOT NULL,
    telefono VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    codigo VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(255),
    cuenta_id INT NOT NULL,
    FOREIGN KEY (cuenta_id)
        REFERENCES cuenta (id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE vehiculo (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    placa VARCHAR(255) NOT NULL,
    marca VARCHAR(255) NOT NULL,
    modelo VARCHAR(255) NOT NULL,
    anho VARCHAR(255) NOT NULL,
    color VARCHAR(255) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    capacidad INT NOT NULL,
    visible CHAR NOT NULL DEFAULT '1',
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ruta (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    visible CHAR NOT NULL DEFAULT '1',
    descripcion VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE punto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    longitud DOUBLE NOT NULL,
    latitud DOUBLE NOT NULL,
    ruta_id INT NOT NULL,
    FOREIGN KEY (ruta_id)
        REFERENCES ruta (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE servicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sentido VARCHAR(255) NOT NULL,
    fecha INT UNSIGNED NOT NULL,
    estado VARCHAR(255) NOT NULL,
    cant_p INT NOT NULL,
    costo FLOAT NOT NULL,
    user_id INT NOT NULL,
    vehiculo_id INT NOT NULL,
    ruta_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (vehiculo_id)
        REFERENCES vehiculo (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (ruta_id)
        REFERENCES ruta (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE serv_usr (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    estado VARCHAR(255) DEFAULT 'En espera',
    monto FLOAT NOT NULL,
    latitud DOUBLE NOT NULL,
    longitud DOUBLE NOT NULL,
    servicio_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (servicio_id)
        REFERENCES servicio (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (user_id)
        REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE mensaje (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fecha INT UNSIGNED NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES users (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);



















