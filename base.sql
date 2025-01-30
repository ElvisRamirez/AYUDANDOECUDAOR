CREATE TABLE IF NOT EXISTS Datos (
  id_datos INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) -- Asegúrate de que esto esté correcto
);

use ayudandoecuador1
select * from datos_adicionales
CREATE TABLE IF NOT EXISTS Usuarios (
  id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(255) NOT NULL,
  Apellido VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL UNIQUE,
  contrasenia VARCHAR(255) NOT NULL
);
use ayudandoecuador1
select *from Entidad

CREATE TABLE IF NOT EXISTS Clasificacion (
  id_clasificacion int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_datos int,
  tipo varchar(255),
  CONSTRAINT Clasificacion_id_datos_fk FOREIGN KEY (id_datos) REFERENCES Datos(id_datos)
);


ALTER TABLE Entidad
ADD CONSTRAINT Entidad_id_dato_fk FOREIGN KEY (id_dato) REFERENCES Datos(id_datos);

CREATE TABLE IF NOT EXISTS datos_adicionales (
  id_adicional INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_dato INT NOT NULL,
 tipo_cuenta VARCHAR(255),
 cuentas_bancarias VARCHAR(20),
  CONSTRAINT datos_adicionales_id_dato_fk FOREIGN KEY (id_dato) REFERENCES Datos(id_datos)
 

);
CREATE TABLE IF NOT EXISTS fotos (
  id_fotos int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_dato int NOT NULL,
   foto_ruta VARCHAR(255),
  CONSTRAINT fotos_id_dato_fk FOREIGN KEY (id_dato) REFERENCES Datos(id_datos)
);



CREATE TABLE IF NOT EXISTS redes_sociales (
  id_redes int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_datos int NOT NULL,
  tipo_red varchar(255),
  links varchar(255),
  CONSTRAINT redes_sociales_id_datos_fk FOREIGN KEY (id_datos) REFERENCES Datos(id_datos)
);

CREATE TABLE IF NOT EXISTS Telefonos (
  id_telefonos int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_datos int,
  telefono int NOT NULL,
  CONSTRAINT Telefonos_id_datos_fk FOREIGN KEY (id_datos) REFERENCES Datos(id_datos)
);
use ayudandoecuador1
select * from fotos
select * from datos
select * from entidad
select * from usuarios
select * from ubicacion

TRUNCATE TABLE usuarios;
CREATE TABLE IF NOT EXISTS Ubicacion (
  id_ubicacion int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_dato int NOT NULL,
  pais varchar(255),
  provincia varchar(255) NOT NULL,
  canton varchar(255) NOT NULL, -- Campo para el cantón
  parroquia varchar(255) NOT NULL, -- Campo para la parroquia
  altitud decimal(9,6) NOT NULL,

 latitud decimal(9,6) NOT NULL,

  CONSTRAINT Ubicacion_id_dato_fk FOREIGN KEY (id_dato) REFERENCES Datos(id_datos)
);
DROP TABLE IF EXISTS Entidad;


CREATE TABLE IF NOT EXISTS Entidad (
  id_entidad int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_dato int NOT NULL,
  Entidad_Nombre varchar(255) NOT NULL,
  rama_accion varchar(255) NOT NULL,
  ruc varchar(11) NOT NULL, -- Cambiar a varchar para evitar problemas con ceros a la izquierda
  email varchar(255) NOT NULL,
  representante varchar(255) NOT NULL,
  fuente_financiacion varchar(255),
  descripcion text,
  CONSTRAINT Entidad_id_dato_fk FOREIGN KEY (id_dato) REFERENCES Datos(id_datos)
);




-- Deshabilitar temporalmente las verificaciones de claves foráneas
SET FOREIGN_KEY_CHECKS = 0;
use ayudandoecuador1
-- Eliminar los datos de todas las tablas
TRUNCATE TABLE usuarios;
TRUNCATE TABLE Ubicacion;
TRUNCATE TABLE Telefonos;
TRUNCATE TABLE redes_sociales;
TRUNCATE TABLE fotos;
TRUNCATE TABLE Entidad;
TRUNCATE TABLE datos_adicionales;
TRUNCATE TABLE Clasificacion;
TRUNCATE TABLE Datos;

-- Habilitar nuevamente las verificaciones de claves foráneas
SET FOREIGN_KEY_CHECKS = 1;


       
    
    
 