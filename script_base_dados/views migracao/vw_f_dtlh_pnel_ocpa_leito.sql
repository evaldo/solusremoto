-- View: ocupacao.vw_f_dtlh_pnel_ocpa_leito
-- DROP VIEW ocupacao.vw_f_dtlh_pnel_ocpa_leito;

CREATE OR REPLACE VIEW ocupacao.vw_f_dtlh_pnel_ocpa_leito AS
 SELECT g_leito.nm_loc_nome,
    g_leito.id_loc_leito_id,
    g_leito.dt_dthre,
    g_leito.nm_pac_nome,
    g_leito.fl_pac_sexo,
    g_leito.dt_pac_nasc,
    g_leito.cd_cnv_cod,
    g_leito.nm_cnv_nome AS nm_cnvo,
    c_leito.ds_cid,
    g_leito.qt_leito_oprcl,
    g_leito.nu_taxa_ocpa,
    c_leito.fl_fmnte,
    c_leito.ds_dieta,
    c_leito.ds_const,
    c_leito.dt_prvs_alta,
    c_leito.nm_mdco,
    c_leito.nm_psco,
    c_leito.nm_trpa,
    c_leito.ds_ocorr,
    c_leito.ds_crtr_intnc,
    c_leito.fl_status_leito,
    c_leito.ds_andar,
    to_char(g_leito.dt_atlz, 'dd/mm/yyyy hh24:mi:ss'::text) AS dt_atualizacao
   FROM ( SELECT vw_ctrl_leito.dt_nasc_pcnt,
            vw_ctrl_leito.nm_pcnt,
            vw_ctrl_leito.ds_leito,
            vw_ctrl_leito.ds_andar,
            vw_ctrl_leito.nm_mdco,
            vw_ctrl_leito.nm_cnvo,
            vw_ctrl_leito.nm_psco,
            vw_ctrl_leito.nm_trpa,
            vw_ctrl_leito.ds_ocorr,
            vw_ctrl_leito.ds_cid,
            vw_ctrl_leito.dt_admss,
            vw_ctrl_leito.ds_dieta,
            vw_ctrl_leito.ds_apto_atvd_fisica,
            vw_ctrl_leito.dt_prvs_alta,
            vw_ctrl_leito.ds_progra,
            vw_ctrl_leito.hr_progra,
            vw_ctrl_leito.fl_txclg_agndd,
            vw_ctrl_leito.dt_rlzd,
            vw_ctrl_leito.fl_rstc_visita,
            vw_ctrl_leito.fl_fmnte,
            vw_ctrl_leito.ds_pssoa_rtrta,
            vw_ctrl_leito.ds_sexo,
            vw_ctrl_leito.ds_const,
            vw_ctrl_leito.ds_crtr_intnc,
            vw_ctrl_leito.fl_status_leito
           FROM ocupacao.vw_ctrl_leito
          WHERE "substring"(vw_ctrl_leito.ds_leito::text, 1, 3) <> 'ECT'::text AND substring(vw_ctrl_leito.nm_pcnt::text, 1,5) <> 'ACOMP'::text AND (vw_ctrl_leito.fl_acmpte = false or vw_ctrl_leito.fl_acmpte =null) AND (vw_ctrl_leito.fl_rtgrd = false or vw_ctrl_leito.fl_rtgrd = null)) c_leito
     FULL JOIN ocupacao.tb_f_dtlh_pnel_ocpa_leito g_leito ON btrim(g_leito.nm_loc_nome::text) = btrim(c_leito.ds_leito::text)
  WHERE "substring"(g_leito.nm_loc_nome::text, 1, 3) <> 'ECT'::text AND "substring"(g_leito.nm_pac_nome::text, 1, 5) <> 'ACOMP'::text
  ORDER BY c_leito.ds_leito, g_leito.id_loc_leito_id, c_leito.ds_andar;

ALTER TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito
    OWNER TO postgres;

GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO flavia;
GRANT ALL ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO postgres;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO glaucodiretor;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO mvilela;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO asilva;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO dcanin;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO administrativo;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO farmacia;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO posto03;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO tivilaverde;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO alinediniz;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO fcampos;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO posto04;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO lamorim;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO posto01;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO gabriela;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO posto02;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO camila;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO bcorrea;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO evaldo;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito TO qualidade;
