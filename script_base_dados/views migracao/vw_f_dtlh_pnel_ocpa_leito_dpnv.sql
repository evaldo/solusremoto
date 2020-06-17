-- View: ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv
-- DROP VIEW ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv;

CREATE OR REPLACE VIEW ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv AS
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
    g_leito.dt_atlz,
    c_leito.fl_acmpte,
    c_leito.fl_rtgrd,
    g_leito.nu_pcnt_inter
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
            vw_ctrl_leito.nm_pcnt,
            vw_ctrl_leito.fl_acmpte,
            vw_ctrl_leito.fl_rtgrd,
            vw_ctrl_leito.ds_const,
            vw_ctrl_leito.ds_crtr_intnc,
            vw_ctrl_leito.fl_status_leito
           FROM ocupacao.vw_ctrl_leito
          WHERE "substring"(btrim(vw_ctrl_leito.ds_leito::text), 1, 3) <> 'ECT'::text) c_leito( dt_nasc_pcnt, nm_pcnt, ds_leito, ds_andar, nm_mdco, nm_cnvo, nm_psco, nm_trpa, ds_ocorr, ds_cid, dt_admss, ds_dieta, ds_apto_atvd_fisica, dt_prvs_alta, ds_progra, hr_progra, fl_txclg_agndd, dt_rlzd, fl_rstc_visita, fl_fmnte, ds_pssoa_rtrta, ds_sexo, nm_pcnt_1, fl_acmpte, fl_rtgrd, ds_const, ds_crtr_intnc, fl_status_leito)
     FULL JOIN ocupacao.tb_f_dtlh_pnel_ocpa_leito g_leito ON btrim(g_leito.nm_loc_nome::text) = c_leito.ds_leito::text
  WHERE c_leito.fl_status_leito::text = ANY (ARRAY['Ocupado'::character varying::text, 'Livre'::character varying::text])
  ORDER BY c_leito.ds_leito, g_leito.id_loc_leito_id, c_leito.ds_andar;

ALTER TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv
    OWNER TO postgres;

GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO flavia;
GRANT ALL ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO postgres;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO glaucodiretor;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO mvilela;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO asilva;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO dcanin;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO administrativo;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO farmacia;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO posto03;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO tivilaverde;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO alinediniz;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO fcampos;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO posto04;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO lamorim;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO posto01;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO gabriela;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO posto02;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO camila;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO bcorrea;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO evaldo;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_dpnv TO qualidade;
