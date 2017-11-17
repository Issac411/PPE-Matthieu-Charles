/* La table des utilisateurs, elle contient les clients, mais aussi les potentiels admins */
CREATE TABLE utilisateurs (
	id int AUTO_INCREMENT,
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
	validation boolean			NOT NULL,
	CONSTRAINT pk_id PRIMARY KEY (id)
	);

/* Categorie contient le nom des categories de produits (ex : coussin, oreiller) */
CREATE TABLE categories (
	id int AUTO_INCREMENT,
	libelle varchar(100) 		NOT NULL,
	CONSTRAINT pk_id PRIMARY KEY (id)
	);
/* paiement contient les moyens de paiements comme la carte bancaire ou le chèque */
/*CREATE TABLE paiements (
	id int AUTO_INCREMENT,
	libelle varchar(100)  		NOT NULL,
	CONSTRAINT pk_id PRIMARY KEY (id)
	);*/

/* La TVA varie selon les articles, il y a donc plusieurs variables, d'ou cette table. */
CREATE TABLE tva (
	id int AUTO_INCREMENT,
	libelle varchar(100)  		NOT NULL,
	taux float,
	CONSTRAINT pk_id PRIMARY KEY (id)
	);
/* Liste des articles avec une sauvegarde de leur prix via des valeurs calculées, utiles à l'historique des commandes, contient un facteur de reduction */
CREATE TABLE articles (
	id int AUTO_INCREMENT,
	id_tva int, /* vers tva */
	id_categorie int, /* vers categorie */
	description varchar(500),
	libelle varchar(100),
	taux_tva float,
	prix_unitaire_ht float,
	prix_ttc float AS (prix_unitaire_ht+(prix_unitaire_ht*(taux_tva/100))-reduction),
	disponible boolean,
	reduction float,
	image varchar(500),
	CONSTRAINT pk_id PRIMARY KEY (id)
	);

/* les commandes contiennent l'état d'une commande, pas son contenu */
CREATE TABLE commandes (
	id int AUTO_INCREMENT,
	id_client int,
	id_paiement int,
	id_tva int,
	montant_ht float,
	frais_livraison float,
	taux_tva float,
	montant_ttc float AS (montant_ht+(montant_ht*(taux_tva/100))+frais_livraison),
	date_l date 			NOT NULL,
	livree boolean,
	payee boolean,
	CONSTRAINT pk_id PRIMARY KEY (id)
	);

/* Commandes lignes regroupe les articles en vente d'une commande, avec leur quantité, cout, libelle... */
CREATE TABLE commandes_lignes (
	id int AUTO_INCREMENT,
	id_commande int,
	id_produit int,
	id_tva int,
	libelle_article varchar(100) ,
	quantite int,
	prix_unitaire_ht float,
	taux_tva float,
	montant_ht float AS (prix_unitaire_ht*quantite),
	montant_ttc float AS (prix_unitaire_ht*quantite+(quantite*(prix_unitaire_ht*(taux_tva/100)))),
	type boolean NOT NULL,
	CONSTRAINT pk_id PRIMARY KEY (id)
	);



/* Ajout d'un utilisateur administrateur de test, les utilisateurs non validées ont le booléen "validation" à 0 :*/
insert into utilisateurs (nom,prenom,adresse_mail,mdp,adresse1,adresse2,code_postal,ville,num_tel,num_mobile,date_naissance,type,validation) VALUES
("SANTIAGO","Alberto","Santosreal@live.fr","098f6bcd4621d373cade4e832627b4f6","10 rue ferret","porte 7",65240,"Champigny",0645259472,0954872951,'1987/05/02',1,0)

insert into utilisateurs (nom,prenom,adresse_mail,mdp,adresse1,adresse2,code_postal,ville,num_tel,num_mobile,date_naissance,type,validation) VALUES
("LASALLE","Jean","Marsault@live.fr","21232f297a57a5a743894a0e4a801fc3","7 rue beurk","3 ème porte",17140,"méville",0758642354,0655884325,'1989/09/07',0,1)

/* Ajout d'une utilisateur client, le type = utilisateur admin : */
insert into utilisateurs (nom,prenom,adresse_mail,mdp,adresse1,adresse2,code_postal,ville,num_tel,num_mobile,date_naissance,type,validation) VALUES
("LASALLE","Jean","DuBonheur@outlook.com","21232f297a57a5a743894a0e4a801fc3","7 rue du champignon lumineux","impasse",23140,"Savoie la hausse",0585662144,0152339542,'1972/09/02',1,1)

/* Ajout d'une catégorie, exemple de requête conforme*/
insert into categorie (libelle) values ("coussin")

/* Ajout d'un moyen de paiement :*/
/*insert into paiements (libelle) VALUES ("virement")

/* Ajout d'une TVA personnalisée : */
insert into tva (libelle,taux) VALUES ("taxe réduite",5.5)

/* Ajout d'article, exemple de requête conforme : */
insert into articles (id_tva, id_categorie, libelle,description, taux_tva, prix_unitaire_ht, disponible)
VALUES (1,1,"oreiller richonson Princier","Oreiller de haute marque",8,1,1);

/* Exemple d'une commande, avec un total_ht qui devra être calculer en php*/
insert into commandes (id_client,id_paiement,id_tva,montant_ht,taux_tva,frais_livraison,livree,payee,date_l) VALUES (2,1,1,30, 5.5,15,0,0,"2017/06/08")

/* Dévoiler tous les articles de la commande N1 */
select * from commandes_lignes where (id_commande=1)

/* Calcul du montant de la commande 1 en ttc :*/
select SUM(montant_ttc) from commandes_lignes where (id_commande=1)
