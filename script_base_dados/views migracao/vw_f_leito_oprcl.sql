-- View: ocupacao.vw_f_leito_oprcl
-- DROP VIEW ocupacao.vw_f_leito_oprcl;

CREATE OR REPLACE VIEW ocupacao.vw_f_leito_oprcl AS
 SELECT c_leito.cd_ctrl_leito,
    c_leito.dt_nasc_pcnt,
    c_leito.nm_pcnt,
    c_leito.ds_leito,
    c_leito.ds_andar,
    c_leito.nm_mdco,
    c_leito.nm_cnvo,
    c_leito.nm_psco,
    c_leito.nm_trpa,
    c_leito.ds_ocorr,
    c_leito.ds_cid,
    c_leito.dt_admss,
    c_leito.ds_dieta,
    c_leito.ds_apto_atvd_fisica,
    c_leito.dt_prvs_alta,
    c_leito.ds_progra,
    c_leito.hr_progra,
    c_leito.fl_txclg_agndd,
    c_leito.dt_rlzd,
    c_leito.fl_rstc_visita,
    c_leito.fl_fmnte,
    c_leito.ds_pssoa_rtrta,
    c_leito.ds_sexo,
    c_leito.fl_acmpte,
    c_leito.fl_rtgrd,
    c_leito.ds_const,
    c_leito.ds_crtr_intnc,
    c_leito.fl_status_leito
   FROM ocupacao.vw_ctrl_leito c_leito
  WHERE "substring"(btrim(c_leito.ds_leito::text), 1, 3) <> 'ECT'::text AND (c_leito.fl_status_leito::text = ANY (ARRAY['Ocupado'::character varying::text, 'Livre'::character varying::text])) 
     AND (c_leito.fl_acmpte = false or c_leito.fl_acmpte = null)
  ORDER BY c_leito.nm_pcnt;

ALTER TABLE ocupacao.vw_f_leito_oprcl
    OWNER TO postgres;

GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO gabriela;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO posto02;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO posto03;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO bcorrea;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO alinediniz;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO fcampos;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO posto04;
GRANT ALL ON TABLE ocupacao.vw_f_leito_oprcl TO postgres;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO lamorim;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO mvilela;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO posto01;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO asilva;
GRANT SELECT ON TABLE ocupacao.vw_f_leito_oprcl TO dcanin;
