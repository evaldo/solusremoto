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

GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao TO administrativo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao TO camila;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao TO evaldo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao TO tivilaverde;
	
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
	
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao_usua TO administrativo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao_usua TO camila;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao_usua TO evaldo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_integracao_usua TO tivilaverde;

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

GRANT SELECT ON TABLE integracao.vw_menu_princ_usua TO administrativo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_usua TO camila;
GRANT SELECT ON TABLE integracao.vw_menu_princ_usua TO evaldo;
GRANT SELECT ON TABLE integracao.vw_menu_princ_usua TO tivilaverde;


-- View: ocupacao.vw_hstr_tp_ocpa_leito_status_integracao
-- DROP VIEW ocupacao.vw_hstr_tp_ocpa_leito_status_integracao;

CREATE OR REPLACE VIEW ocupacao.vw_hstr_tp_ocpa_leito_status_integracao AS
 SELECT data.id_hstr_status_leito,
    data.ds_leito,
    data.dt_inicio_mvto,
    data.ds_status
   FROM dblink('vila_verde'::text, '
    SELECT id_hstr_status_leito,
		   ds_leito,
		   dt_inicio_mvto,
		   ds_status  
     from vila_verde.integracao.tb_f_hstr_ocpa_leito_status'::text) data(id_hstr_status_leito integer, ds_leito character varying(255), dt_inicio_mvto timestamp without time zone, ds_status character varying(255));

ALTER TABLE ocupacao.vw_hstr_tp_ocpa_leito_status_integracao
    OWNER TO postgres;

GRANT SELECT ON TABLE ocupacao.vw_hstr_tp_ocpa_leito_status_integracao TO rl_consulta_ctrl_leito;
GRANT ALL ON TABLE ocupacao.vw_hstr_tp_ocpa_leito_status_integracao TO postgres;


create or replace view integracao.vw_ctrl_leito as
SELECT trim(smart.ds_leito) ds_leito
	, smart.ds_andar
	, smart.dt_prvs_alta
	, smart.nm_pcnt
	, smart.ds_sexo
	, smart.dt_nasc_pcnt
	, smart.nm_cnvo
	, smart.pac_reg
	, smart.dt_admss
FROM  integracao.tb_ctrl_leito_smart smart
union
select leito.ds_leito
	, substring(leito.loc_leito_id, 1,1) as ds_andar
	, null
	, null
	, null
	, null
	, null
	, 0
	, null
from integracao.tb_leito leito
where leito.ds_leito not in (select trim(ds_leito) from integracao.tb_ctrl_leito_smart)
order by 1


-- View: integracao.vw_bmh_online
-- DROP VIEW integracao.vw_bmh_online;

CREATE OR REPLACE VIEW integracao.vw_bmh_online AS
SELECT 'Admissão' AS tipo_bmh_online,    
    to_char(tb_bmh_online.dt_admss, 'dd/mm/yyyy hh24:mi') AS dt_admss,
    tb_bmh_online.nm_pcnt,
    to_char(tb_bmh_online.dt_nasc_pcnt, 'dd/mm/yyyy') AS dt_nasc_pcnt,
    tb_bmh_online.nm_cnvo,
    tb_bmh_online.nm_mdco,
    tb_bmh_online.nm_psco,
    tb_bmh_online.nm_trpa,
    tb_bmh_online.ds_cid,
        CASE
            WHEN tb_bmh_online.fl_fmnte = true THEN 'Sim'
            ELSE 'Não'
        END AS fl_fmnte,
        CASE
            WHEN tb_bmh_online.fl_rtgrd = true THEN 'Sim'
            ELSE 'Não'
        END AS fl_rtgrd,
        CASE
            WHEN tb_bmh_online.fl_acmpte = true THEN 'Sim'
            ELSE 'Não'
        END AS fl_acmpte,
    tb_bmh_online.ds_crtr_intnc,
    tb_bmh_online.ds_dieta,
    tb_bmh_online.ds_const,
    tb_bmh_online.ds_ocorr,
    '' AS destino_alta,
    tb_bmh_online.dt_alta,
    tb_bmh_online.ds_leito
   FROM integracao.tb_bmh_online
  WHERE (tb_bmh_online.ds_leito not like 'EC%' OR tb_bmh_online.ds_leito IS NULL) AND tb_bmh_online.fl_rtgrd=false AND tb_bmh_online.fl_acmpte=false  
UNION ALL
 SELECT 'Alta'::text AS tipo_bmh_online,
    to_char(bmh.dt_admss, 'dd/mm/yyyy hh24:mi'::text) AS dt_admss,
    bmh.nm_pcnt,
    to_char(bmh.dt_nasc_pcnt, 'dd/mm/yyyy'::text) AS dt_nasc_pcnt,
    bmh.nm_cnvo,
    bmh.nm_mdco,
    bmh.nm_psco,
    bmh.nm_trpa,
    bmh.ds_cid,
        CASE
            WHEN bmh.fl_fmnte = true THEN 'Sim'::text
            ELSE 'Não'::text
        END AS fl_fmnte,
        CASE
            WHEN bmh.fl_rtgrd = true THEN 'Sim'::text
            ELSE 'Não'::text
        END AS fl_rtgrd,
        CASE
            WHEN bmh.fl_acmpte = true THEN 'Sim'::text
            ELSE 'Não'::text
        END AS fl_acmpte,
    bmh.ds_crtr_intnc,
    bmh.ds_dieta,
    bmh.ds_const,
    bmh.ds_ocorr,
    alta.ds_mtvo_alta AS destino_alta,
    bmh.dt_alta,
    bmh.ds_leito
   FROM integracao.tb_bmh_online bmh,
    integracao.tb_mtvo_alta alta
  WHERE bmh.id_mtvo_alta = alta.id_mtvo_alta
    and (bmh.ds_leito not like 'EC%' OR bmh.ds_leito IS NULL) AND bmh.fl_rtgrd=false AND bmh.fl_acmpte=false;

ALTER TABLE integracao.vw_bmh_online
    OWNER TO postgres;

GRANT SELECT ON TABLE integracao.vw_bmh_online TO emenezes;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO simone;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO bcorrea;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO dayane;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO aoliveira;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO dchinelato;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO lmaria;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO dalves;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO tnovaes;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO mrezende;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO grazielle;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO pferreira;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO vlucia;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO gcassia;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO administrativo;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO bsouza;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO amonteiro;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO tivilaverde;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO deliza;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO ronan;
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE integracao.vw_bmh_online TO elaurentino;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO axavier;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO poliveira;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO soliveira;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO mmattos;
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE integracao.vw_bmh_online TO mmoravia;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO jmiguel;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO fmedeiros;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO fernandazeferino;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO camila;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO sbhering;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO ftesta;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO woliveira;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO evaldo;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO vrodrigues;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO vandrade;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO wquetz;
GRANT ALL ON TABLE integracao.vw_bmh_online TO postgres;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO ralmeida;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO mvilela;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO mariabethania;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO vsilva;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO farmacia;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO dfajardo;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO fcampos;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO amorais;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO clovismelo;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO coliveira;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO tsilva;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO lvieira;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO ldelgado;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO opacheco;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO lamorim;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO aalbino;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO mliberato;
GRANT SELECT ON TABLE integracao.vw_bmh_online TO greis;


--SQLServer -> Smart
--EXEC sp_helptext 'dbo.view_db_gest_leitos';  
--EXEC sp_helptext 'dbo.view_medico_leito_pac';  
create view dbo.view_medico_leito_pac as
SELECT distinct 
       hsp.HSP_PAC
     , pac.PAC_NOME
	 , psv.PSV_COD
	 , psv.PSV_APEL
	 , hsp.HSP_STAT
	 , hsp.HSP_MODALIDADE 
FROM dbo.PAC as pac INNER JOIN (
		dbo.HSP as hsp INNER JOIN dbo.PSV as psv ON hsp.HSP_MDE = psv.PSV_COD) ON pac.PAC_REG = hsp.HSP_PAC 
WHERE (((hsp.HSP_STAT)='A') AND ((hsp.HSP_MODALIDADE)='HS'));


-- View: integracao.vw_bmh_online_media_admissao
-- DROP VIEW integracao.vw_bmh_online_media_admissao;

CREATE OR REPLACE VIEW integracao.vw_bmh_online_media_admissao AS
 SELECT to_char(bmh.dt_admss, 'mm/yyyy'::text) AS mes_ano_qtde_admss,
    count(bmh.pac_reg) AS nu_qtde_reg,
	to_date('01/'||to_char(bmh.dt_admss, 'mm/yyyy'::text), 'dd/mm/yyyy') as data_mes_ano,
	to_char(bmh.dt_admss, 'TMMonth'::text) AS mes_admissao
   FROM integracao.tb_bmh_online bmh
  WHERE (bmh.ds_leito::text !~~ 'EC%'::text OR bmh.ds_leito IS NULL) AND bmh.fl_rtgrd = false AND bmh.fl_acmpte = false AND to_char(bmh.dt_admss, 'mm/yyyy'::text) >= '06/2020'::text
  GROUP BY (to_char(bmh.dt_admss, 'mm/yyyy'::text))
          , to_date('01/'||to_char(bmh.dt_admss, 'mm/yyyy'::text), 'dd/mm/yyyy')
		  , to_char(bmh.dt_admss, 'TMMonth'::text);

ALTER TABLE integracao.vw_bmh_online_media_admissao
    OWNER TO postgres;

--------------------------------------------------------------------------------------------------------------------

-- View: integracao.vw_bmh_online_media_alta
-- DROP VIEW integracao.vw_bmh_online_media_alta;

CREATE OR REPLACE VIEW integracao.vw_bmh_online_media_alta AS
 SELECT to_char(bmh.dt_admss, 'mm/yyyy'::text) AS mes_ano_qtde_alta,
    count(bmh.pac_reg) AS nu_qtde_reg,
	to_date('01/'||to_char(bmh.dt_admss, 'mm/yyyy'::text), 'dd/mm/yyyy') AS data_mes_ano,
	to_char(bmh.dt_admss, 'TMMonth'::text) AS mes_alta
   FROM integracao.tb_bmh_online bmh,
    integracao.tb_mtvo_alta alta
  WHERE bmh.id_mtvo_alta = alta.id_mtvo_alta AND (bmh.ds_leito::text !~~ 'EC%'::text OR bmh.ds_leito IS NULL) AND bmh.fl_rtgrd = false AND bmh.fl_acmpte = false AND to_char(bmh.dt_admss, 'mm/yyyy'::text) >= '06/2020'::text
  GROUP BY (to_char(bmh.dt_admss, 'mm/yyyy'::text))
         ,  to_date('01/'||to_char(bmh.dt_admss, 'mm/yyyy'::text), 'dd/mm/yyyy')
		 , to_char(bmh.dt_admss, 'TMMonth'::text);

ALTER TABLE integracao.vw_bmh_online_media_alta
    OWNER TO postgres;

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-- View: integracao.vw_bmh_online_por_municipio
-- DROP VIEW integracao.vw_bmh_online_por_municipio;

CREATE OR REPLACE VIEW integracao.vw_bmh_online_por_municipio AS
 SELECT to_char(bmh.dt_admss, 'mm/yyyy'::text) AS mes_ano_qtde,
    count(bmh.pac_reg) AS nu_qtde_reg,
	ds_cidade,
	to_char(bmh.dt_admss, 'TMMonth'::text) AS mes,
	to_date('01/'||to_char(bmh.dt_admss, 'mm/yyyy'::text), 'dd/mm/yyyy') AS data_mes_ano
   FROM integracao.tb_bmh_online bmh    
  WHERE (bmh.ds_leito::text !~~ 'EC%'::text OR bmh.ds_leito IS NULL) AND bmh.fl_rtgrd = false AND bmh.fl_acmpte = false AND to_char(bmh.dt_admss, 'mm/yyyy'::text) >= '06/2020'::text
  GROUP BY (to_char(bmh.dt_admss, 'mm/yyyy'::text))
         , ds_cidade
		 , to_char(bmh.dt_admss, 'TMMonth'::text),
		 to_date('01/'||to_char(bmh.dt_admss, 'mm/yyyy'::text), 'dd/mm/yyyy');

ALTER TABLE integracao.vw_bmh_online_por_municipio
    OWNER TO postgres;
	
--------------------------------------------------------------------------------------------------------------------------------------------------

-- View: integracao.vw_bmh_online_media_alta
-- DROP VIEW integracao.vw_bmh_online_media_alta;

CREATE OR REPLACE VIEW integracao.vw_bmh_online_media_alta AS
 SELECT to_char(bmh.dt_alta, 'mm/yyyy') AS mes_ano_qtde_alta    
    , to_date('01/'|| to_char(bmh.dt_alta, 'mm/yyyy'), 'dd/mm/yyyy')
	, to_char(bmh.dt_alta, 'TMMonth')
	, count(bmh.pac_reg) AS nu_qtde_reg
   FROM integracao.tb_bmh_online bmh,
    integracao.tb_mtvo_alta alta
  WHERE bmh.id_mtvo_alta = alta.id_mtvo_alta     
	AND (bmh.ds_leito::text !~~ 'EC%'::text OR bmh.ds_leito IS NULL) AND bmh.fl_rtgrd = false AND bmh.fl_acmpte = false 
	AND to_char(bmh.dt_alta, 'mm/yyyy') >= '06/2020'
  GROUP BY to_char(bmh.dt_alta, 'mm/yyyy')
         , to_date('01/'|| to_char(bmh.dt_alta, 'mm/yyyy'), 'dd/mm/yyyy')
		 , to_char(bmh.dt_alta, 'TMMonth');

ALTER TABLE integracao.vw_bmh_online_media_alta
    OWNER TO postgres;

