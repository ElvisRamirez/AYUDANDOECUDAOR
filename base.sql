
create database ayudandoecuador1
use ayudandoecuador1
-- Crear la tabla Usuarios
CREATE TABLE IF NOT EXISTS Usuarios (
  id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(255) NOT NULL,
  Apellido VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL UNIQUE,
  contrasenia VARCHAR(255) NOT NULL
);

-- Crear la tabla Datos
CREATE TABLE IF NOT EXISTS Datos (
  id_datos INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) -- Asegúrate de que esto esté correcto
);

-- Crear la tabla Clasificacion
CREATE TABLE IF NOT EXISTS Clasificacion (
  id_clasificacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_datos INT,
  tipo VARCHAR(255),
  CONSTRAINT Clasificacion_id_datos_fk FOREIGN KEY (id_datos) REFERENCES Datos(id_datos)
);

-- Crear la tabla datos_adicionales
CREATE TABLE IF NOT EXISTS datos_adicionales (
  id_adicional INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_dato INT NOT NULL,
  tipo_cuenta VARCHAR(255),
  cuentas_bancarias VARCHAR(20),
  CONSTRAINT datos_adicionales_id_dato_fk FOREIGN KEY (id_dato) REFERENCES Datos(id_datos)
);

-- Crear la tabla fotos
CREATE TABLE IF NOT EXISTS fotos (
  id_fotos INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_dato INT NOT NULL,
  foto_ruta VARCHAR(255),
  CONSTRAINT fotos_id_dato_fk FOREIGN KEY (id_dato) REFERENCES Datos(id_datos)
);

-- Crear la tabla redes_sociales
CREATE TABLE IF NOT EXISTS redes_sociales (
  id_redes INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_datos INT NOT NULL,
  tipo_red VARCHAR(255),
  links VARCHAR(255),
  CONSTRAINT redes_sociales_id_datos_fk FOREIGN KEY (id_datos) REFERENCES Datos(id_datos)
);

-- Crear la tabla Telefonos
CREATE TABLE IF NOT EXISTS Telefonos (
  id_telefonos INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_datos INT,
  telefono INT NOT NULL,
  CONSTRAINT Telefonos_id_datos_fk FOREIGN KEY (id_datos) REFERENCES Datos(id_datos)
);

-- Crear la tabla Ubicacion
CREATE TABLE IF NOT EXISTS Ubicacion (
  id_ubicacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_dato INT NOT NULL,
  pais VARCHAR(255),
  provincia VARCHAR(255) NOT NULL,
  canton VARCHAR(255) NOT NULL, -- Campo para el cantón
  parroquia VARCHAR(255) NOT NULL, -- Campo para la parroquia
  altitud DECIMAL(9,6) NOT NULL,
  latitud DECIMAL(9,6) NOT NULL,
  CONSTRAINT Ubicacion_id_dato_fk FOREIGN KEY (id_dato) REFERENCES Datos(id_datos)
);

-- Crear la tabla Entidad
CREATE TABLE IF NOT EXISTS Entidad (
  id_entidad INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_dato INT NOT NULL,
  Entidad_Nombre VARCHAR(255) NOT NULL,
  rama_accion VARCHAR(255) NOT NULL,
  ruc VARCHAR(11) NOT NULL, -- Cambiar a varchar para evitar problemas con ceros a la izquierda
  email VARCHAR(255) NOT NULL,
  representante VARCHAR(255) NOT NULL,
  fuente_financiacion VARCHAR(255),
  descripcion TEXT,
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


       
   