CREATE TABLE Production (
  date DATE NOT NULL,
  heure INT NOT NULL,
  panneau_solaire DECIMAL(5,2) NOT NULL,
  groupe_electrogene INT NOT NULL,
  jirama INT NOT NULL,
  PRIMARY KEY (date, heure)
);

CREATE TABLE Consommation (
  date DATE NOT NULL,
  heure INT NOT NULL,
  fixe INT NOT NULL,
  variable DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (date, heure)
);

CREATE TABLE Etudiants (
  date DATE NOT NULL,
  heure INT NOT NULL,
  nombre_etudiants INT NOT NULL,
  puissance_moyenne_ordinateur INT NOT NULL,
  pourcentage_etudiants_salles_de_classe DECIMAL(3,2) NOT NULL,
  PRIMARY KEY (date, heure)
);
