-- View: ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv
-- DROP VIEW ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv;

CREATE OR REPLACE VIEW ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv AS
 SELECT replace(dpnv.nm_loc_nome::text, 'LEITO'::text, ''::text) AS nm_loc_nome,
    dpnv.id_loc_leito_id,
    dpnv.dt_dthre,
    dpnv.nm_pac_nome,
    dpnv.fl_pac_sexo,
    dpnv.dt_pac_nasc,
    dpnv.cd_cnv_cod,
    dpnv.nm_cnvo,
    dpnv.ds_cid,
    dpnv.qt_leito_oprcl,
    dpnv.nu_taxa_ocpa,
    dpnv.fl_fmnte,
    dpnv.ds_dieta,
    dpnv.ds_const,
    dpnv.dt_prvs_alta,
    dpnv.nm_mdco,
    dpnv.nm_psco,
    dpnv.nm_trpa,
    dpnv.ds_ocorr,
    dpnv.ds_crtr_intnc,
    dpnv.fl_status_leito,
    dpnv.ds_andar,
    dpnv.dt_atualizacao,
    dpnv.fl_acmpte,
    dpnv.fl_rtgrd,
    dpnv.nu_pcnt_inter,
    dpnv.tp_dia_leito_manut
   FROM ( SELECT c_leito.ds_leito AS nm_loc_nome,
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
            to_char(g_leito.dt_atlz, 'dd/mm/yyyy hh24:mi:ss'::text) AS dt_atualizacao,
            c_leito.fl_acmpte,
            c_leito.fl_rtgrd,
            g_leito.nu_pcnt_inter,
            c_leito.tp_dia_leito_manut
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
                    vw_ctrl_leito.fl_status_leito,
                    vw_ctrl_leito.tp_dia_leito_manut
                   FROM ocupacao.vw_ctrl_leito
                  WHERE "substring"(btrim(vw_ctrl_leito.ds_leito::text), 1, 3) <> 'ECT'::text) c_leito(dt_nasc_pcnt, nm_pcnt, ds_leito, ds_andar, nm_mdco, nm_cnvo, nm_psco, nm_trpa, ds_ocorr, ds_cid, dt_admss, ds_dieta, ds_apto_atvd_fisica, dt_prvs_alta, ds_progra, hr_progra, fl_txclg_agndd, dt_rlzd, fl_rstc_visita, fl_fmnte, ds_pssoa_rtrta, ds_sexo, nm_pcnt_1, fl_acmpte, fl_rtgrd, ds_const, ds_crtr_intnc, fl_status_leito, tp_dia_leito_manut)
             FULL JOIN ocupacao.tb_f_dtlh_pnel_ocpa_leito g_leito ON btrim(g_leito.nm_loc_nome::text) = c_leito.ds_leito::text
          WHERE c_leito.fl_status_leito::text = ANY (ARRAY['Ocupado'::character varying::text, 'Livre'::character varying::text])
          ORDER BY c_leito.ds_leito, g_leito.id_loc_leito_id, c_leito.ds_andar) dpnv
UNION ALL
 SELECT nao_dpnv.m_loc_nome AS nm_loc_nome,
    nao_dpnv.id_loc_leito_id,
    nao_dpnv.dt_dthre,
    nao_dpnv.nm_pac_nome,
    nao_dpnv.fl_pac_sexo,
    nao_dpnv.dt_pac_nasc,
    nao_dpnv.cd_cnv_cod,
    nao_dpnv.nm_cnvo,
    nao_dpnv.ds_cid,
    nao_dpnv.qt_leito_oprcl,
    nao_dpnv.nu_taxa_ocpa,
    nao_dpnv.fl_fmnte,
    nao_dpnv.ds_dieta,
    nao_dpnv.ds_const,
    nao_dpnv.dt_prvs_alta,
    nao_dpnv.nm_mdco,
    nao_dpnv.nm_psco,
    nao_dpnv.nm_trpa,
    nao_dpnv.ds_ocorr,
    nao_dpnv.ds_crtr_intnc,
    nao_dpnv.fl_status_leito,
    nao_dpnv.ds_andar,
    nao_dpnv.dt_atualizacao,
    nao_dpnv.fl_acmpte,
    nao_dpnv.fl_rtgrd,
    nao_dpnv.nu_pcnt_inter,
    nao_dpnv.tp_dia_leito_manut
   FROM ( SELECT replace(c_leito.ds_leito::text, 'LEITO'::text, ''::text) AS m_loc_nome,
            replace(c_leito.ds_leito::text, 'LEITO'::text, ''::text) AS id_loc_leito_id,
            now() AS dt_dthre,
            c_leito.nm_pcnt AS nm_pac_nome,
            c_leito.ds_sexo AS fl_pac_sexo,
            c_leito.dt_nasc_pcnt AS dt_pac_nasc,
            NULL::text AS cd_cnv_cod,
            c_leito.nm_cnvo,
            c_leito.ds_cid,
            0 AS qt_leito_oprcl,
            0 AS nu_taxa_ocpa,
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
            to_char(now(), 'dd/mm/yyyy hh24:mi:ss'::text) AS dt_atualizacao,
            c_leito.fl_acmpte,
            c_leito.fl_rtgrd,
            0 AS nu_pcnt_inter,
            c_leito.tp_dia_leito_manut
           FROM ocupacao.vw_ctrl_leito c_leito
          WHERE "substring"(btrim(c_leito.ds_leito::text), 1, 3) <> 'ECT'::text AND (c_leito.fl_status_leito::text <> ALL (ARRAY['Livre'::character varying::text, 'Ocupado'::character varying::text]))) nao_dpnv;

ALTER TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv
    OWNER TO postgres;

GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO flavia;
GRANT ALL ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO postgres;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO glaucodiretor;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO mvilela;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO asilva;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO dcanin;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO administrativo;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO farmacia;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO posto03;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO tivilaverde;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO alinediniz;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO fcampos;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO posto04;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO lamorim;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO posto01;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO gabriela;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO posto02;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO camila;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO bcorrea;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO evaldo;
GRANT SELECT ON TABLE ocupacao.vw_f_dtlh_pnel_ocpa_leito_nao_dpnv TO qualidade;
