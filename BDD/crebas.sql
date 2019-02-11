/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  08/02/2019 14:13:26                      */
/*==============================================================*/


drop table if exists T_QTE_INGREDIENT;

drop table if exists T_CATEGORIE;

drop table if exists T_ETAPES;

drop table if exists T_INGREDIENT;

drop table if exists T_RECETTE;

drop table if exists T_UNITE;

drop table if exists T_USER;

/*==============================================================*/
/* Table : T_QTE_INGREDIENT                                              */
/*==============================================================*/
create table T_QTE_INGREDIENT
(
   ID_RECETTE           int not null,
   ID_INGREDIENT        int not null,
   QTE                  bigint,
   primary key (ID_RECETTE, ID_INGREDIENT)
);

/*==============================================================*/
/* Table : T_CATEGORIE                                          */
/*==============================================================*/
create table T_CATEGORIE
(
   ID_CATEGORIE         int not null auto_increment,
   CATEGONOM            varchar(40),
   primary key (ID_CATEGORIE)
);

/*==============================================================*/
/* Table : T_ETAPES                                             */
/*==============================================================*/
create table T_ETAPES
(
   ID_ETAPE             int not null auto_increment,
   NUM                  smallint,
   CONSIGNE             text,
   primary key (ID_ETAPE)
);

/*==============================================================*/
/* Table : T_INGREDIENT                                         */
/*==============================================================*/
create table T_INGREDIENT
(
   ID_INGREDIENT        int not null auto_increment,
   ID_UNITE             int not null,
   ID_CATEGORIE         int not null,
   INGRENOM             longtext,
   primary key (ID_INGREDIENT)
);

/*==============================================================*/
/* Table : T_RECETTE                                            */
/*==============================================================*/
create table T_RECETTE
(
   ID_RECETTE           int not null auto_increment,
   ID_USER              int not null,
   ID_ETAPE             int not null,
   IMAGE                varchar(255),
   TITRE                longtext,
   RESUME               longtext,
   DIFFICULTE           smallint,
   TEMPS                smallint,
   CUISSON              smallint,
   DATE                 datetime,
   primary key (ID_RECETTE)
);

/*==============================================================*/
/* Table : T_UNITE                                              */
/*==============================================================*/
create table T_UNITE
(
   ID_UNITE             int not null auto_increment,
   UNITENOM             varchar(40),
   UNIPREFIXE           varchar(40),
   primary key (ID_UNITE)
);

/*==============================================================*/
/* Table : T_USER                                               */
/*==============================================================*/
create table T_USER
(
   ID_USER              int not null auto_increment,
   NOM                  varchar(40),
   PRENOM               varchar(40),
   LOGIN                varchar(40),
   MDP                  varchar(255),
   DROITS               smallint,
   MAIL                 varchar(255),
   primary key (ID_USER)
);

alter table T_QTE_INGREDIENT add constraint FK_T_QTE_INGREDIENT foreign key (ID_RECETTE)
      references T_RECETTE (ID_RECETTE) on delete restrict on update restrict;

alter table T_QTE_INGREDIENT add constraint FK_T_QTE_INGREDIENT2 foreign key (ID_INGREDIENT)
      references T_INGREDIENT (ID_INGREDIENT) on delete restrict on update restrict;

alter table T_INGREDIENT add constraint FK_APPARTIENT foreign key (ID_CATEGORIE)
      references T_CATEGORIE (ID_CATEGORIE) on delete restrict on update restrict;

alter table T_INGREDIENT add constraint FK_QUANTIFIE foreign key (ID_UNITE)
      references T_UNITE (ID_UNITE) on delete restrict on update restrict;

alter table T_RECETTE add constraint FK_DEFINIT foreign key (ID_ETAPE)
      references T_ETAPES (ID_ETAPE) on delete restrict on update restrict;

alter table T_RECETTE add constraint FK_POSSEDE foreign key (ID_USER)
      references T_USER (ID_USER) on delete restrict on update restrict;

