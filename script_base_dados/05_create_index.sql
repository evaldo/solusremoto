--Example
CREATE INDEX ix_ot_nu_pac_reg
    ON pts.tb_agdmto_atvd_pts USING btree
    (nu_pac_reg ASC NULLS LAST)
    TABLESPACE pg_default;

COMMENT ON INDEX pts.ix_ot_nu_pac_reg
    IS 'Índice do número do paciente.';