--Example
CREATE INDEX ix_ot_nu_pac_reg
    ON pts.tb_agdmto_atvd_pts USING btree
    (nu_pac_reg ASC NULLS LAST)
    TABLESPACE pg_default;

COMMENT ON INDEX pts.ix_ot_nu_pac_reg
    IS 'Índice do número do paciente.';
	
CREATE INDEX ix_ot_pac_reg_smart_02
    ON integracao.tb_ctrl_leito_smart USING btree
    (ds_leito ASC NULLS LAST)
    TABLESPACE pg_default;

COMMENT ON INDEX integracao.ix_ot_pac_reg_smart_02
    IS 'Índice da tabela do smart por leito';
	

CREATE INDEX ix_ot_ds_leito_temp_02
    ON integracao.tb_ctrl_leito_temp USING btree
    (ds_leito ASC NULLS LAST)
    TABLESPACE pg_default;

COMMENT ON INDEX integracao.ix_ot_ds_leito_temp_02
    IS 'Índice com base no número do leito';