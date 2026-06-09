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
insert into formations (nom, attaquant, milieu, defense) values ('formation1','5', '4', '1');
insert into formations (nom, attaquant, milieu, defense) values ('formation2','4', '3', '3');
insert into formations (nom, attaquant, milieu, defense) values ('formation3','4', '4', '2');


create table coefficients(
    id serial primary key not null,
    idcaracteristique int references caracteristiques(id),
    idposte int references postes(id),
    valeur int
);

CREATE TABLE equipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_formation int references formation(id),
    id_joueur int references joueurs(id),
    id_poste int references postes(id)
);


-- requette
SELECT pj.idjoueur,
       p.intitule,
       SUM(CASE
               WHEN pj.idjoueur IS NULL THEN nj.valeur - nj.valeur * 0.3
               ELSE (nj.valeur * c.valeur) / SUM(c.valeur)
           END) AS note_joueur
FROM poste_joueur pj
JOIN note_joueurs nj ON pj.idjoueur = nj.idjoueur
JOIN coefficients c ON nj.idcaracteristique = c.idcaracteristique AND pj.idposte = c.idposte
JOIN postes p ON p.id = pj.idposte
JOIN joueurs j ON j.id = pj.idjoueur
GROUP BY pj.idjoueur, p.intitule;


WITH poste_coefficients AS (
    SELECT
        pj.idjoueur,
        p.intitule AS poste,
        c.valeur AS coefficient,

    FROM poste_joueur pj
    JOIN postes p ON pj.idposte = p.id
    JOIN coefficients c ON pj.idposte = c.idposte
),
note_joueur AS (
    SELECT
        nj.idjoueur,
        SUM(nj.valeur * pc.coefficient) / SUM(pc.coefficient) AS note
    FROM note_joueurs nj
    JOIN poste_coefficients pc ON nj.idjoueur = pc.idjoueur
        AND nj.idcaracteristique = pc.idcaracteristique
    GROUP BY nj.idjoueur
)
SELECT
    pc.poste,
    COALESCE(nj.note, nj.note * 0.3) AS note
FROM poste_coefficients pc
LEFT JOIN note_joueur nj ON pc.idjoueur = nj.idjoueur;


