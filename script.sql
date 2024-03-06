-- Active: 1707389167936@@127.0.0.1@5432@eval6

-- Table
create table admins(
    id serial primary key not null,
    username varchar(50),
    pwd varchar(50)
);
insert into admins (username, pwd) values ('admin', '1234');

create table techniques(
    id serial primary key not null,
    username varchar(50),
    pwd varchar(50)
);
insert into techniques (username, pwd) values ('Arinirina', 'arinirina');


create table postes(
    id serial primary key not null,
    intitule varchar(50)
);
create table caracteristiques(
    id serial primary key not null,
    intitule varchar(50),
    code varchar(55)
);
create table joueurs(
    id serial primary key not null,
    nom varchar(50),
    prenom varchar(55),
    taille int,
    idnationalite int references nationalites(id),
    idclub int references clubs(id),
    photo varchar(255)
);

create table poste_joueur(
    id serial primary key not null,
    idjoueur int references joueurs(id),
    idposte int references postes(id),
    valeur int  --0 tsisy de 1 misy
);

create table note_joueurs(
    id serial primary key not null,
    idjoueur int references joueurs(id),
    idcaracteristique int references caracteristiques(id),
    valeur int
);

create table nationalites (
    id serial primary key not null,
    intitule varchar(55),
    code varchar(55)
);

create table clubs (
    id serial primary key not null,
    intitule varchar(55),
    code varchar(55)
);

create table formations(
    id serial primary key not null,
    nom varchar(55),
    attaquant int,
    milieu int,
    defense int
);

create table coefficients(
    id serial primary key not null,
    idcaracteristique int references caracteristiques(id),
    idposte int references postes(id),
    valeur int
);



create table
