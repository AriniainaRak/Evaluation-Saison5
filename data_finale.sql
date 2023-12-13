-- Active: 1702220183666@@127.0.0.1@5432@eval5
create table type_datas(
    id  serial primary key not null,
    code varchar(50),
    nom varchar(55)
);

create table table_datas(
    id serial primary key not null,
    idtype int,
    valeur decimal(20,3),
    foreign key (idtype) references type_datas(id)
);

create table consommations(
    id serial primary key not null,
    nb_pers int,
    puissance_moy int,
    consommation_fix int,
    taux_pers_h_creuse int
);





_table_data:
id => 1
type(type_data) => 1
valeur => 6000

_consommation:
nb_pers
puissance_moy(75 W)
consommation_fix
taux_pers_h_creuse(%)
