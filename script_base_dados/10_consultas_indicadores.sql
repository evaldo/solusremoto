select  to_char(dt_admss, 'mm/yyyy') as admissao, count(1) as quantidade
from integracao.tb_bmh_online
where to_char(dt_admss, 'mm/yyyy')>='06/2020'
group by  to_char(dt_admss, 'mm/yyyy')
order by 1

select  to_char(dt_alta, 'mm/yyyy') as alta, count(1) as quantidade
from integracao.tb_bmh_online
where to_char(dt_alta, 'mm/yyyy')>='06/2020'
group by  to_char(dt_alta, 'mm/yyyy')
order by 1

select  ds_cidade, to_char(dt_admss, 'mm/yyyy') as dt_admss, count(1) as quantidade
from integracao.tb_bmh_online
where to_char(dt_admss, 'mm/yyyy')>='06/2020'
group by  ds_cidade, to_char(dt_admss, 'mm/yyyy')
order by 2

select  nm_cnvo, to_char(dt_admss, 'mm/yyyy') as dt_admss, count(1) as quantidade
from integracao.tb_bmh_online
where to_char(dt_admss, 'mm/yyyy')>='06/2020'
group by  nm_cnvo, to_char(dt_admss, 'mm/yyyy')
order by 2