/******************************************/
/** SOLO TRABAJA EN MySQL 5.6 o SUPERIOR **/
/******************************************/

/************ Update: Tables ***************/

/******************** Add Table: bitacora ************************/

/* Build Table Structure */
CREATE TABLE bitacora
(
	id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	usuario_id BIGINT UNSIGNED NOT NULL,
	accion VARCHAR(80) NOT NULL,
	tabla VARCHAR(80) NOT NULL,
	registro BIGINT UNSIGNED NULL,
	observacion VARCHAR(1024) NULL,
	fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

/* Add Indexes */
CREATE INDEX bitacora_fecha_Idx ON bitacora (fecha) USING btree;

CREATE INDEX bitacora_usuario_id_Idx ON bitacora (usuario_id) USING btree;


/******************** Add Table: credencial ************************/

/* Build Table Structure */
CREATE TABLE credencial
(
	id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	nombre VARCHAR(80) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT NULL,
	deleted_at TIMESTAMP NULL
) ENGINE=InnoDB;

/******************** Add Table: recordar_me ************************/

/* Build Table Structure */
CREATE TABLE recordar_me
(
	id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	usuario_id BIGINT UNSIGNED NOT NULL,
	ip_address VARCHAR(50) NOT NULL,
	hash_cookie VARCHAR(32) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

/* Add Indexes */
CREATE UNIQUE INDEX recordar_me_ip_address_hash_cookie_Idx ON recordar_me (ip_address, hash_cookie) USING btree;

CREATE INDEX recordar_me_usuario_id_Idx ON recordar_me (usuario_id) USING btree;


/******************** Add Table: usuario ************************/

/* Build Table Structure */
CREATE TABLE usuario
(
	id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	user_name VARCHAR(80) NOT NULL,
	password VARCHAR(32) NOT NULL,
	actived BOOLEAN DEFAULT 1
		COMMENT 'TRUE (1) = activado | FALSE (0) = desactivado' NOT NULL,
	last_login_at TIMESTAMP NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT NULL,
	deleted_at TIMESTAMP NULL
) ENGINE=InnoDB;

/* Add Indexes */
CREATE INDEX usuario_actived_Idx ON usuario (actived) USING btree;

CREATE INDEX usuario_deleted_at_Idx ON usuario (deleted_at) USING btree;

CREATE UNIQUE INDEX usuario_user_name_Idx ON usuario (user_name) USING btree;

CREATE INDEX usuario_user_name_password_Idx ON usuario (user_name, password) USING btree;


/******************** Add Table: usuario_credencial ************************/

/* Build Table Structure */
CREATE TABLE usuario_credencial
(
	id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	usuario_id BIGINT UNSIGNED NOT NULL,
	credencial_id BIGINT UNSIGNED NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

/* Add Indexes */
CREATE INDEX usuario_credencial_credencial_id_Idx ON usuario_credencial (credencial_id) USING btree;

CREATE INDEX usuario_credencial_usuario_id_Idx ON usuario_credencial (usuario_id) USING btree;

CREATE UNIQUE INDEX usuario_credencial_usuario_id_credencial_id_Idx ON usuario_credencial (usuario_id, credencial_id) USING btree;





/************ Add Foreign Keys ***************/

/* Add Foreign Key: fk_bitacora_usuario */
ALTER TABLE bitacora ADD CONSTRAINT fk_bitacora_usuario
	FOREIGN KEY (usuario_id) REFERENCES usuario (id)
	ON UPDATE RESTRICT ON DELETE RESTRICT;

/* Add Foreign Key: fk_recordar_me_usuario */
ALTER TABLE recordar_me ADD CONSTRAINT fk_recordar_me_usuario
	FOREIGN KEY (usuario_id) REFERENCES usuario (id)
	ON UPDATE RESTRICT ON DELETE RESTRICT;

/* Add Foreign Key: fk_usuario_credencial_credencial */
ALTER TABLE usuario_credencial ADD CONSTRAINT fk_usuario_credencial_credencial
	FOREIGN KEY (credencial_id) REFERENCES credencial (id)
	ON UPDATE RESTRICT ON DELETE RESTRICT;

/* Add Foreign Key: fk_usuario_credencial_usuario */
ALTER TABLE usuario_credencial ADD CONSTRAINT fk_usuario_credencial_usuario
	FOREIGN KEY (usuario_id) REFERENCES usuario (id)
	ON UPDATE RESTRICT ON DELETE RESTRICT;

-- ----------------------------
--  Records of "credencial"
-- ----------------------------
BEGIN;
INSERT INTO credencial (nombre) VALUES ('admin');
INSERT INTO "credencial" (nombre) VALUES ('usuario');
COMMIT;

-- ----------------------------
--  Records of "usuario" admin - 123
-- ----------------------------
BEGIN;
INSERT INTO usuario (user_name, password, actived, last_login_at) VALUES ('admin', '202cb962ac59075b964b07152d234b70', 1, null);
COMMIT;

-- ----------------------------
--  Records of "usuario_credencial"
-- ----------------------------
BEGIN;
INSERT INTO usuario_credencial (usuario_id, credencial_id) VALUES (1, 1);
COMMIT;