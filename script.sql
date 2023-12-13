-- Active: 1702220183666@@127.0.0.1@5432@eval5

-- Table
create table admins(
    idadmins serial primary key not null,
    username varchar(50),
    pwd varchar(50)
);

-- create table utilisateur(
--     idutilisateur serial primary key not null,
--     username varchar(50),
--     pwd varchar(50)
-- );


CREATE TABLE tranche_heures(
    id SERIAL PRIMARY KEY,
    heure_debut TIME NULL,
    heure_fin TIME NULL,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp DEFAULT current_timestamp
);

CREATE TABLE sunpowers(
    id SERIAL PRIMARY KEY,
    tranche_heure_id INT REFERENCES tranche_heures(id) NULL,
    intensite DECIMAL(10, 3) DEFAULT 0,
    date DATE,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp DEFAULT current_timestamp
);
-- intensite=pourcentage puissance a utiliser

CREATE TABLE type_sources(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NULL,
    -- code VARCHAR(255) NULL,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp DEFAULT current_timestamp
);

CREATE TABLE source_energies(
    id SERIAL PRIMARY KEY,
    type_source_id INT REFERENCES type_sources(id) NULL,
    puissance_max DECIMAL(20, 3) DEFAULT 0,
    consommation DECIMAL(20, 3) DEFAULT 0,
    reservoir DECIMAL(20, 3) DEFAULT 0,
    tarif_h DECIMAL(20, 5) DEFAULT 0,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp DEFAULT current_timestamp
);

CREATE TABLE appareils(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NULL,
    consommation DECIMAL(20, 3) DEFAULT 0,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp DEFAULT current_timestamp
);

CREATE TABLE consommations(
    id SERIAL PRIMARY KEY,
    conso_fixe DECIMAL(20,3) DEFAULT 0,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp DEFAULT current_timestamp
);



CREATE TABLE pointages(
    id SERIAL PRIMARY KEY,
    effectif INT DEFAULT 0,
    heure TIME,
    date DATE,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp DEFAULT current_timestamp
);
