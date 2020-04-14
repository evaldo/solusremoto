CREATE EXTENSION dblink;

SELECT pg_namespace.nspname, pg_proc.proname 
    FROM pg_proc, pg_namespace 
    WHERE pg_proc.pronamespace=pg_namespace.oid 
       AND pg_proc.proname LIKE '%dblink%';

SELECT dblink_connect('host=192.168.0.250 port=5430 user=postgres password=!V3rd3V1l4# dbname=vilaverde_dw');

CREATE FOREIGN DATA WRAPPER db_link_vilaverde_dw VALIDATOR postgresql_fdw_validator;
CREATE SERVER vilaverde_dw FOREIGN DATA WRAPPER db_link_vilaverde_dw OPTIONS (host '192.168.0.250', port '5430', dbname 'vilaverde_dw');
CREATE USER MAPPING FOR postgres SERVER vilaverde_dw OPTIONS (user 'postgres', password '!V3rd3V1l4#');
CREATE USER MAPPING FOR evaldo SERVER vilaverde_dw OPTIONS (user 'postgres', password '!V3rd3V1l4#');

SELECT dblink_connect('vilaverde_dw');

GRANT USAGE ON FOREIGN SERVER vilaverde_dw TO postgres;
GRANT USAGE ON FOREIGN SERVER vilaverde_dw TO evaldo;