---------------------------------------------------
	
CREATE SEQUENCE integracao.sq_grupo_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_grupo_acesso
    OWNER TO postgres;

---------------------------------------------------

CREATE SEQUENCE integracao.sq_grupo_usua_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_grupo_usua_acesso
    OWNER TO postgres;	
	
---------------------------------------------------
	
CREATE SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao
    OWNER TO postgres;	
	
---------------------------------------------------

CREATE SEQUENCE integracao.sq_log_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_log_acesso
    OWNER TO postgres;	
	
---------------------------------------------------
	
CREATE SEQUENCE integracao.sq_menu_sist_integracao
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_menu_sist_integracao
    OWNER TO postgres;	
	
---------------------------------------------------

CREATE SEQUENCE integracao.sq_usua_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_usua_acesso
    OWNER TO postgres;	
	
---------------------------------------------------	

