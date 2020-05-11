-- Table: integracao.tb_ctrl_leito
-- DROP TABLE integracao.tb_ctrl_leito;

CREATE TABLE integracao.tb_ctrl_leito_smart
(
	loc_leito_id character varying(255) COLLATE pg_catalog."default",	
	ds_leito character varying(255) COLLATE pg_catalog."default",
	ds_andar character varying(255) COLLATE pg_catalog."default",
	dt_prvs_alta timestamp without time zone,
	nm_pcnt character varying(255) COLLATE pg_catalog."default",
	ds_sexo character varying(255) COLLATE pg_catalog."default",
    dt_nasc_pcnt timestamp without time zone,    
    nm_cnvo character varying(255) COLLATE pg_catalog."default"
)

COMMENT ON TABLE integracao.tb_ctrl_leito_smart
    IS 'Tabela de controle de leito com cópia dos dados do sistema Smart';

COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.dt_nasc_pcnt
    IS 'Data de nascimento do paciente';

COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.nm_pcnt
    IS 'Nome do paciente';

COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.ds_leito
    IS 'Descrição do leito';

COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.ds_andar
    IS 'Descrição do andar do hospital';

COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.dt_prvs_alta
    IS 'Data de previsão de alta';

COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.ds_sexo
    IS 'Descrição do sexo';

COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.loc_leito_id
    IS 'Id do Leito';
	
COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.nm_cnvo
    IS 'Nome do convênio';	
	
ALTER TABLE integracao.tb_ctrl_leito_smart
    ADD COLUMN pac_reg integer;

COMMENT ON COLUMN integracao.tb_ctrl_leito_smart.pac_reg
    IS 'Identificador do paciente.';

GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO administrativo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO alinediniz;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO bcorrea;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO farmacia;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO fcampos;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO flavia;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO gabriela;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO glaucodiretor;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO lamorim;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO mvilela;
GRANT ALL ON TABLE integracao.tb_ctrl_leito_smart TO postgres;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO posto01;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO posto02;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO posto03;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO posto04;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO qualidade;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito_smart TO tivilaverde;

CREATE INDEX ix_ot_pac_reg_smart
    ON integracao.tb_ctrl_leito_smart USING btree
    (pac_reg ASC NULLS LAST)
    TABLESPACE pg_default;

COMMENT ON INDEX integracao.ix_ot_pac_reg_smart
    IS 'Índice de otimização do número do registro paciente.';

----------------------------------------------------------------------------------------------

-- Table: integracao.tb_ctrl_leito
-- DROP TABLE integracao.tb_ctrl_leito;

CREATE TABLE integracao.tb_ctrl_leito
(    
	cd_ctrl_leito integer,
    dt_nasc_pcnt timestamp without time zone,
    nm_pcnt character varying(255) COLLATE pg_catalog."default",
    ds_leito character varying(255) COLLATE pg_catalog."default",
    ds_andar character varying(255) COLLATE pg_catalog."default",
    nm_mdco character varying(255) COLLATE pg_catalog."default",
    nm_cnvo character varying(255) COLLATE pg_catalog."default",
    nm_psco character varying(255) COLLATE pg_catalog."default",
    nm_trpa character varying(255) COLLATE pg_catalog."default",
    ds_ocorr text COLLATE pg_catalog."default",
    ds_cid character varying(255) COLLATE pg_catalog."default",
    dt_admss character varying(255) COLLATE pg_catalog."default",
    ds_dieta character varying(255) COLLATE pg_catalog."default",
    ds_apto_atvd_fisica character varying(255) COLLATE pg_catalog."default",
    dt_prvs_alta timestamp without time zone,
    ds_progra character varying(255) COLLATE pg_catalog."default",
    hr_progra timestamp without time zone,
    fl_txclg_agndd boolean DEFAULT false,
    dt_rlzd character varying(255) COLLATE pg_catalog."default",
    fl_rstc_visita boolean DEFAULT false,
    fl_fmnte boolean DEFAULT false,
    ds_pssoa_rtrta character varying(255) COLLATE pg_catalog."default",
    ds_sexo character varying(255) COLLATE pg_catalog."default",
    ds_const character varying(255) COLLATE pg_catalog."default",
    ds_crtr_intnc character varying(100) COLLATE pg_catalog."default",
    fl_status_leito character varying(255) COLLATE pg_catalog."default",
    fl_acmpte boolean,
    fl_rtgrd boolean,
    tp_dia_leito_manut integer
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE integracao.tb_ctrl_leito
    OWNER to postgres;

GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO administrativo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO alinediniz;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO bcorrea;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO farmacia;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO fcampos;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO flavia;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO gabriela;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO glaucodiretor;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO lamorim;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO mvilela;
GRANT ALL ON TABLE integracao.tb_ctrl_leito_smart TO postgres;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO posto01;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO posto02;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO posto03;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO posto04;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO qualidade;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_ctrl_leito TO tivilaverde;

COMMENT ON TABLE integracao.tb_ctrl_leito
    IS 'Tabela de controle de leito';

COMMENT ON COLUMN integracao.tb_ctrl_leito.cd_ctrl_leito
    IS 'Código do controle de leito';

COMMENT ON COLUMN integracao.tb_ctrl_leito.dt_nasc_pcnt
    IS 'Data de nascimento do paciente';

COMMENT ON COLUMN integracao.tb_ctrl_leito.nm_pcnt
    IS 'Nome do paciente';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_leito
    IS 'Descrição do leito';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_andar
    IS 'Descrição do andar do hospital';

COMMENT ON COLUMN integracao.tb_ctrl_leito.nm_mdco
    IS 'Nome do médico';

COMMENT ON COLUMN integracao.tb_ctrl_leito.nm_cnvo
    IS 'Nome do convênio';

COMMENT ON COLUMN integracao.tb_ctrl_leito.nm_psco
    IS 'Nome do psicólogo';

COMMENT ON COLUMN integracao.tb_ctrl_leito.nm_trpa
    IS 'Nome do terapeuta';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_ocorr
    IS 'Descrição da ocorrência';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_cid
    IS 'Descrição da cidade';

COMMENT ON COLUMN integracao.tb_ctrl_leito.dt_admss
    IS 'Data da admissão';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_dieta
    IS 'Descrição da dieta';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_apto_atvd_fisica
    IS 'Descrição se o paciente está apto para atividade física';

COMMENT ON COLUMN integracao.tb_ctrl_leito.dt_prvs_alta
    IS 'Data de previsão de alta';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_progra
    IS 'Descrição do programa';

COMMENT ON COLUMN integracao.tb_ctrl_leito.hr_progra
    IS 'Hora do programa';

COMMENT ON COLUMN integracao.tb_ctrl_leito.fl_txclg_agndd
    IS 'Flag do exame toxicológico agendado';

COMMENT ON COLUMN integracao.tb_ctrl_leito.dt_rlzd
    IS 'Data realizada';

COMMENT ON COLUMN integracao.tb_ctrl_leito.fl_rstc_visita
    IS 'Flag de restrição de visita';

COMMENT ON COLUMN integracao.tb_ctrl_leito.fl_fmnte
    IS 'Flag se o paciente é fumante';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_pssoa_rtrta
    IS 'Descrição de pessoa restrita';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_sexo
    IS 'Descrição do sexo';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_const
    IS 'Descrição da consistência';

COMMENT ON COLUMN integracao.tb_ctrl_leito.ds_crtr_intnc
    IS 'Carater de Internação';

COMMENT ON COLUMN integracao.tb_ctrl_leito.fl_status_leito
    IS 'Stauts Leito';

COMMENT ON COLUMN integracao.tb_ctrl_leito.fl_acmpte
    IS 'Flag do Acompanhante';

COMMENT ON COLUMN integracao.tb_ctrl_leito.fl_rtgrd
    IS 'Flag do Retaguarda';

COMMENT ON COLUMN integracao.tb_ctrl_leito.tp_dia_leito_manut
    IS 'Tempo em dias de leitos em manutenção';

CREATE INDEX ix_ot_pac_reg
    ON integracao.tb_ctrl_leito USING btree
    (pac_reg ASC NULLS LAST)
    TABLESPACE pg_default;

COMMENT ON INDEX integracao.ix_ot_pac_reg
    IS 'Índice de otimização do número do registro paciente.';
	
ALTER TABLE integracao.tb_ctrl_leito
    ADD COLUMN id_memb_equip_hosptr integer;

COMMENT ON COLUMN integracao.tb_ctrl_leito.id_memb_equip_hosptr
    IS 'Identificador do membro da equipe hospitalar.';	
	
ALTER TABLE integracao.tb_ctrl_leito
    ADD COLUMN id_status_leito integer;

COMMENT ON COLUMN integracao.tb_ctrl_leito.id_status_leito
    IS 'Identificador do status da gestão de leitos.';	
	
ALTER TABLE integracao.tb_ctrl_leito
    ADD COLUMN id_memb_equip_hosptr_mdco integer;

COMMENT ON COLUMN integracao.tb_ctrl_leito.id_memb_equip_hosptr_mdco
    IS 'Id do médico e membro da equipe hospitalar';
	
ALTER TABLE integracao.tb_ctrl_leito
    ADD COLUMN id_memb_equip_hosptr_psco integer;

COMMENT ON COLUMN integracao.tb_ctrl_leito.id_memb_equip_hosptr_psco
    IS 'Id do psicólogo e membro da equipe hospitalar';

ALTER TABLE integracao.tb_ctrl_leito
    ADD COLUMN id_memb_equip_hosptr_trpa integer;

COMMENT ON COLUMN integracao.tb_ctrl_leito.id_memb_equip_hosptr_trpa
    IS 'Id do terapeuta e membro da equipe hospitalar';
	
ALTER TABLE integracao.tb_ctrl_leito
    ADD CONSTRAINT fk_memb_id_mdco FOREIGN KEY (id_memb_equip_hosptr_mdco)
    REFERENCES integracao.tb_equip_hosptr (id_memb_equip_hosptr) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION;

COMMENT ON CONSTRAINT fk_memb_id_mdco ON integracao.tb_ctrl_leito
    IS 'Foreign Key  para id_memb_equip_hosptr_mdco da tabela de membros hospitalares.';
CREATE INDEX fki_fk_memb_id_mdco
    ON integracao.tb_ctrl_leito(id_memb_equip_hosptr_mdco);

ALTER TABLE integracao.tb_ctrl_leito
    ADD CONSTRAINT fk_memb_id_psco FOREIGN KEY (id_memb_equip_hosptr_psco)
    REFERENCES integracao.tb_equip_hosptr (id_memb_equip_hosptr) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION;

COMMENT ON CONSTRAINT fk_memb_id_psco ON integracao.tb_ctrl_leito
    IS 'Foreign Key  para id_memb_equip_hosptr_psco da tabela de membros hospitalares.';
CREATE INDEX fki_fk_memb_id_psco
    ON integracao.tb_ctrl_leito(id_memb_equip_hosptr_psco);
	
ALTER TABLE integracao.tb_ctrl_leito
    ADD CONSTRAINT fk_memb_id_trpa FOREIGN KEY (id_memb_equip_hosptr_trpa)
    REFERENCES integracao.tb_equip_hosptr (id_memb_equip_hosptr) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION;

COMMENT ON CONSTRAINT fk_memb_id_trpa ON integracao.tb_ctrl_leito
    IS 'Foreign Key  para id_memb_equip_hosptr_trpa da tabela de membros hospitalares.';
CREATE INDEX fki_fk_memb_id_trpa
    ON integracao.tb_ctrl_leito(id_memb_equip_hosptr_trpa);

ALTER TABLE integracao.tb_ctrl_leito
    ADD CONSTRAINT fk_status_leito FOREIGN KEY (id_status_leito)
    REFERENCES integracao.tb_status_leito (id_status_leito) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION;

COMMENT ON CONSTRAINT fk_status_leito ON integracao.tb_ctrl_leito
    IS 'Foreign Key da tabela de equipe hospitalar para o status de leito.';
CREATE INDEX fki_fk_status_leito
    ON integracao.tb_ctrl_leito(id_status_leito);
	
	
----------------------------------------------------------------------------------------------------------- Table: integracao.tb_c_usua_acesso
-- DROP TABLE integracao.tb_c_usua_acesso;

-- Table: integracao.tb_c_usua_acesso

-- DROP TABLE integracao.tb_c_usua_acesso;

CREATE TABLE integracao.tb_c_usua_acesso
(
    cd_usua_acesso integer NOT NULL,
    nm_usua_acesso character varying(255) COLLATE pg_catalog."default" NOT NULL,
    fl_sist_admn character varying(255) COLLATE pg_catalog."default",
    cd_usua_incs character varying(255) COLLATE pg_catalog."default" NOT NULL,
    dt_incs timestamp without time zone NOT NULL,
    cd_usua_altr character varying(255) COLLATE pg_catalog."default",
    dt_altr timestamp without time zone,
    ds_usua_acesso character varying(400) COLLATE pg_catalog."default",
    cd_faixa_ip_1 character varying(50) COLLATE pg_catalog."default",
    cd_faixa_ip_2 character varying(50) COLLATE pg_catalog."default",
    fl_acesso_ip character varying(1) COLLATE pg_catalog."default",
    CONSTRAINT pk_usua_acesso PRIMARY KEY (cd_usua_acesso)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE integracao.tb_c_usua_acesso
    OWNER to postgres;

GRANT SELECT ON TABLE integracao.tb_c_usua_acesso TO adrianasilva;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_c_usua_acesso TO evaldo;

GRANT UPDATE, DELETE, SELECT, INSERT ON TABLE integracao.tb_c_usua_acesso TO ftesta;

GRANT INSERT, UPDATE, DELETE, SELECT ON TABLE integracao.tb_c_usua_acesso TO ldaibert;

GRANT DELETE, SELECT, INSERT, UPDATE ON TABLE integracao.tb_c_usua_acesso TO mmattos;

GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE integracao.tb_c_usua_acesso TO mvilela;

GRANT ALL ON TABLE integracao.tb_c_usua_acesso TO postgres;

COMMENT ON TABLE integracao.tb_c_usua_acesso
    IS 'Armazena os usuários de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.cd_usua_acesso
    IS 'Código identificador da tabela de usuários de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.nm_usua_acesso
    IS 'Nome do usuário de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.fl_sist_admn
    IS 'Flag (S/N) se o usuário é administrador ou não.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.cd_usua_incs
    IS 'Código do usuário que realizou a inclusão do registro.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.dt_incs
    IS 'Data de inclusão registro.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.cd_usua_altr
    IS 'Código do usuário que realizou a alteração do registro.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.dt_altr
    IS 'Data de alteração do registro.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.ds_usua_acesso
    IS 'Descrição do usuário de acesso.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.cd_faixa_ip_1
    IS 'Código da faixa de IP 1 permitido para acesso.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.cd_faixa_ip_2
    IS 'Código da faixa de IP 2 permitido para acesso.';

COMMENT ON COLUMN integracao.tb_c_usua_acesso.fl_acesso_ip
    IS 'Flag que estabelece acesso por qualquer IP.';	

---------------------------------------------------------------------------------------------------------
-- Table: cadastro.tb_c_menu_sist_integracao
-- DROP TABLE cadastro.tb_c_menu_sist_integracao;

CREATE TABLE integracao.tb_c_menu_sist_integracao
(
    id_menu_sist_integracao integer NOT NULL,
    nm_menu_sist_integracao character varying(255) NOT NULL,
    fl_menu_princ character varying(1) NOT NULL,
    id_menu_supr integer,
    nm_objt character varying(255) ,
    nm_link_objt character varying(4000) ,
    cd_usua_incs character varying(255) not null,
    dt_incs timestamp without time zone not null,
    cd_usua_altr character varying(255) ,
    dt_altr timestamp without time zone,
    nu_pcao_menu integer,
    CONSTRAINT pk_menu_sist_integracao PRIMARY KEY (id_menu_sist_integracao),
    CONSTRAINT uk_nm_objt UNIQUE (nm_objt)
,
    CONSTRAINT fk_menu_menu_supr FOREIGN KEY (id_menu_supr)
        REFERENCES integracao.tb_c_menu_sist_integracao (id_menu_sist_integracao) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE integracao.tb_c_menu_sist_integracao
    OWNER to postgres;

COMMENT ON TABLE integracao.tb_c_menu_sist_integracao
    IS 'Tabela de Cadastro de Menus utilizados para configurar a aplicação Web do sistema de integracao.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.id_menu_sist_integracao
    IS 'Identificador da tabela de menu do sistema sistema de integracao.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.nm_menu_sist_integracao
    IS 'Nome do menu do sistema de integracao.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.fl_menu_princ
    IS 'Flag se o menu é o principal (S para menu principal, ou N caso contrário).';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.id_menu_supr
    IS 'Identificador do menu superior ao atual.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.nm_objt
    IS 'Nome do objeto que o menu irá acessar.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.nm_link_objt
    IS 'Nome ou endereço do link para o objeto que o menu irá acessar.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.cd_usua_incs
    IS 'Código do usuário que realizou a inclusão do registro.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.dt_incs
    IS 'Data de inclusão registro.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.cd_usua_altr
    IS 'Código do usuário que realizou a alteração do registro.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.dt_altr
    IS 'Data de alteração do registro.';

COMMENT ON COLUMN integracao.tb_c_menu_sist_integracao.nu_pcao_menu
    IS 'Número da posição do menu.';

COMMENT ON CONSTRAINT uk_nm_objt ON integracao.tb_c_menu_sist_integracao
    IS 'Chave única do objeto de menu';

COMMENT ON CONSTRAINT fk_menu_menu_supr ON integracao.tb_c_menu_sist_integracao
    IS 'Foreign key de autorelacionamento entre o menu e submenu.';

	
-- Index: fki_fk_menu_menu_supr
-- DROP INDEX cadastro.fki_fk_menu_menu_supr;

CREATE INDEX fki_fk_menu_menu_supr
    ON integracao.tb_c_menu_sist_integracao USING btree
    (id_menu_supr)
    TABLESPACE pg_default;
---------------------------------------------------------------------------------------------------------
-- Table: integracao.tb_c_grupo_acesso
-- DROP TABLE integracao.tb_c_grupo_acesso;

CREATE TABLE integracao.tb_c_grupo_acesso
(
    id_grupo_acesso integer NOT NULL,
    nm_grupo_acesso character varying(255) NOT NULL,
    cd_usua_incs character varying(255) not null,
    dt_incs timestamp without time zone not null,
    cd_usua_altr character varying(255),
    dt_altr timestamp without time zone,
    CONSTRAINT pk_grupo_acesso PRIMARY KEY (id_grupo_acesso)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE integracao.tb_c_grupo_acesso
    OWNER to postgres;
COMMENT ON TABLE integracao.tb_c_grupo_acesso
    IS 'Armazena os grupos de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_grupo_acesso.id_grupo_acesso
    IS 'Identificador da tabela de grupos de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_grupo_acesso.nm_grupo_acesso
    IS 'Nome do grupo de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_grupo_acesso.cd_usua_incs
    IS 'Código do usuário que realizou a inclusão do registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_acesso.dt_incs
    IS 'Data de inclusão registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_acesso.cd_usua_altr
    IS 'Código do usuário que realizou a alteração do registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_acesso.dt_altr
    IS 'Data de alteração do registro.';
	
---------------------------------------------------------------------------------------------------------
-- Table: integracao.tb_c_grupo_usua_acesso
-- DROP TABLE integracao.tb_c_grupo_usua_acesso;

CREATE TABLE integracao.tb_c_grupo_usua_acesso
(
    id_grupo_usua_acesso integer NOT NULL,
    id_grupo_acesso integer NOT NULL,
	cd_usua_acesso integer NOT NULL,
    cd_usua_incs character varying(255) not null,
    dt_incs timestamp without time zone not null,
    cd_usua_altr character varying(255),
    dt_altr timestamp without time zone,
    CONSTRAINT pk_grupo_usua_acesso PRIMARY KEY (id_grupo_usua_acesso),
    CONSTRAINT uk_grupo_usua_acesso UNIQUE (id_grupo_acesso, cd_usua_acesso)
,
    CONSTRAINT fk_grupo_grupo_usua FOREIGN KEY (id_grupo_acesso)
        REFERENCES integracao.tb_c_grupo_acesso (id_grupo_acesso) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT fk_usua_grupo_usua FOREIGN KEY (cd_usua_acesso)
        REFERENCES integracao.tb_c_usua_acesso (cd_usua_acesso) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE integracao.tb_c_grupo_usua_acesso
    OWNER to postgres;
COMMENT ON TABLE integracao.tb_c_grupo_usua_acesso
    IS 'Armazena os grupos e respectivos usuários de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_acesso.id_grupo_acesso
    IS 'Identificador da tabela de usuários de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_acesso.cd_usua_acesso
    IS 'Identificador da tabela de grupos de acesso para controle de perfil de acesso.';
	
COMMENT ON COLUMN integracao.tb_c_grupo_usua_acesso.cd_usua_incs
    IS 'Código do usuário que realizou a inclusão do registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_acesso.dt_incs
    IS 'Data de inclusão registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_acesso.cd_usua_altr
    IS 'Código do usuário que realizou a alteração do registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_acesso.dt_altr
    IS 'Data de alteração do registro.';

---------------------------------------------------------------------------------------------------------
-- Table: integracao.tb_c_grupo_usua_menu_sist_integracao
-- DROP TABLE integracao.tb_c_grupo_usua_menu_sist_integracao;

CREATE TABLE integracao.tb_c_grupo_usua_menu_sist_integracao
(
    id_grupo_usua_menu_sist_integracao integer NOT NULL,
    id_grupo_acesso integer NOT NULL,
    id_menu_sist_integracao integer NOT NULL,
    cd_usua_incs character varying(255) not null,
    dt_incs timestamp without time zone not null,
    cd_usua_altr character varying(255) ,
    dt_altr timestamp without time zone,
    CONSTRAINT pk_grupo_usua_menu_sist_integracao PRIMARY KEY (id_grupo_usua_menu_sist_integracao),
    CONSTRAINT uk_grupo_usua_menu_sist_integracao UNIQUE (id_grupo_acesso, id_menu_sist_integracao)
,
    CONSTRAINT fk_grupo_sist_integracao_grupo_usua FOREIGN KEY (id_grupo_acesso)
        REFERENCES integracao.tb_c_grupo_acesso (id_grupo_acesso) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT fk_menu_sist_integracao_grupo_usua FOREIGN KEY (id_menu_sist_integracao)
        REFERENCES integracao.tb_c_menu_sist_integracao (id_menu_sist_integracao) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE integracao.tb_c_grupo_usua_menu_sist_integracao
    OWNER to postgres;
COMMENT ON TABLE integracao.tb_c_grupo_usua_menu_sist_integracao
    IS 'Armazena os grupos e respectivos menus de acesso para controle de perfil de acesso ao sistema integracao.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_menu_sist_integracao.id_grupo_usua_menu_sist_integracao
    IS 'Identificador da tabela de grupos de usuários e seus respectivos menus de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_menu_sist_integracao.id_grupo_acesso
    IS 'Identificador do grupos de usuários de acesso para controle de perfil de acesso.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_menu_sist_integracao.cd_usua_incs
    IS 'Código do usuário que realizou a inclusão do registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_menu_sist_integracao.dt_incs
    IS 'Data de inclusão registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_menu_sist_integracao.cd_usua_altr
    IS 'Código do usuário que realizou a alteração do registro.';

COMMENT ON COLUMN integracao.tb_c_grupo_usua_menu_sist_integracao.dt_altr
    IS 'Data de alteração do registro.';
	
-- Table: integracao.tb_c_log_acesso
-- DROP TABLE integracao.tb_c_log_acesso;

CREATE TABLE integracao.tb_c_log_acesso
(
    id_log_acesso integer NOT NULL,
    cd_usua_acesso integer NOT NULL,
    nm_usua_acesso character varying(255) COLLATE pg_catalog."default",
    dt_log_acesso timestamp without time zone,
    CONSTRAINT pk_c_log_acesso PRIMARY KEY (id_log_acesso)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE integracao.tb_c_log_acesso
    OWNER to postgres;

GRANT SELECT ON TABLE integracao.tb_c_log_acesso TO adrianasilva;

GRANT DELETE, UPDATE, INSERT, SELECT ON TABLE integracao.tb_c_log_acesso TO evaldo;

GRANT ALL ON TABLE integracao.tb_c_log_acesso TO postgres;	

-- Table: integracao.tb_equip_hosptr
-- DROP TABLE integracao.tb_equip_hosptr;

create table integracao.tb_equip_hosptr(
	 id_memb_equip_hosptr integer
   , nm_memb_equip_hosptr character varying(255)
   , tp_memb_equip_hosptr character varying(10)
   , cd_usua_incs character varying(255) COLLATE pg_catalog."default" NOT NULL
   , dt_incs timestamp without time zone NOT NULL
   , cd_usua_altr character varying(255) COLLATE pg_catalog."default"
   , dt_altr timestamp without time zone
);

alter table integracao.tb_equip_hosptr add constraint pk_equip_hosptr primary key(id_memb_equip_hosptr);

COMMENT ON TABLE integracao.tb_equip_hosptr
    IS 'Tabela de equipe hospitalar.';

COMMENT ON COLUMN integracao.tb_equip_hosptr.id_memb_equip_hosptr
    IS 'Identificador do membro da equipe hospitalar.';

COMMENT ON COLUMN integracao.tb_equip_hosptr.nm_memb_equip_hosptr
    IS 'Nome do membro da equipe hospitalar.';
	
COMMENT ON COLUMN integracao.tb_equip_hosptr.tp_memb_equip_hosptr
    IS 'Tipo do membro da equipe hospitalar. MDCO - Medico, PSCO - Psicologo, TRPA - Terapeuta.';	


GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO administrativo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO alinediniz;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO bcorrea;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO farmacia;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO fcampos;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO flavia;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO gabriela;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO glaucodiretor;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO lamorim;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO mvilela;
GRANT ALL ON TABLE integracao.tb_equip_hosptr TO postgres;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO posto01;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO posto02;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO posto03;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO posto04;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO qualidade;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_equip_hosptr TO tivilaverde;	

	
-- Table: integracao.tb_status_leito
-- DROP TABLE integracao.tb_status_leito;

create table integracao.tb_status_leito(
	 id_status_leito integer
   , ds_status_leito character varying(255) 
   , fl_ativo character varying(100)
   , cd_usua_incs character varying(255) COLLATE pg_catalog."default" NOT NULL
   , dt_incs timestamp without time zone NOT NULL
   , cd_usua_altr character varying(255) COLLATE pg_catalog."default"
   , dt_altr timestamp without time zone   
);

alter table integracao.tb_status_leito add constraint pk_status_leito primary key(id_status_leito);

COMMENT ON TABLE integracao.tb_status_leito
    IS 'Tabela de equipe hospitalar.';

COMMENT ON COLUMN integracao.tb_status_leito.id_status_leito
    IS 'Identificador do status da gestão de leitos.';

COMMENT ON COLUMN integracao.tb_status_leito.ds_status_leito
    IS 'Nome do status da gestão de leitos.';

COMMENT ON COLUMN integracao.tb_status_leito.fl_ativo
    IS 'Flag se status ativo. Sim, Nao';
	
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO administrativo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO alinediniz;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO bcorrea;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO camila;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO evaldo;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO farmacia;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO fcampos;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO flavia;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO gabriela;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO glaucodiretor;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO lamorim;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO mvilela;
GRANT ALL ON TABLE integracao.tb_status_leito TO postgres;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO posto01;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO posto02;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO posto03;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO posto04;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO qualidade;
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE integracao.tb_status_leito TO tivilaverde;	