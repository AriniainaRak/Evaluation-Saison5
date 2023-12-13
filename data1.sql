-- Active: 1702220183666@@127.0.0.1@5432@eval5

CREATE TABLE panneaus (
    id_panneau SERIAL PRIMARY KEY,
    puissancemaximale INT,
    tarifparheure DECIMAL
);

CREATE TABLE groupes (
    id_groupe SERIAL PRIMARY KEY,
    capacitemaximale INT,
    capacitereservoirfixe DECIMAL,
    consommationparheurefixe INT,
    prixparheure DECIMAL,
    -- heuredefonctionnement int
);

CREATE TABLE jiramas (
    id_jirama SERIAL PRIMARY KEY,
    capacitemaximale INT,
    tarifenwattheure DECIMAL
);

CREATE TABLE configurationinitiales (
    id_configuration SERIAL PRIMARY KEY,
    tauxpuissance_8h_11h DECIMAL,
    tauxpuissance_11h_14h DECIMAL,
    tauxpuissance_14h_17h DECIMAL
);

CREATE TABLE consommations (
    id_consommation SERIAL PRIMARY KEY,
    date DATE,
    nombreetudiantstotal INT,
    puissancemoyennelaptop INT,
    consommationfixe INT,
    pourcentageetudiants_12h_14h DECIMAL
);

CREATE TABLE productions (
    id_production SERIAL PRIMARY KEY,
    id_configuration INT REFERENCES configurationinitiales(id_configuration),
    id_panneau INT REFERENCES panneaus(id_panneau),
    id_groupe INT REFERENCES groupes(id_groupe),
    id_jirama INT REFERENCES jiramas(id_jirama),
    date DATE,
    puissancetotale DECIMAL
);

create or replace VIEW production_panneau as SELECT
    p.id_panneau,
    p.puissancemaximale,
    c.tauxpuissance_8h_11h,
    (p.puissancemaximale*tauxpuissance_8h_11h)/100 as production_pan
    from
    panneaus p
    JOIN
    configurationinitials c on 1=1;

create or replace view production_panneau_1h as select
    p.id_panneau,
    pp.production_pan,
    p.production_pan/4 as production_1h
    FROM
    panneau p
    JOIN
    production_panneau pp on p.id_panneau= pp.id_panneau;

create or replace view production_groupe as SELECT
    g.id_groupe,
    g.capacitemaximale,
    g.capacitereservoirfixe,
    g.consommationparheurefixe,
    (g.capacitemaximale*g.consommationparheurefixe)/g.capacitereservoirfixe as production_consommation
    FROM
    groupes g;

create or replace view production_groupe_1h as SELECT
    g.id_groupe,
    g.capacitemaximale,
    gg.
