/*
------------------------------------------------------------------------------------------------------------------------
In your phpMyAdmin directory, there will be a file called "config.inc.php".
Find the line where it sets the MaxRows value:
$cfg['MaxRows'] = 1000;
And change the value to whatever you want.
------------------------------------------------------------------------------------------------------------------------
DROP DATABASE cmo;
CREATE DATABASE cmo CHARACTER SET utf8 COLLATE utf8_general_ci;
USE cmo;
------------------------------------------------------------------------------------------------------------------------
*/

/*Таблица персонажей*/
CREATE TABLE `user` (
   ID                            bigint(20) unsigned NOT NULL auto_increment,
   NickName                      CHAR(32) UNIQUE,                                         /*ник игрока (уникальный, при регистрации)*/
   Gender						             CHAR(1),
   Pass                          CHAR(32),                                                /*пароль игрока (задается при регистрации)*/
   SessionID                     bigint,                                                  /*Идентификатор сессии*/
   Email                         CHAR(64) UNIQUE,                                         /*почтовый ящик игрока*/
   Birthday                      DATE NOT NULL,                                           /*дата рождения игрока*/
   CharacterBirthDay             DATE NOT NULL,                                           /*дата создания персонажа*/
   Online 						           int(5) NOT NULL DEFAULT '0',							              /*0-offline 1-online*/
   IP							               VARCHAR(15),
   Location                      VARCHAR(15),                                             /*текущее положение перса в городе (здание, площадь)*/
   Slots				                 int(11) NOT NULL DEFAULT '0',							              /*1-6 monstrov*/
   Rang                          int(11) NOT NULL DEFAULT '0',
   Gruppe					               char(32) NOT NULL DEFAULT 'Seeker Of Adventures',
   Collection				             int(11) NOT NULL DEFAULT '1',							               /*количкство собраних монстров*/
   About                         CHAR(255),
   Avatar						             CHAR(30) DEFAULT 'avatar.png',                           /*изображения перса*/
   Clan                          VARCHAR(15) NOT NULL DEFAULT 'none',
   InBattle                      int(11) NOT NULL DEFAULT '0',                            /* В бою пользователь или нет */
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO user (NickName, Gender, Pass, Birthday, Location, Rang, Gruppe)
            VALUES('admin','m','202cb962ac59075b964b07152d234b70','2008-03-11', 'Kyoto City', 10, 'Admin'); 	/*pass: 123*/
INSERT INTO user (NickName, Gender, Pass, Birthday, Rang, Gruppe)
			VALUES('Defender','f','202cb962ac59075b964b07152d234b70','2008-03-11', 100, 'Legend');
INSERT INTO user (NickName, Gender, Pass, Birthday, Rang, Gruppe)
            VALUES('Yehress','m','202cb962ac59075b964b07152d234b70','2008-03-11', 50, 'Seeker Of Adventures');
INSERT INTO user (NickName, Gender, Pass, Birthday, Rang, Gruppe)
            VALUES('Stranger','m','202cb962ac59075b964b07152d234b70','2008-03-11', 50, 'Seeker Of Adventures');
INSERT INTO user (NickName, Gender, Pass, Birthday, Rang, Gruppe)
            VALUES('Ninja99','f','202cb962ac59075b964b07152d234b70','2008-03-11', 50, 'Seeker Of Adventures');
/*NPC*/
INSERT INTO user (NickName, Gender, Pass, Birthday, Rang, Gruppe)
            VALUES('Gogi','m','/storage_','1990-09-29', 0, 'NPC');
INSERT INTO user (NickName, Gender, Pass, Birthday, Rang, Gruppe)
			VALUES('Reiner Forcement','m','/reinforcement','2011-08-11', 0, 'NPC');

CREATE TABLE `online` (
	ID int(10) NOT NULL auto_increment,
	NickName CHAR(32) UNIQUE,
  IP varchar(20) NOT NULL default '0',
	`Timestamp` varchar(60) NOT NULL default '',
	PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Таблица кланов*/
CREATE TABLE `clan` (
   ID                            int(20) unsigned NOT NULL auto_increment,
   Nomer                         int(11) NOT NULL, 					/*позиция в рейтинге*/
   Logo						               CHAR(30) DEFAULT 'default.png',
   Name                          CHAR(32) UNIQUE,
   Rating						             int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO clan (Nomer, Logo, Name, Rating) VALUES(1,'1.png','Admins Are Great',10);
INSERT INTO clan (Nomer, Logo, Name, Rating) VALUES(2,'2.png','Masters of Justice',0);
INSERT INTO clan (Nomer, Logo, Name, Rating) VALUES(3,'3.png','Kingdom',400);

/* Инвентарь */
CREATE TABLE `item_list` (
	IL_ID INT(4) unsigned NOT NULL AUTO_INCREMENT,  /*идентификатор предмета*/
	ItemName CHAR(50) NOT NULL, 					          /*Название предмета*/
	ItemImage CHAR(30) DEFAULT 'item.png',          /*путь к картинке предмета и ее имя*/
	ItemGoal INT DEFAULT 2, 						            /*0- does nothing,1-enemy,2-for yourself*/
	ItemValue INT DEFAULT 0,                        /*in %*/
	ItemDescription CHAR(255),
	ItemPrice INT DEFAULT 0,
	PRIMARY KEY (`IL_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('Money', '1.png', 0, 0, 'I need more money Sonny ;)', 0);
INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('Master Helm', '2.png', 1, 15, '15% chance to scares your oponent monster for 1 round', 40000);
INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('Apple', '3.png', 2, 100, '1/15 HP points will add your monster every round', 80000);
INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('Claws', '4.png', 2, 25, '25% chance to attack your oponent monster faster, even if your speed stat is lower.', 30000);
INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('Lesnes', '5.png', 2, 30, '30% chance to Atack 50% more damage', 1300000);
INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('White Bell', '6.png', 2, 100, '1/8 HP points will add your monster from your attack damage', 500000);
INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('Berserk Sphere', '7.png', 2, 100, '25% more damage but -10HP of monter life for each attack', 450000);
INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('Magnifying Glass', '8.png', 2, 30, '30% chance to add 10% Accuracy to your attack', 700000);
INSERT INTO item_list (ItemName, ItemImage, ItemGoal, ItemValue, ItemDescription, ItemPrice)
		VALUES('Light Powder', '9.png', 1, 30, '30% chance that enemies attack will not hit you', 900000);
		
/* Таблица предметов*/
CREATE TABLE `item`(
	IT_ID BIGINT(20) unsigned NOT NULL auto_increment,  /* уник. идентификатор предмета */
	IL_ID INT(4) unsigned NOT NULL, 					          /* ID предмета в справочнике предметов */
	ItemOwner CHAR(32) NOT NULL, 			                  /* владелец предмета */
	ItemPosition INT DEFAULT 0, 					              /* позиция предмета 0-inventar 1-в слоте 2-в магазине */
	ItemAmount INT DEFAULT 1 NOT NULL,					        /* koli4estvo не для надеваемых предметов */
	PRIMARY KEY (`IT_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(1, 1, 'admin', 0, 10000000);
INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(2, 2, 'admin', 0, 1);
INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(3, 3, 'admin', 0, 1);
INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(4, 4, 'admin', 0, 1);
INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(5, 5, 'admin', 0, 1);
INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(6, 6, 'admin', 0, 1);
INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(7, 7, 'admin', 0, 1);
INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(8, 8, 'admin', 0, 1);
INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount)
		VALUES(9, 9, 'admin', 0, 1);

/* Монстры */
CREATE TABLE IF NOT EXISTS `monster_list` (
	ML_ID int(11) NOT NULL AUTO_INCREMENT,/*ID*/
	MLImage CHAR(32) DEFAULT '0.jpg',
	`Name` char(32) NOT NULL,						  /*Имя*/
	Type1 int(11) NOT NULL,						    /*Тип*/
	Type2 int(11) NOT NULL,						    /*Тип2*/
	ExpGroup int(11) NOT NULL,					  /*1-5*/
	EvoLvl int(11) NOT NULL,					    /*Эволюция  (number of evolution)*/
	EvoVkogo int(11) NOT NULL,					  /*Номер еволюции*/
	Hp int(11) NOT NULL,							    /*Базовый стат ХП*/
	Atk int(11) NOT NULL,							    /*Баз. стат атаки*/
	Def int(11) NOT NULL,							    /*Баз. стат защиты*/
	Spd int(11) NOT NULL,							    /*Баз. стат скорости*/
	Sp_A int(11) NOT NULL,						    /*Баз. стат сп.атаки*/
	Sp_D int(11) NOT NULL,						    /*Баз. стат сп.защиты*/
	PRIMARY KEY (`ML_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*
1-Трава,2-Огонь,3-Вода,4-Яд,5-Лёд,6-Призрак,7-Тьма,8-Леающий,9-Нормальный,10-Дракон,11-Камень,12-Земля,13-Жук,14-Электричество,15-Психический,16-Сталь,17-Боевой,18-Магический
Summe allen Stats ist 600
*/
INSERT INTO monster_list (ML_ID, MLImage, `Name`, Type1, Type2, ExpGroup, EvoLvl, EvoVkogo, Hp, Atk, Def, Spd, Sp_A, Sp_D) VALUES
(1, '1.png', 'Bordox', 9, 0, 3, 0, 0, 170, 120, 75, 40, 75, 120),
(2, '2.png', 'Zikudza', 9,0, 2, 0, 0, 105, 135, 89, 91, 70, 110),
(3, '3.png', 'Maorito', 9,0, 5, 0, 0, 80, 80, 75, 140, 120, 105),
(4, '4.png', 'Bouli', 9, 0,  4, 0, 0, 110, 90, 110, 100, 80,110),
(5, '5.png', 'Kokotyk', 8, 0,1, 0, 0, 100, 85, 100, 95, 95, 125),
(6, '6.png', 'Flejmaro', 2, 0, 2,0, 0, 88, 94, 88, 110, 119, 95),
(7, '7.png', 'Shalki', 3, 0, 1,0, 0, 100, 100, 100, 100, 100, 100),
(8, '8.png', 'Goron', 12, 0, 5, 0, 0, 95, 105, 220, 40, 65, 75),
(9, '9.png', 'Elzikutor', 14, 0, 5, 0, 0, 80, 95, 130, 135, 95, 90),
(10, '10.png','Leafoil', 1, 0, 2, 0, 0, 90, 92, 93, 90, 125, 110);

/* Список атак */
CREATE TABLE IF NOT EXISTS `atack_list` ( 
  AL_ID int(11) NOT NULL AUTO_INCREMENT, 
  `Name` char(32) NOT NULL, 
	Pp int(11) NOT NULL, 					/*количество*/	
  `Type` int(11) NOT NULL,					-- 1-Трава,2-Огонь,3-Вода,4-Яд,5-Лёд,6-Призрак,7-Тьма,8-Леающий,9-Нормальный,10-Дракон,11-Камень,12-Земля,13-Жук,14-Электричество,15-Психический,16-Сталь,17-Боевой,18-Магический
  Category int(11) NOT NULL, 				/*1-физический 2-специальный 0-никакого урона*/
  `Power` int(11) NOT NULL, 						/*мощность*/
  Accuracy int(11) NOT NULL, 				    /*точность in %*/
  Goal int(11) NOT NULL DEFAULT '1',  	/*1-противник, 2-пользователь(на себя)*/ 
	ChansCrita int(11) NOT NULL DEFAULT '3',		/*3% default */
  CriticDamag float(11) NOT NULL DEFAULT '1.5', 	/*damage geteilt durch 1.5*/	
  ChansEffect int(11) NOT NULL DEFAULT '0',	/*0%*/
	Effect int(11) NOT NULL DEFAULT '0',			/*1-cон 2-поджог 3-отрава */
	HpStat Float(11) NOT NULL DEFAULT '0',		/*float*/		
	AStat Float(11) NOT NULL DEFAULT '0',
	DStat Float(11) NOT NULL DEFAULT '0',
	SStat Float(11) NOT NULL DEFAULT '0',
	SaStat Float(11) NOT NULL DEFAULT '0',
	SdStat Float(11) NOT NULL DEFAULT '0',
	Info char(255) NOT NULL,
  PRIMARY KEY (`AL_ID`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  
 /* Atack_Not int(11) NOT NULL DEFAULT '1', */		/*0-монстр не может атаковать 1-может*/

INSERT INTO `atack_list` (`Name`,Pp,`Type`,Category,`Power`,Accuracy,Goal,ChansCrita,CriticDamag,ChansEffect,Effect,HpStat,AStat,DStat,SStat,SaStat,SdStat,Info) VALUES
 ('Push',	35,	9,	1,	35,	95,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 35; Type: Normal(physik); Power: 35; Accuracy: 95%; Goal: Enemy;'),
 ('Last Punch',	1,	9,	1,	10,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 1; Type: Normal(physik); Power: 10; Accuracy: 100%; Goal: Enemy;'),
 ('Meditation',	20,	9,	2,	0,	100,	2,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1.5, 'PP: 20; Type: Normal(special); Power: 0; Accuracy: 100%; Goal: User; SD: +1;'),
 ('Power Up',	20,	9,	1,	0,	100,	2,	0,	0,	0,	0,	0,	   1.5,	  1.5,	0,	0,	0, 'PP: 20; Type: Normal(physik); Power: 0; Accuracy: 100%; Goal: User; A: +1; D: +1;'),
 ('Punch',	20,	9,	1,	70,	100,	1,	35,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 20; Type: Normal(physik); Power: 70; Accuracy: 100%; Goal: Enemy;'),
 ('Hyper Blast',	5,	9,	1,	120,	85,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 5; Type: Normal(physik); Power: 120; Accuracy: 85%; Goal: Enemy;'),
 ('Scary Face',	15,	9,	1,	0,	100,	1,	0,	0,	0,	0,	0,	1.5,	0,	0,	0,	0, 'PP: 15; Type: Normal(physik); Power: 0; Accuracy: 100%; Goal: Enemy; A: -1;'),
 
 ('Wing Attack',	35,	8,	1,	60,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 35; Type: Flying(physik); Power: 60; Accuracy: 100%; Goal: Enemy;'),
 ('Speed Up',	30,	8,	2,	0,	100,	2,	0,	0,	0,	0,	0,	0,	0,	1.5,	0,	0, 'PP: 30; Type: Flying(special); Power: 0; Accuracy: 100%; Goal: User; S: +1;'),
 ('Abrupt Dive',	5,	8,	1,	1000,	30,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 5; Type: Flying(physik); Power: 1000; Accuracy: 30%; Goal: Enemy;'),
 ('Drill Peck',	20,	8,	1,	80,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 20; Type: Flying(physik); Power: 80; Accuracy: 100%; Goal: Enemy;'),
 ('Nest',	10,	8,	2,	0,	100,	2,	0,	0,	0,	0,	 0,	0,	1.5,	0,	0,	0, 'PP: 10; Type: Flying(special); Power: 0; Accuracy: 100%; Goal: User; D: +1'),
 ('Air Blast',	5,	8,	2,	100,	90,	1,	40,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 5; Type: Flying(special); Power: 100; Accuracy: 90%; Goal: Enemy; Critical: 40% chance;'),
 
 ('Fire Sphere',	25,	2,	2,	40,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 25; Type: Fire(special); Power: 40; Accuracy: 100%; Goal: Enemy;'),
 ('Flame Range',	15,	2,	2,	95,	95,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 15; Type: Fire(special); Power: 95; Accuracy: 95%; Goal: Enemy;'),
 ('Fire Fist',	20,	2,	1,	75,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 20; Type: Fire(physik); Power: 75; Accuracy: 100%; Goal: Enemy;'),
 ('Smoke',	10,	2,	2,	0,	100,	1,	0,	0,	0,	0,	0,	0,	1.5,	0,	0,	1.5, 'PP: 10; Type: Fire(special); Power: 0; Accuracy: 100%; Goal: Enemy; D: -1; SD: -1;'),	
 
 ('Hydro Blast',	5,	3,	2,	120,	80,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 5; Type: Aqua(special); Power: 120; Accuracy: 80%; Goal: Enemy;'),
 ('Water Sphere',	25,	3,	2,	40,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 25; Type: Aqua(special); Power: 40; Accuracy: 100%; Goal: Enemy;'),
 ('Water Armor',	40,	3,	2,	0,	100,	2,	0,	0,	0,	0,	0,	0,	1.5,	0,	0,	0, 'PP: 40; Type: Aqua(special); Power: 0; Accuracy: 100%; Goal: User; D: +1;'),
 ('Rain Call',	10,	3,	2,	0,	75,	2,	0,	0,	0,	0,	0,	0,	0,	0,	 1.5,	 1.5, 'PP: 10; Type: Aqua(special); Power: 0; Accuracy: 75%; Goal: User; SA: +1; SD: +1;'),
 ('Water Fist',	20,	3,	1,	75,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 20; Type: Aqua(physik); Power: 75; Accuracy: 100%; Goal: Enemy;'),
 
 ('Earthshake',	10,	12,	1,	100,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 10; Type: Ground(physik); Power: 100; Accuracy: 100%; Goal: Enemy;'),
 ('Mud Punch',	10,	12,	1,	30,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	1.5,	0,	0, 'PP: 10; Type: Ground(physik); Power: 30; Accuracy: 100%; Goal: Enemy; S: -1;'),
 ('Rock Defense',	20,	12,	2,	0,	100,	2,	0,	0,	0,	0,	0,	0,	1.5,	0,	0,	0, 'PP: 20; Type: Ground(special); Power: 0; Accuracy: 100%; Goal: User; D: +1;'),
 ('Earth Crack',	5,	12,	1,	1000,	30,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 5; Type: Ground(physik); Power: 1000; Accuracy: 30%; Goal: Enemy;'),
 
 ('Paralize',	20,	14,	2,	0,	50,	1,	0,	0,	0,	0,	0,	1.5,	1.5,	1.5,	0,	0, 'PP: 20; Type: Electric(special); Power: 0; Accuracy: 50%; Goal: Enemy; A: -1; D: -1; S: -1;'),
 ('Electro Blast',	10,	14,	2,	120,	70,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 10; Type: Electric(special); Power: 120; Accuracy: 70%; Goal: Enemy;'),
 ('Electro Fist',	20,	14,	1,	75,	100,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 20; Type: Electric(physik); Power: 75; Accuracy: 100%; Goal: Enemy;'),
 ('Zi Wave',	20,	14,	2,	60,	90,	1,	3,	1.5,	0,	0,	0,	 1.5,	0,	0,	0,	0, 'PP: 20; Type: Electric(special); Power: 60; Accuracy: 90%; Goal: Enemy; A: -1;'),
 
 ('Leaf Blast',	5,	1,	2,	120,	75,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 5; Type: Grassy(special); Power: 120; Accuracy: 75%; Goal: Enemy;'),
 ('Photosynthesis',	5,	1,	2,	100,	85,	1,	3,	1.5,	0,	0,	0,	0,	0,	0,	1.5,	0, 'PP: 5; Type: Grassy(special); Power: 100; Accuracy: 85%; Goal: Enemy; SA: -1;'),
 ('Sharp Leaf',	20,	1,	1,	75,	100,	1,	40,	1.5,	0,	0,	0,	0,	0,	0,	0,	0, 'PP: 20; Type: Grassy(physik); Power: 75; Accuracy: 100%; Goal: Enemy;'),
 ('Nature Power',	10,	1,	2,	60,	30,	1,	0,	0,	0,	0,	0, 1.5,	1.5,	1.5,	1.5,	1.5, 'PP: 10; Type: Grassy(special); Power: 60; Accuracy: 30%; Goal: Enemy; A: -1; D: -1; S: -1; SA: -1; SD: -1;');

/*Изучения атак на каком уровне*/
CREATE TABLE IF NOT EXISTS `atack_lern_level` ( 
  ALL_ID BIGINT(20) unsigned AUTO_INCREMENT,   	
	MName char(32) NOT NULL,               /* название монстра */ 
	Lvl int(11) NOT NULL,   				        /* Уровень на котором можна изучить атаку */
  AName char(32) NOT NULL, 				      /* название атаки */
  PRIMARY KEY (`ALL_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8; 

INSERT INTO atack_lern_level (MName, Lvl, AName) VALUES /*на 1 левеле всегда 4 атаки*/
('Bordox', 1, 'Push'),
('Bordox', 6, 'Meditation'),
('Bordox', 16, 'Punch'),
('Bordox', 32, 'Scary Face'),
('Bordox', 54, 'Hyper Blast'),

('Maorito', 1, 'Push'),
('Maorito', 8, 'Scary Face'),
('Maorito', 20, 'Punch'),
('Maorito', 44, 'Power Up'),
('Maorito', 80, 'Hyper Blast'),

('Zikudza', 1, 'Push'),
('Zikudza', 12, 'Scary Face'),
('Zikudza', 27, 'Punch'),
('Zikudza', 56, 'Power Up'),
('Zikudza', 83, 'Hyper Blast'),

('Bouli', 1, 'Push'),
('Bouli', 9, 'Scary Face'),
('Bouli', 13, 'Punch'),
('Bouli', 32, 'Meditation'),
('Bouli', 91, 'Hyper Blast'),

('Kokotyk', 1, 'Wing Attack'),
('Kokotyk', 10, 'Speed Up'),
('Kokotyk', 20, 'Nest'),
('Kokotyk', 30, 'Air Blast'),
('Kokotyk', 67, 'Drill Peck'),
('Kokotyk', 88, 'Abrupt Dive'),

('Flejmaro', 1, 'Fire Sphere'),
('Flejmaro', 12, 'Scary Face'),
('Flejmaro', 32, 'Fire Fist'),
('Flejmaro', 59, 'Punch'),
('Flejmaro', 64, 'Flame Range'),
('Flejmaro', 72, 'Smoke'),


('Shalki', 1, 'Water Sphere'),
('Shalki', 34, 'Water Fist'),
('Shalki', 43, 'Punch'),
('Shalki', 66, 'Water Armor'),
('Shalki', 74, 'Rain Call'),
('Shalki', 83, 'Hydro Blast'),


('Goron', 1, 'Mud Punch'),
('Goron', 16, 'Rock Defense'),
('Goron', 40, 'Scray Face'),
('Goron', 50, 'Earthshake'),
('Goron', 69, 'Earth Crack'),
('Goron', 78, 'Meditation'),

('Elzikutor', 1, 'Zi Wave'),
('Elzikutor', 15, 'Electro Fist'),
('Elzikutor', 39, 'Punch'),
('Elzikutor', 50, 'Paralize'),
('Elzikutor', 81, 'Electro Blast'),
('Elzikutor', 99, 'Power Up'),

('Leafoil', 1, 'Push'),
('Leafoil', 17, 'Sharp Leaf'),
('Leafoil', 29, 'Photosynthesis'),
('Leafoil', 45, 'Nature Power'),
('Leafoil', 77, 'Leaf Blast'),
('Leafoil', 98, 'Power Up');

/*монстры пользователя*/
CREATE TABLE IF NOT EXISTS `monster` ( 
	M_ID BIGINT(20) unsigned AUTO_INCREMENT,	/*ID монстра*/ 
	MName char(32) NOT NULL,               /*название монстра*/ 
	MOwner CHAR(32) NOT NULL,              /*владелец*/
	MDate DATE NOT NULL,
	MImage CHAR(32) NOT NULL,
	ISlot int(11) DEFAULT '0',				/*0-пустой 1-надет*/
	IID int(11) NOT NULL DEFAULT '0',
	Lvl int(11) NOT NULL DEFAULT '1',   	/*Уровень*/ 
	Hp int(11) NOT NULL DEFAULT '1', /*Cтат xп*/ 
	A int(11) NOT NULL DEFAULT '1',  /*Стат атаки*/
	D int(11) NOT NULL DEFAULT '1',  /*Стат защиты */ 
	S int(11) NOT NULL DEFAULT '1',  /*Стат скорости*/
	Sa int(11) NOT NULL DEFAULT '1', /*Стат сп. атаки*/ 
	Sd int(11) NOT NULL DEFAULT '1', /*Стат сп. защиты*/
	HpEv int(11) NOT NULL DEFAULT '0',		/*EV xп*/
	AEv int(11) NOT NULL DEFAULT '0',		/*EV атаки*/	
	DEv int(11) NOT NULL DEFAULT '0',  	/*EV защиты*/
	SEv int(11) NOT NULL DEFAULT '0',  	/*EV скорости*/
	SaEv int(11) NOT NULL DEFAULT '0', 	/*EV сп. атаки*/
	SdEv int(11) NOT NULL DEFAULT '0', 	/*EV сп. защиты*/
	HpG int(11) NOT NULL DEFAULT '28',	/*Ген xп*/
	AG int(11) NOT NULL DEFAULT '28',	/*Ген атаки*/				 	 
	DG int(11) NOT NULL DEFAULT '28', 	/*Ген защиты*/  
	SG int(11) NOT NULL DEFAULT '28', 	/*Ген скорости*/ 
	SaG int(11) NOT NULL DEFAULT '28', /*Ген сп. атаки*/
	SdG int(11) NOT NULL DEFAULT '28', /*Ген сп. защиты*/ 
	Ev int(11) NOT NULL DEFAULT '0', 		/*Очки ЕВ*/ 
	CHp int(11) NOT NULL DEFAULT '0',
	CA int(11) NOT NULL DEFAULT '0',
	CD int(11) NOT NULL DEFAULT '0',
	CS int(11) NOT NULL DEFAULT '0',
	CSa int(11) NOT NULL DEFAULT '0',
	CSd int(11) NOT NULL DEFAULT '0',
	`Exp` int(11) NOT NULL DEFAULT '0', 	/*Опыт*/ 
	ExpUp int(11) NOT NULL DEFAULT '2',	/*Опыт до следущего уровня*/ 
	Har int(11) NOT NULL DEFAULT '1', /*Характер*/    
	A1 char(32) NOT NULL DEFAULT 'Last Punch', 		/*Атака номер 1 и.т.д.*/ 
	A2 char(32) NOT NULL DEFAULT 'Last Punch', 
	A3 char(32) NOT NULL DEFAULT 'Last Punch', 
	A4 char(32) NOT NULL DEFAULT 'Last Punch', 
	A1Pp int(11) NOT NULL DEFAULT '0',		/*current A PP*/
	A2Pp int(11) NOT NULL DEFAULT '0',
	A3Pp int(11) NOT NULL DEFAULT '0',
	A4Pp int(11) NOT NULL DEFAULT '0',
	`Start` int(11) NOT NULL DEFAULT '0',	/*0-не стартовий 1 -стартовый*/
	Aktiv int(11) NOT NULL DEFAULT '0', /*0 not in team 1 in team*/
	HpCount int(11) NOT NULL DEFAULT '0',
	ACount int(11) NOT NULL DEFAULT '0',
	DCount int(11) NOT NULL DEFAULT '0',
	SCount int(11) NOT NULL DEFAULT '0',
	SaCount int(11) NOT NULL DEFAULT '0',
	SdCount int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`M_ID`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8; 

/*INSERT INTO monster (MName, MOwner, MImage, Lvl, HpEv, AEv, DEv, `Start`, Har, CHp, Aktiv) VALUES ('Bordox', 'admin', '1.png', 64, 33, 77, 2, 1, 23, 100, 1);*/
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv) 
	VALUES ('Kokotyk', 'admin', '5.png', 100, 401, 203, 233, 286, 286, 292, 126, 0, 0, 126, 126, 18, 401, 203, 233, 286, 286, 292, 'Wing Attack', 'Speed Up', 'Air Blast', 'Abrupt Dive', 35, 30, 5, 5, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv)
	VALUES ('Flejmaro', 'admin', '6.png', 100, 377, 221, 209, 316, 334, 232, 126, 0, 0, 126, 126, 18, 377, 221, 209, 316, 334, 232, 'Flame Range', 'Fire Fist', 'Scary Face', 'Smoke', 15, 20, 15, 10, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv) 
	VALUES ('Shalki', 'admin', '7.png', 100, 401, 233, 242, 233, 296, 296, 126, 0, 18, 0, 126, 126, 401, 233, 242, 233, 296, 296, 'Rain Call', 'Water Armor', 'Water Sphere', 'Hydro Blast', 10, 40, 25, 5, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv)
	VALUES ('Goron', 'admin', '8.png', 100, 391, 252, 536, 113, 163, 246, 126, 18, 126, 0, 0, 126, 391, 252, 536, 113, 163, 246, 'Earth Crack', 'Earthshake', 'Mud Punch', 'Meditation', 5, 10, 10, 20, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv)
	VALUES ('Elzikutor', 'admin', '9.png', 100,  361, 286, 302, 366, 223, 213, 126, 126, 18, 126, 0, 0, 361, 286, 302, 366, 223, 213, 'Power Up', 'Electro Blast', 'Paralize', 'Electro Fist', 20, 10, 20, 20, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv)
	VALUES ('Leafoil', 'admin', '10.png', 100, 381, 280, 282, 213, 283, 262, 126, 126, 126, 0, 0, 18, 381, 280, 282, 213, 283, 262, 'Power Up', 'Nature Power', 'Sharp Leaf', 'Leaf Blast', 20, 10, 20, 5, 1);

INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Shalki', 'admin', '7.png', 100, 0);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Goron', 'admin', '8.png', 100, 0);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Elzikutor', 'admin', '9.png', 100, 0);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Leafoil', 'admin', '10.png', 100, 0);

/*Reiner Forcement start deck*/
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv) 
	VALUES ('Kokotyk', 'Reiner Forcement', '5.png', 100, 401, 203, 233, 286, 286, 292, 126, 0, 0, 126, 126, 18, 401, 203, 233, 286, 286, 292, 'Wing Attack', 'Speed Up', 'Air Blast', 'Abrupt Dive', 35, 30, 5, 5, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv)
	VALUES ('Flejmaro', 'Reiner Forcement', '6.png', 100, 377, 221, 209, 316, 334, 232, 126, 0, 0, 126, 126, 18, 377, 221, 209, 316, 334, 232, 'Flame Range', 'Fire Fist', 'Scary Face', 'Smoke', 15, 20, 15, 10, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv) 
	VALUES ('Shalki', 'Reiner Forcement', '7.png', 100, 401, 233, 242, 233, 296, 296, 126, 0, 18, 0, 126, 126, 401, 233, 242, 233, 296, 296, 'Rain Call', 'Water Armor', 'Water Sphere', 'Hydro Blast', 10, 40, 25, 5, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv)
	VALUES ('Goron', 'Reiner Forcement', '8.png', 100, 391, 252, 536, 113, 163, 246, 126, 18, 126, 0, 0, 126, 391, 252, 536, 113, 163, 246, 'Earth Crack', 'Earthshake', 'Mud Punch', 'Meditation', 5, 10, 10, 20, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv)
	VALUES ('Elzikutor', 'Reiner Forcement', '9.png', 100,  361, 286, 302, 366, 223, 213, 126, 126, 18, 126, 0, 0, 361, 286, 302, 366, 223, 213, 'Power Up', 'Electro Blast', 'Paralize', 'Electro Fist', 20, 10, 20, 20, 1);
INSERT INTO monster (MName, MOwner, MImage, Lvl, Hp, A, D, S, Sa, Sd, HpEv, AEv, DEv, SEv, SaEv, SdEv, CHp, CA, CD, CS, CSa, CSd, A1, A2, A3, A4, A1Pp, A2Pp, A3Pp, A4Pp, Aktiv)
	VALUES ('Leafoil', 'Reiner Forcement', '10.png', 100, 381, 280, 282, 213, 283, 262, 126, 126, 126, 0, 0, 18, 381, 280, 282, 213, 283, 262, 'Power Up', 'Nature Power', 'Sharp Leaf', 'Leaf Blast', 20, 10, 20, 5, 1);

CREATE TABLE IF NOT EXISTS `wild_monster` ( /*only normal*/
	M_ID BIGINT(20) unsigned AUTO_INCREMENT,	/*ID монстра*/ 
	MName char(32) NOT NULL,               /*название монстра*/ 
	For_User char(32) NOT NULL,
	Lvl int(11) NOT NULL DEFAULT '1',   	/*Уровень*/ 
	Hp int(11) NOT NULL DEFAULT '1', /*Cтат xп*/ 
	A int(11) NOT NULL DEFAULT '1',  /*Стат атаки*/
	D int(11) NOT NULL DEFAULT '1',  /*Стат защиты */ 
	S int(11) NOT NULL DEFAULT '1',  /*Стат скорости*/
	Sa int(11) NOT NULL DEFAULT '1', /*Стат сп. атаки*/ 
	Sd int(11) NOT NULL DEFAULT '1', /*Стат сп. защиты*/
	CHp int(11) NOT NULL DEFAULT '0',  
	CA int(11) NOT NULL DEFAULT '0',
	CD int(11) NOT NULL DEFAULT '0',
	CS int(11) NOT NULL DEFAULT '0',
	CSa int(11) NOT NULL DEFAULT '0',
	CSd int(11) NOT NULL DEFAULT '0',	
	HpCount int(11) NOT NULL DEFAULT '0',
	ACount int(11) NOT NULL DEFAULT '0',
	DCount int(11) NOT NULL DEFAULT '0',
	SCount int(11) NOT NULL DEFAULT '0',
	SaCount int(11) NOT NULL DEFAULT '0',
	SdCount int(11) NOT NULL DEFAULT '0',
	A1 char(32) NOT NULL DEFAULT 'Push', 		/*Атака номер 1 и.т.д.*/ 
	A2 char(32) NOT NULL DEFAULT 'Punch', 
	A3 char(32) NOT NULL DEFAULT 'Push', 
	A4 char(32) NOT NULL DEFAULT 'Last Punch', 
	PRIMARY KEY (`M_ID`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8; 

/*Характер*/
CREATE TABLE IF NOT EXISTS `har` ( 
	Har_ID int(11) NOT NULL AUTO_INCREMENT, 
	Hatk float(11) NOT NULL DEFAULT '1', 
	Hdef float(11) NOT NULL DEFAULT '1', 
	Hspeed float(11) NOT NULL DEFAULT '1', 
	Hsatk float(11) NOT NULL DEFAULT '1', 
	Hsdef float(11) NOT NULL DEFAULT '1', 
	PRIMARY KEY (`Har_ID`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  

INSERT INTO `har` (Har_ID, Hatk, Hdef, Hspeed, Hsatk, Hsdef) VALUES 
	(1, '1', '1', '1', '1', '1'), 
	(2, '1', '1', '0.9', '1', '1.1'), 
	(3, '0.9', '1', '1', '1.1', '1'), 
	(4, '1', '0.9', '1.1', '1', '1'), 
	(5, '0.9', '1.1', '1', '1', '1'), 
	(6, '1', '1', '1', '0.9', '1.1'), 
	(7, '1', '1', '1', '1.1', '0.9'), 
	(8, '1', '0.9', '1', '1.1', '1'), 
	(9, '1.1', '1', '1', '0.9', '1'), 
	(10, '1.1', '1', '0.9', '1', '1'), 
	(11, '1', '1', '1', '1', '1'), 
	(12, '1.1', '0.9', '1', '1', '1'), 
	(13, '1', '1.1', '0.9', '1', '1'), 
	(14, '1', '1', '0.9', '1.1', '1'), 
	(15, '1', '0.9', '1', '1', '1.1'), 
	(16, '1', '1', '1', '1', '1'), 
	(17, '1', '1.1', '1', '0.9', '1'), 
	(18, '0.9', '1', '1', '1', '1.1'), 
	(19, '1', '1', '1', '1', '1'), 
	(20, '0.9', '1', '1.1', '1', '1'), 
	(21, '1.1', '1', '1', '1', '0.9'), 
	(22, '1', '1.1', '1', '1', '0.9'), 
	(23, '1', '1', '1.1', '0.9', '1'), 
	(24, '1', '1', '1.1', '1', '0.9');
	
/*Таблица чата*/
CREATE TABLE IF NOT EXISTS `chat` (
	Ch_ID BIGINT unsigned NOT NULL auto_increment,
	Datum DATE NOT NULL,
	Zeit TIME NOT NULL,
	Nick_Name CHAR(25) NOT NULL DEFAULT '', 	
	Nick_Name_To CHAR(25) NOT NULL DEFAULT '', 	
	Ch_Msg CHAR(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`Ch_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Таблица ефективонсти типов*/
/*more details look sql/Types_effectivity.xlsx*/
CREATE TABLE IF NOT EXISTS `type_effectivity` (
	Counter INT unsigned NOT NULL auto_increment,
	Type1 Int(2) NOT NULL,
	Type2 Int(2) NOT NULL,
	Effectivity Float(11) NOT NULL, 			
	PRIMARY KEY (`Counter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `type_effectivity` (Counter, Type1, Type2, Effectivity) VALUES
	(1, 9, 9, 0.5),
	(2, 9, 8, 1),
	(3, 9, 2, 1),
	(4, 9, 3, 1),
	(5, 9, 12, 1),
	(6, 9, 14, 1),
	(7, 9, 1, 1),
	
	(8, 8, 9, 1),
	(9, 8, 8, 0.5),
	(10, 8, 2, 1),
	(11, 8, 3, 1),
	(12, 8, 12, 1),
	(13, 8, 14, 0.5),
	(14, 8, 1, 2),
	
	(15, 2, 9, 1),
	(16, 2, 8, 1),
	(17, 2, 2, 0.5),
	(18, 2, 3, 0.5),
	(19, 2, 12, 0.5),
	(20, 2, 14, 1),
	(21, 2, 1, 2),
	
	(22, 3, 9, 1),
	(23, 3, 8, 1),
	(24, 3, 2, 2),
	(25, 3, 3, 0.5),
	(26, 3, 12, 2),
	(27, 3, 14, 1),
	(28, 3, 1, 0.5),
	
	(29, 12, 9, 1),
	(30, 12, 8, 0),
	(31, 12, 2, 2),
	(32, 12, 3, 1),
	(33, 12, 12, 0.5),
	(34, 12, 14, 2),
	(35, 12, 1, 0.5),
	
	(36, 14, 9, 1),
	(37, 14, 8, 2),
	(38, 14, 2, 1),
	(39, 14, 3, 2),
	(40, 14, 12, 0),
	(41, 14, 14, 0.5),
	(42, 14, 1, 0.5),
	
	(43, 1, 9, 1),
	(44, 1, 8, 0.5),
	(45, 1, 2, 0.5),
	(46, 1, 3, 2),
	(47, 1, 12, 2),
	(48, 1, 14, 1),
	(49, 1, 1, 0.5);

CREATE TABLE IF NOT EXISTS `protokol` (
	P_ID BIGINT unsigned NOT NULL auto_increment,
	`Round` BIGINT unsigned NOT NULL DEFAULT '0',
	`User` CHAR(25) NOT NULL, 
	Monster_Name CHAR(25) NOT NULL,
	Monster_Name_Against CHAR(25) NOT NULL, 	
	Atack_Used CHAR(25) NOT NULL,
	Damage INT NOT NULL,
	Status CHAR(25) NOT NULL, /*critical, missed*/
	Effectivity CHAR(25) NOT NULL,
	HpCount int(11) NOT NULL DEFAULT '0',
	ACount int(11) NOT NULL DEFAULT '0',
	DCount int(11) NOT NULL DEFAULT '0',
	SCount int(11) NOT NULL DEFAULT '0',
	SaCount int(11) NOT NULL DEFAULT '0',
	SdCount int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`P_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;	

CREATE TABLE IF NOT EXISTS `a1_a2_protokol` (
	ID BIGINT unsigned NOT NULL auto_increment,
	`Round` BIGINT unsigned NOT NULL DEFAULT '0',
	`User` CHAR(25) NOT NULL, 
	Monster_Name CHAR(25) NOT NULL,
	Monster_Name_Against CHAR(25) NOT NULL, 	
	Atack_Used CHAR(25) NOT NULL,
	Damage INT NOT NULL,
	Status CHAR(25) NOT NULL, /*critical, missed*/
	Effectivity CHAR(25) NOT NULL,
	HpCount int(11) NOT NULL DEFAULT '0',
	ACount int(11) NOT NULL DEFAULT '0',
	DCount int(11) NOT NULL DEFAULT '0',
	SCount int(11) NOT NULL DEFAULT '0',
	SaCount int(11) NOT NULL DEFAULT '0',
	SdCount int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;	

CREATE TABLE IF NOT EXISTS `score` (
	ID BIGINT unsigned NOT NULL auto_increment,
	`Datetime` DATETIME NOT NULL,
	Agent1 CHAR(25) NOT NULL,
	Agent2 CHAR(25) NOT NULL,
	Match_Played int(11) NOT NULL DEFAULT '0',
	Points1 INT NOT NULL,
	Points2 INT NOT NULL,
	PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	
INSERT INTO score VALUES ('', '0000-00-00 00:00:00', 'Random', 'Random', 0, 0, 0);

CREATE TABLE IF NOT EXISTS `selected_simulation` (
	ID BIGINT unsigned NOT NULL auto_increment,
	`Value` int(11) NOT NULL DEFAULT '0',
	Nick_Name CHAR(25) NOT NULL,
	PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `memory` (
	ID BIGINT unsigned NOT NULL auto_increment,
	State1 int(1) NOT NULL,
	State2 int(1) NOT NULL,
	`Action` int(1) NOT NULL,
	Reward int NOT NULL DEFAULT '0',
	PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*check Actions*/
/*
SELECT ID FROM memory GROUP BY State1, State2, Action HAVING COUNT(*) > 1
SELECT * FROM memory GROUP BY State1, State2, Action
SELECT COUNT(ID) FROM memory;
*/
