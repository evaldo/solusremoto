---------------------------------------------------
	
CREATE SEQUENCE integracao.sq_grupo_acesso
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999;

ALTER SEQUENCE integracao.sq_grupo_acesso
    OWNER TO postgres;

	
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO alinediniz;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO bcorrea;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO farmacia;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO fcampos;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO flavia;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO gabriela;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO glaucodiretor;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO lamorim;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO mvilela;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO posto01;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO posto02;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO posto03;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO posto04;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO qualidade;
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
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO alinediniz;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO bcorrea;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO farmacia;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO fcampos;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO flavia;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO gabriela;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO glaucodiretor;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO lamorim;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO mvilela;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO posto01;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO posto02;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO posto03;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO posto04;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO qualidade;
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
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO alinediniz;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO bcorrea;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO farmacia;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO fcampos;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO flavia;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO gabriela;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO glaucodiretor;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO lamorim;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO mvilela;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO posto01;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO posto02;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO posto03;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO posto04;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO qualidade;
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
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO alinediniz;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO bcorrea;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO farmacia;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO fcampos;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO flavia;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO gabriela;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO glaucodiretor;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO lamorim;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO mvilela;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO posto01;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO posto02;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO posto03;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO posto04;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO qualidade;
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
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO alinediniz;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO bcorrea;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO camila;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO farmacia;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO fcampos;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO flavia;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO gabriela;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO glaucodiretor;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO lamorim;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO mvilela;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO posto01;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO posto02;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO posto03;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO posto04;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO qualidade;
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
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO alinediniz;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO bcorrea;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO farmacia;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO fcampos;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO flavia;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO gabriela;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO glaucodiretor;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO lamorim;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO mvilela;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO posto01;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO posto02;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO posto03;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO posto04;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO qualidade;
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
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO alinediniz;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO bcorrea;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO camila;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO farmacia;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO fcampos;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO flavia;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO gabriela;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO glaucodiretor;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO lamorim;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO mvilela;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO posto01;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO posto02;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO posto03;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO posto04;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO qualidade;
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
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO alinediniz;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO bcorrea;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO camila;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO farmacia;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO fcampos;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO flavia;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO gabriela;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO glaucodiretor;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO lamorim;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO mvilela;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO posto01;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO posto02;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO posto03;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO posto04;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO qualidade;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO tivilaverde;