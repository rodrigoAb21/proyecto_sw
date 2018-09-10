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
    fecha TIMESTAMP NOT NULL,
    cuenta_id INT NOT NULL,
    FOREIGN KEY (cuenta_id)
        REFERENCES cuenta (id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
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
    capacidad INT NOT NULL,
    visible CHAR NOT NULL DEFAULT '1',
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES user (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ruta (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    visible CHAR NOT NULL DEFAULT '1',
    descripcion VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id)
        REFERENCES user (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE punto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    longitud FLOAT NOT NULL,
    latitud FLOAT NOT NULL,
    ruta_id INT NOT NULL,
    FOREIGN KEY (ruta_id)
        REFERENCES ruta (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

























