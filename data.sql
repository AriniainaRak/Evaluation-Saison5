create table source_energie(
    id serial primay key not null,
    nom varchar(),
    capacite decimal(20,3) default 0,
    code VARCHAR()
);

create table tranche_heure(
    id serial primary key not null,
    heure_deb integer,
    feure_fin integer
);

create table puissance_pan(
    id serial primary key not null,
    idtranche integer,
    puissance DECIMAL(20,3)
);

create table energie_pan(
    id serial primary key not null,
    idsource integer,
    consommation integer,
    reservoir decimal(20,3)
    prix_h decimal(20,3)
);

