---------------------------------------------------
	
CREATE SEQUENCE integracao.sq_grupo_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_grupo_acesso
    OWNER TO postgres;

	
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO tivilaverde;
	
---------------------------------------------------

CREATE SEQUENCE integracao.sq_grupo_usua_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_grupo_usua_acesso
    OWNER TO postgres;	
	
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO tivilaverde;	
	
---------------------------------------------------
	
CREATE SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao
    OWNER TO postgres;	
	
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO tivilaverde;
	
	
---------------------------------------------------

CREATE SEQUENCE integracao.sq_log_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_log_acesso
    OWNER TO postgres;	

GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO tivilaverde;	

---------------------------------------------------
	
CREATE SEQUENCE integracao.sq_menu_sist_integracao
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_menu_sist_integracao
    OWNER TO postgres;	

GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO camila;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO tivilaverde;		

---------------------------------------------------

CREATE SEQUENCE integracao.sq_usua_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_usua_acesso
    OWNER TO postgres;	

GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO tivilaverde;
	
---------------------------------------------------	
CREATE SEQUENCE integracao.sq_equip_hosptr
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999;

ALTER SEQUENCE integracao.sq_equip_hosptr
    OWNER TO postgres;

COMMENT ON SEQUENCE integracao.sq_equip_hosptr
    IS 'Sequence para cadastro da equipe hospitalar';
	
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO camila;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO tivilaverde;

---------------------------------------------------	
CREATE SEQUENCE integracao.sq_status_leito
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999;

ALTER SEQUENCE integracao.sq_status_leito
    OWNER TO postgres;

COMMENT ON SEQUENCE integracao.sq_status_leito
    IS 'Sequence para cadastro da status de leitos';
	
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO camila;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO tivilaverde;

---------------------------------------------------	

CREATE SEQUENCE integracao.sq_hstr_ocpa_leito_status
INCREMENT 1
    START 5000
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_hstr_ocpa_leito_status
    OWNER TO postgres;
	
GRANT ALL ON SEQUENCE integracao.sq_hstr_ocpa_leito_status TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_hstr_ocpa_leito_status TO camila;
GRANT ALL ON SEQUENCE integracao.sq_hstr_ocpa_leito_status TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_hstr_ocpa_leito_status TO tivilaverde;
