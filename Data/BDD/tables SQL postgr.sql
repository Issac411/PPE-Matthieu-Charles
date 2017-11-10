

/* Les commentaires et exemples sont présents dans le fichier 'tables SQL mysql'
	L'interêt d'avoir deux fichiers séparés et de ne pas avoir certaines incompatibilitées, telles-que :
		- auto increment qui n'a pas le même nom
		- déclaration différente des contraintes
		- Postgr qui est à mon sens moins stable et bien exigant en terme de syntaxe

		Aucun test n'a été effectué
		*/


CREATE TABLE utilisateurs (
	id SERIAL PRIMARY KEY,
	nom varchar(50) 			NOT NULL,
	prenom varchar(50)  		NOT NULL,
	adresse_mail varchar(100)  	NOT NULL,
	mdp varchar(500)			NOT NULL,
	adresse1 varchar(150) 		NOT NULL,
	adresse2 varchar(150),
	code_postal int  		 	NOT NULL,
	ville varchar(50)  			NOT NULL,
	num_tel int  				NOT NULL,
	num_mobile int,
	date_naissance date 		NOT NULL,
	type boolean 				NOT NULL,
	validation boolean			NOT NULL
	);

CREATE TABLE categories (
	id SERIAL PRIMARY KEY,
	image varchar(500),
	libelle varchar(100) 		NOT NULL
	);

/*CREATE TABLE paiements (
	id int SERIAL PRIMARY KEY,
	libelle varchar(100)  		NOT NULL
	);*/

CREATE TABLE tva (
	id SERIAL PRIMAY KEY,
	libelle varchar(100)  		NOT NULL,
	taux float
	);

CREATE TABLE articles (
	id SERIAL PRIMARY KEY,
	id_tva int, /* vers tva */
	id_categorie int, /* vers categorie */
	description varchar(500),
	libelle varchar(100),
	taux_tva float,
	prix_unitaire_ht float,
	prix_ttc float AS (prix_unitaire_ht+(prix_unitaire_ht*(taux_tva/100))-reduction),
	disponible boolean,
	reduction float
	);


CREATE TABLE commandes (
	id SERIAL PRIMARY KEY,
	id_client int,
	id_paiement int,
	id_tva int,
	montant_ht float,
	frais_livraison float,
	taux_tva float,
	montant_ttc float AS (montant_ht+(montant_ht*(taux_tva/100))+frais_livraison),
	date_l date 			NOT NULL,
	livree boolean,
	payee boolean
	);

CREATE TABLE commandes_lignes (
	id SERIAL PRIMARY KEY,
	id_commande int,
	id_produit int,
	id_tva int,
	libelle_article varchar(100) ,
	quantite int,
	prix_unitaire_ht float,
	taux_tva float,
	montant_ht float AS (prix_unitaire_ht*quantite),
	montant_ttc float AS (prix_unitaire_ht*quantite+(quantite*(prix_unitaire_ht*(taux_tva/100)))),
	type boolean NOT NULL
	);
