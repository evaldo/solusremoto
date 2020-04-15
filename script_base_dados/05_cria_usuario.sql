--CREATE USER evaldo WITH PASSWORD '1234';

GRANT CONNECT ON DATABASE vilaverde_dw TO evaldo;

GRANT USAGE ON SCHEMA integracao TO evaldo;

GRANT SELECT ON ALL TABLES IN SCHEMA integracao TO evaldo;
GRANT SELECT, UPDATE, DELETE, INSERT ON ALL TABLES IN SCHEMA integracao TO evaldo;

GRANT SELECT on integracao.vw_menu_princ_integracao TO evaldo;
GRANT SELECT on integracao.vw_menu_princ_integracao_usua TO evaldo;
GRANT SELECT on integracao.vw_menu_princ_usua TO evaldo;

GRANT SELECT, UPDATE, INSERT, DELETE ON integracao.tb_c_grupo_acesso TO evaldo;
GRANT SELECT, UPDATE, INSERT, DELETE ON integracao.tb_c_grupo_usua_acesso TO evaldo;
GRANT SELECT, UPDATE, INSERT, DELETE ON integracao.tb_c_grupo_usua_menu_sist_integracao TO evaldo;
GRANT SELECT, UPDATE, INSERT, DELETE ON integracao.tb_c_menu_sist_integracao TO evaldo;
GRANT SELECT, UPDATE, INSERT, DELETE ON integracao.tb_c_usua_acesso TO evaldo;

--Example grant on sequence object database
--GRANT ALL ON SEQUENCE integracao.xxxxxxxxxxxxxxxx TO evaldo;

--Example grant on view object database
--grant select on integracao.xxxxxxxxxxx to evaldo;

----------------------------------------------------------------------------------------------

--Example revoke privileges
--REVOKE ALL PRIVILEGES ON ALL TABLES IN SCHEMA integracao FROM usua;
--REVOKE CONNECT ON DATABASE vila_verde from usua;

--REVOKE USAGE ON SCHEMA integracao from usua;

--REVOKE ALL PRIVILEGES ON integracao.xxxxxxxxxxx from usua;

--REVOKE ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA integracao FROM usua;

--DROP USER usua;
