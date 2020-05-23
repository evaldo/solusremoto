GRANT USAGE ON SCHEMA integracao TO camila;
GRANT USAGE ON SCHEMA integracao TO administrativo;
GRANT USAGE ON SCHEMA integracao TO tivilaverde;

GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao TO administrativo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao TO camila;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao TO evaldo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao TO tivilaverde;

GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao_usua TO administrativo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao_usua TO camila;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao_usua TO evaldo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao_usua TO tivilaverde;

GRANT SELECT ON TABLE integracao.vw_menu_princ_usua TO administrativo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_usua TO camila;
GRANT SELECT ON TABLE integracao.vw_menu_princ_usua TO evaldo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_usua TO tivilaverde;

GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_acesso TO tivilaverde;

GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_acesso TO tivilaverde;

GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO camila;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_grupo_usua_menu_sist_integracao TO tivilaverde;

GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_log_acesso TO tivilaverde;

GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO camila;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_menu_sist_integracao TO tivilaverde;

GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO camila;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_usua_acesso TO tivilaverde;

GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO camila;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_equip_hosptr TO tivilaverde;

GRANT ALL ON SEQUENCE integracao.sq_status_leito TO administrativo;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO camila;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO evaldo;
GRANT ALL ON SEQUENCE integracao.sq_status_leito TO tivilaverde;

GRANT ALL ON TABLE integracao.tb_ctrl_leito_smart TO postgres;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO administrativo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO tivilaverde;

GRANT ALL ON TABLE integracao.tb_f_hstr_ocpa_leito_status TO postgres;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_f_hstr_ocpa_leito_status TO administrativo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_f_hstr_ocpa_leito_status TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_f_hstr_ocpa_leito_status TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_f_hstr_ocpa_leito_status TO tivilaverde;

GRANT ALL ON TABLE integracao.tb_ctrl_leito_temp TO postgres;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_temp TO administrativo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_temp TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_temp TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_temp TO tivilaverde;

GRANT ALL ON TABLE integracao.tb_ctrl_leito_smart TO postgres;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO administrativo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO tivilaverde;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_c_usua_acesso TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_usua_acesso TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_usua_acesso TO tivilaverde;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_usua_acesso TO administrativo;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_c_menu_sist_integracao TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_menu_sist_integracao TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_menu_sist_integracao TO tivilaverde;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_menu_sist_integracao TO administrativo;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_c_grupo_acesso TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_acesso TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_acesso TO tivilaverde;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_acesso TO administrativo;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_c_grupo_usua_acesso TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_usua_acesso TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_usua_acesso TO tivilaverde;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_usua_acesso TO administrativo;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_c_grupo_usua_menu_sist_integracao TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_usua_menu_sist_integracao TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_usua_menu_sist_integracao TO tivilaverde;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_grupo_usua_menu_sist_integracao TO administrativo;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_c_log_acesso TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_log_acesso TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_log_acesso TO tivilaverde;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_c_log_acesso TO administrativo;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_equip_hosptr TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO tivilaverde;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO administrativo;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_status_leito TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO tivilaverde;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO administrativo;	