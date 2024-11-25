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
  altitud float NOT NULL,
  latitud float NOT NULL,
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

DESCRIBE Entidad;

-- Deshabilitar temporalmente las verificaciones de claves foráneas
SET FOREIGN_KEY_CHECKS = 0;

-- Eliminar los datos de todas las tablas
TRUNCATE TABLE Usuarios;
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


         SELECT foto_ruta FROM fotos;
                                                                                   SELECT 
                                                    u.id_usuario,
                                                    u.Nombre,
                                                    u.Apellido,
                                                    u.correo,
                                                    u.contrasenia,
                                                    
                                                    -- Datos relacionados con el usuario
                                                    d.id_datos,
                                                    
                                                    -- Clasificación
                                                    c.tipo AS clasificacion_tipo,
                                                    
                                                    -- Datos adicionales
                                                    da.tipo_cuenta,
                                                    da.cuentas_bancarias,
                                                    
                                                    -- Fotos
                                                    f.id_fotos,
                                                    f.foto_ruta,
                                                    
                                                    -- Redes sociales
                                                    rs.tipo_red AS redes_sociales_tipo,
                                                    rs.links AS redes_sociales_links,
                                                    
                                                    -- Teléfonos
                                                    t.telefono AS telefono,
                                                    
                                                    -- Ubicación
                                                    uo.pais,
                                                    uo.provincia,
                                                    uo.canton,
                                                    uo.parroquia,
                                                    uo.altitud,
                                                    uo.latitud,
                                                    
                                                    -- Entidad
                                                    e.id_entidad,
                                                    e.Entidad_Nombre,
                                                    e.rama_accion,
                                                    e.ruc,
                                                    e.email AS entidad_email,
                                                    e.representante,
                                                    e.fuente_financiacion,
                                                    e.descripcion AS entidad_descripcion

                                                FROM Usuarios u
                                                LEFT JOIN Datos d ON u.id_usuario = d.id_usuario
                                                LEFT JOIN Clasificacion c ON d.id_datos = c.id_datos
                                                LEFT JOIN datos_adicionales da ON d.id_datos = da.id_dato
                                                LEFT JOIN fotos f ON d.id_datos = f.id_dato
                                                LEFT JOIN redes_sociales rs ON d.id_datos = rs.id_datos
                                                LEFT JOIN Telefonos t ON d.id_datos = t.id_datos
                                                LEFT JOIN Ubicacion uo ON d.id_datos = uo.id_dato
                                                LEFT JOIN Entidad e ON d.id_datos = e.id_dato
                                                WHERE u.id_usuario = 1

 SELECT 
        e.id_dato,
        e.Entidad_Nombre,
        e.rama_accion,
        e.descripcion AS entidad_descripcion,
        f.foto_ruta,
        c.tipo AS clasificacion_tipo
    FROM Entidad e
    LEFT JOIN fotos f ON e.id_dato = f.id_dato
    LEFT JOIN Clasificacion c ON e.id_dato = c.id_datos;
    
    
    
    SELECT 
        e.id_dato,
        e.Entidad_Nombre,
        e.rama_accion,
        e.descripcion AS entidad_descripcion,
        f.foto_ruta,  -- BLOB con los datos de la imagen
        c.tipo AS clasificacion_tipo
    FROM Entidad e
    LEFT JOIN fotos f ON e.id_dato = f.id_dato
    LEFT JOIN Clasificacion c ON e.id_dato = c.id_datos;
    
    select *from ubicacion
    SELECT id_dato, foto_ruta FROM fotos LIMIT 10;
