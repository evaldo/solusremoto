-- View: cadastro.vw_menu_princ_integracao
-- DROP VIEW cadastro.vw_menu_princ_integracao;

CREATE OR REPLACE VIEW integracao.vw_menu_princ_integracao AS
 SELECT menu_princ.nm_menu_sist_integracao AS menu_principal,
    COALESCE(sub_menu.nm_menu_sist_integracao, '-') AS sub_menu,
    COALESCE(menu_princ.nm_objt, '-') AS nm_objt_menu_princ,
    COALESCE(sub_menu.nm_objt, '-') AS nm_objt_sub_menu_princ,
    COALESCE(menu_princ.nm_link_objt, '-') AS nm_link_objt_menu_princ,
    COALESCE(sub_menu.nm_link_objt, '-') AS nm_link_objt_sub_menu_princ,
    ( SELECT count(1) AS count
           FROM integracao.tb_c_menu_sist_integracao
          WHERE integracao.tb_c_menu_sist_integracao.id_menu_supr = menu_princ.id_menu_sist_integracao) AS qt_menu_nivel_1,
    ( SELECT count(1) AS count
           FROM integracao.tb_c_menu_sist_integracao
          WHERE tb_c_menu_sist_integracao.id_menu_supr = sub_menu.id_menu_sist_integracao) AS qt_menu_nivel_2,
    menu_princ.nu_pcao_menu
   FROM integracao.tb_c_menu_sist_integracao menu_princ
     FULL JOIN integracao.tb_c_menu_sist_integracao sub_menu ON menu_princ.id_menu_sist_integracao = sub_menu.id_menu_supr
  WHERE menu_princ.nm_menu_sist_integracao IS NOT NULL AND menu_princ.fl_menu_princ = 'S'
  ORDER BY menu_princ.nu_pcao_menu;

ALTER TABLE integracao.vw_menu_princ_integracao
    OWNER TO postgres;
	
	
-- View: integracao.vw_menu_princ_usua
-- DROP VIEW integracao.vw_menu_princ_usua;

CREATE OR REPLACE VIEW integracao.vw_menu_princ_usua AS
 SELECT menu_princ.menu_principal,
    menu_princ.sub_menu,
    menu_princ.nm_objt_menu_princ,
    menu_princ.nm_objt_sub_menu_princ,
    menu_princ.nm_link_objt_menu_princ,
    menu_princ.nm_link_objt_sub_menu_princ,
    menu_princ.qt_menu_nivel_1,
    menu_princ.qt_menu_nivel_2,
    menu_princ.nu_pcao_menu,
    menu_princ_usua.nm_usua_acesso
   FROM integracao.vw_menu_princ_integracao menu_princ,
    integracao.vw_menu_princ_integracao_usua menu_princ_usua
  WHERE menu_princ.sub_menu = menu_princ_usua.nm_menu_sist_integracao;

ALTER TABLE integracao.vw_menu_princ_usua
    OWNER TO postgres;
	
	
-- View: integracao.vw_menu_princ_integracao_usua
-- DROP VIEW integracao.vw_menu_princ_integracao_usua;

CREATE OR REPLACE VIEW integracao.vw_menu_princ_integracao_usua AS
 SELECT menu.id_menu_sist_integracao,
    menu.nm_menu_sist_integracao,
    menu.fl_menu_princ,
    menu.id_menu_supr,
    menu.nm_objt,
    menu.nm_link_objt,
    menu.cd_usua_incs,
    menu.dt_incs,
    menu.cd_usua_altr,
    menu.dt_altr,
    menu.nu_pcao_menu,
    usua_acesso.nm_usua_acesso
   FROM integracao.tb_c_grupo_usua_menu_sist_integracao grupo_menu,
    integracao.tb_c_usua_acesso usua_acesso,
    integracao.tb_c_grupo_acesso grupo_acesso,
    integracao.tb_c_menu_sist_integracao menu,
    integracao.tb_c_grupo_usua_acesso grupo_usua
  WHERE grupo_menu.id_grupo_acesso = grupo_acesso.id_grupo_acesso 
    AND grupo_menu.id_menu_sist_integracao = menu.id_menu_sist_integracao 
	AND grupo_acesso.id_grupo_acesso = grupo_usua.id_grupo_acesso 
	AND grupo_usua.cd_usua_acesso = usua_acesso.cd_usua_acesso;

ALTER TABLE integracao.vw_menu_princ_integracao_usua
    OWNER TO postgres;