#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users(
        id_user   Int  Auto_increment  NOT NULL ,
        nom       Varchar (255) NOT NULL ,
        Prenom    Varchar (255) NOT NULL ,
        mail      Varchar (255) NOT NULL ,
        mdp       Varchar (255) NOT NULL ,
        telephone Int NOT NULL ,
        adresse   Varchar (255) NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: stations
#------------------------------------------------------------

CREATE TABLE stations(
        numero_serie_station Varchar (50) NOT NULL ,
        date_achat           Int NOT NULL ,
        modele               Varchar (255) NOT NULL ,
        id_user              Int NOT NULL
	,CONSTRAINT stations_PK PRIMARY KEY (numero_serie_station)

	,CONSTRAINT stations_users_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: capteurs
#------------------------------------------------------------

CREATE TABLE capteurs(
        numero_serie_capteur Varchar (255) NOT NULL ,
        emplacement          Varchar (111) NOT NULL ,
        numero_serie_station Varchar (50) NOT NULL
	,CONSTRAINT capteurs_PK PRIMARY KEY (numero_serie_capteur)

	,CONSTRAINT capteurs_stations_FK FOREIGN KEY (numero_serie_station) REFERENCES stations(numero_serie_station)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: relevés
#------------------------------------------------------------

CREATE TABLE releves(
        id_releve            Int  Auto_increment  NOT NULL ,
        temperature          Int NOT NULL ,
        humidite             Int NOT NULL ,
        date                 Int NOT NULL ,
        numero_serie_capteur Varchar (255) NOT NULL
	,CONSTRAINT releves_PK PRIMARY KEY (id_releve)

	,CONSTRAINT releves_capteurs_FK FOREIGN KEY (numero_serie_capteur) REFERENCES capteurs(numero_serie_capteur)
)ENGINE=InnoDB;

