-- create database gestionPlat;
-- use gestionPlat;

create table categorie(
	idCategorie int primary key not null auto_increment,
	libelle varchar(20)
);

create table plat(
	idPlat int primary key not null auto_increment,
	code varchar(4),
	intitule varchar(20),
	prix double,
	idCategorie int,
	foreign key (idCategorie) references categorie(idCategorie)
);
alter table plat add (image varchar(50));
alter table plat add (description varchar(50));

create table menu(
	idMenu int primary key not null auto_increment,
	dateMenu date
);

create table menuClient(
	idPlat int,
	idMenu int,
	foreign key (idPlat) references plat(idPlat),
	foreign key (idMenu) references menu(idMenu)
);

create table etudiant(
	idEtudiant int primary key not null auto_increment,
	numETU varchar(6),
	pwd varchar(40),
	nom varchar(20),
	dateNaissance date
);

create table commande(
	idCommande int primary key not null auto_increment,
	idEtudiant int,
	dateCommande date,
	foreign key (idEtudiant) references etudiant(idEtudiant)
);

create table commandePlat(
	idCommande int,
	idPlat int,
	quantite int,
	foreign key (idCommande) references commande(idCommande),
	foreign key (idPlat) references plat(idPlat)	
);

create table token(
	idToken int primary key not null auto_increment,
	idEtudiant int,
	token varchar(40),
	foreign key (idEtudiant) references etudiant(idEtudiant)
);

create table favoris(
	idFavoris int primary key not null auto_increment,
	idEtudiant int,
	idPlat int,
	foreign key (idEtudiant) references etudiant(idEtudiant),
	foreign key (idPlat) references plat(idPlat)
);

-------------X-------------
			--DATA
			
insert into categorie(libelle) values
				("Entree"),
				("Soupe");
				
insert into plat(code, intitule, prix, idCategorie, image, description) values	
				("CE35", "Gratin", 5000, 1, null, "Un gratin est une préparation cuite au four"),
				("CE36", "Salade verte", 2000, 1, null, "Il faut l'accompagner d'une bonne sauce"),
				("CS47", "Soupe chinoise", 3000, 2, null, "La recette de la soupe chinoise est simple"),
				("CS48", "Soupe garnie", 3900, 2, null, "La recette de la soupe garnie est simple");
				
insert into menu(dateMenu) values
				("2021-1-6"),	
				("2021-1-7");	
				
insert into menuClient(idPlat, idMenu) values	
				(1, 1),
				(2, 1),
				(4, 1),
				(1, 2),
				(3, 2),
				(2, 2),
				(4, 2);
				
insert into etudiant(numETU, pwd, nom, dateNaissance) values
				('ETU001', sha1('123465'), 'Rakoto', '1999-10-10'),
				('ETU002', sha1('123465'), 'Rabe', '2000-1-13');
				
insert into commande(idEtudiant) values
				(1, "2021-1-6");
				
insert into commandePlat(idCommande, idPlat, quantite) values
				(1, 2, 2);
				
												
--------------X-----------------
			--FUNCTIONS

delimiter $$
create function getMenuJour(daty date) returns int
reads sql data
begin 
	declare rep int;
	select idMenu into rep 
	from menu 
	where idMenu in (select max(idMenu) as idMenu from menu where dateMenu<=daty);
	return rep;
end $$

delimiter ;
	

--------------X-----------------
			--VIEWS	
	create table commandeDetailsMontant as select commandePlat.idCommande, sum(plat.prix*commandePlat.quantite) as montant
		from commandePlat
		join plat 
		on commandePlat.idPlat = plat.idPlat
		group by commandePlat.idCommande;
	
	create table etudiantMontant as select etudiant.idEtudiant, sum(commandeDetailsMontant.montant) as montant
		from etudiant
		left join commande
		on etudiant.idEtudiant = commande.idEtudiant
		join commandeDetailsMontant
		on commande.idCommande = commandeDetailsMontant.idCommande
		group by etudiant.idEtudiant;
		
	create table nbrPlatAPreparer as select commandePlat.idPlat, sum(commandePlat.quantite) as quantite, commande.dateCommande
		from commandePlat
		join commande	
		on commandePlat.idCommande = commande.idCommande
		group by commandePlat.idPlat, commande.dateCommande;
			
			