-- Table: integracao.tb_ctrl_leito
-- DROP TABLE integracao.tb_ctrl_leito;

CREATE TABLE integracao.tb_ctrl_leito
(
    cd_ctrl_leito integer NOT NULL,
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
    fl_status_leito character varying(10) COLLATE pg_catalog."default",
    fl_acmpte boolean,
    fl_rtgrd boolean,
    CONSTRAINT pk_integracao_ctrl_leito PRIMARY KEY (cd_ctrl_leito)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE integracao.tb_ctrl_leito
    OWNER to postgres;
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