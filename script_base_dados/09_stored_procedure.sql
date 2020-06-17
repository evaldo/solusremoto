-- FUNCTION: integracao.prc_processa_bmh_online()

-- DROP FUNCTION integracao.prc_processa_bmh_online();

CREATE OR REPLACE FUNCTION integracao.prc_processa_bmh_online(
	)
    RETURNS character
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE 
AS $BODY$
DECLARE 

	cur_smart REFCURSOR;
	rec_smart RECORD;
	
	cur_smart_alta REFCURSOR;
	rec_smart_alta RECORD;
	
	cur_leito REFCURSOR;
	rec_leito RECORD;
		
	rows_affected int;	
	qtde_reg_smart int;
	
	dt_alta_smart timestamp without time zone;
	ds_cidade_smart character varying(255);
	
BEGIN

	rows_affected := 0;		
	
	OPEN cur_smart FOR 
	  SELECT pac_reg
	       , nm_pcnt
		   , dt_admss		   
		   , ds_sexo
		   , dt_nasc_pcnt
		   , nm_cnvo		   
	FROM integracao.tb_ctrl_leito_smart order by 1;
	
	LOOP
	
		FETCH cur_smart INTO rec_smart;			
		EXIT WHEN NOT FOUND;
		
		SELECT count(1) into qtde_reg_smart 
			from integracao.tb_bmh_online 
		where pac_reg = rec_smart.pac_reg
		   and dt_admss = rec_smart.dt_admss;
		
		if qtde_reg_smart = 0 then		
			INSERT into integracao.tb_bmh_online (pac_reg, nm_pcnt, dt_admss, ds_sexo, dt_nasc_pcnt, nm_cnvo)
			values
			    (rec_smart.pac_reg
				   , rec_smart.nm_pcnt
				   , rec_smart.dt_admss		   
				   , rec_smart.ds_sexo
				   , rec_smart.dt_nasc_pcnt
				   , rec_smart.nm_cnvo);
		else
		
			OPEN cur_leito FOR 
				SELECT    pac_reg 
						 , dt_nasc_pcnt
						 , nm_pcnt
						 , ds_leito
						 , ds_andar
						 , nm_mdco
						 , nm_cnvo
						 , nm_psco
						 , nm_trpa
						 , ds_ocorr
						 , ds_cid
						 , dt_admss
						 , ds_dieta
						 , fl_fmnte
						 , ds_const
						 , ds_crtr_intnc
						 , fl_status_leito
						 , fl_acmpte
						 , fl_rtgrd
						 , id_status_leito
						 , id_memb_equip_hosptr_mdco
						 , id_memb_equip_hosptr_psco
						 , id_memb_equip_hosptr_trpa	 
					FROM integracao.tb_ctrl_leito
					where pac_reg = rec_smart.pac_reg;

				FETCH cur_leito INTO rec_leito;			
					EXIT WHEN NOT FOUND;

				UPDATE integracao.tb_bmh_online SET 
					fl_fmnte = rec_leito.fl_fmnte , 
					fl_rtgrd = rec_leito.fl_rtgrd , 
					fl_acmpte = rec_leito.fl_acmpte , 
					fl_status_leito = rec_leito.fl_status_leito ,  
					id_status_leito = rec_leito.id_status_leito ,				
					id_memb_equip_hosptr_mdco = rec_leito.id_memb_equip_hosptr_mdco , 
					nm_mdco = rec_leito.nm_mdco , 
					id_memb_equip_hosptr_psco = rec_leito.id_memb_equip_hosptr_psco , 
					nm_psco = rec_leito.nm_psco , 
					id_memb_equip_hosptr_trpa = rec_leito.id_memb_equip_hosptr_trpa , 				
					nm_trpa =   rec_leito.nm_trpa ,				
					ds_cid = 	rec_leito.ds_cid ,
					ds_dieta =  rec_leito.ds_dieta ,
					ds_const = rec_leito.ds_const ,
					ds_ocorr = rec_leito.ds_ocorr , 
					ds_crtr_intnc = rec_leito.ds_crtr_intnc 				 
					WHERE pac_reg = rec_smart.pac_reg
					  and dt_admss = rec_smart.dt_admss;
				
				close cur_leito;
				
		end if;
		
		rows_affected := rows_affected + 1;		
	
	END LOOP;

	open cur_smart_alta for
	
		SELECT pac_reg, dt_admss			
		from integracao.tb_bmh_online
		WHERE dt_alta is null;
		
	LOOP
		FETCH cur_smart_alta INTO rec_smart_alta;			
			EXIT WHEN NOT FOUND;

		SELECT dt_alta, ds_cidade
		into dt_alta_smart, ds_cidade_smart
			FROM integracao.tb_ctrl_leito_smart_alta
		where pac_reg = rec_smart_alta.pac_reg
		  and dt_admss = rec_smart_alta.dt_admss;

		if dt_alta_smart is not null then
			UPDATE integracao.tb_bmh_online SET
				dt_alta = dt_alta_smart ,
				ds_cidade = ds_cidade_smart
			WHERE pac_reg =rec_smart_alta.pac_reg
			  and dt_admss = rec_smart_alta.dt_admss;
			  
			 qtde_reg_smart:=qtde_reg_smart + 1;
			 
		end if;		
		
	end loop;
	
	close cur_smart_alta;	

	CLOSE cur_smart;	

	RETURN 'Proc. Ok. QtRegProcessados do BMHOnline: '||rows_affected||' QtRegProcessados de Alta: :'||rows_affected;

EXCEPTION WHEN OTHERS THEN 
	RAISE;
END;
$BODY$;

ALTER FUNCTION integracao.prc_processa_bmh_online()
    OWNER TO postgres;
