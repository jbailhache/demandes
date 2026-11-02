
CREATE TABLE role (
    id SERIAL PRIMARY KEY,
    code TEXT,
    libelle TEXT
);

INSERT INTO role (code, libelle) VALUES ('U', 'utilisateur');
INSERT INTO role (code, libelle) VALUES ('A', 'administrateur');

CREATE TABLE statut (
    id SERIAL PRIMARY KEY,
    code TEXT,
    libelle TEXT
);

INSERT INTO statut (code, libelle) VALUES ('NV', 'nouvelle');
INSERT INTO statut (code, libelle) VALUES ('AF', 'affectée');
INSERT INTO statut (code, libelle) VALUES ('EC', 'en cours');
INSERT INTO statut (code, libelle) VALUES ('EA', 'en attente');
INSERT INTO statut (code, libelle) VALUES ('RS', 'résolue');
INSERT INTO statut (code, libelle) VALUES ('FR', 'fermée');

CREATE TABLE priorite (
    id SERIAL PRIMARY KEY,
    code TEXT,
    libelle TEXT
);

INSERT INTO priorite (code, libelle) VALUES ('B', 'basse');
INSERT INTO priorite (code, libelle) VALUES ('N', 'normale');
INSERT INTO priorite (code, libelle) VALUES ('H', 'haute');
INSERT INTO priorite (code, libelle) VALUES ('U', 'urgente');

CREATE TABLE utilisateur (
    id SERIAL PRIMARY KEY,
    nom TEXT,
    email TEXT,
    mdp TEXT,
    role INTEGER, CONSTRAINT fk_role FOREIGN KEY (role) REFERENCES role(id)
);

INSERT INTO utilisateur (nom, mdp, role) VALUES ('admin', MD5('master'), (SELECT id FROM role WHERE code = 'A'));

CREATE TABLE demande (
    id SERIAL PRIMARY KEY,
    titre TEXT,
    description TEXT,
    demandeur INTEGER, CONSTRAINT fk_demandeur FOREIGN KEY (demandeur) REFERENCES utilisateur(id),
    date_creation DATE,
    date_modification DATE,
    date_cloture DATE,
    statut INTEGER, CONSTRAINT fk_statut FOREIGN KEY (statut) REFERENCES statut(id),
    priorite INTEGER, CONSTRAINT fk_priorite FOREIGN KEY (priorite) REFERENCES priorite(id),
    affecte_a INTEGER, CONSTRAINT fk_affecte_a FOREIGN KEY (affecte_a) REFERENCES utilisateur(id)
);

CREATE TABLE commentaire (
    id SERIAL PRIMARY KEY,
    demande INTEGER, CONSTRAINT fk_demande FOREIGN KEY (demande) REFERENCES demande(id),
    utilisateur INTEGER, CONSTRAINT fk_utilisateur FOREIGN KEY (utilisateur) REFERENCES utilisateur(id),
    dat DATE,
    texte TEXT
);

CREATE TABLE action (
    id SERIAL PRIMARY KEY,
    libelle TEXT
);

CREATE TABLE historique (
    id SERIAL PRIMARY KEY,
    dat DATE,
    utilisateur INTEGER, CONSTRAINT fk_utilisateur FOREIGN KEY (utilisateur) REFERENCES utilisateur(id),
    action INTEGER, CONSTRAINT fk_action FOREIGN KEY (action) REFERENCES action(id),
    demande INTEGER, CONSTRAINT fk_demande FOREIGN KEY (demande) REFERENCES demande(id),
    descrition TEXT
);

    
    
