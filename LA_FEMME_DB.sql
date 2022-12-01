CREATE TABLE `members` (
  `username` varchar(20) PRIMARY KEY,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `date_j` varchar(10) NOT NULL
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
INSERT INTO `members` VALUES ('admin', 'admin@admin', '0admin0', 'images/admin_avatar.svg','');


CREATE TABLE `category` (
  `id_cat` int(5) PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `description` varchar(255)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
INSERT INTO `category` VALUES (1, 'Travail et Carrières', 'Fatigué de cette course de rat? Voulez-vous travailler pour vous-même? Stressé au travail? Moussant à la bouche pour cette promotion? Parlez travail et carrières ici.');
INSERT INTO `category` VALUES (2, 'Santé', 'Essayer de perdre quelques kilos? Vous voulez des conseils sur la façon de manger sainement? Vous ne dormez pas la nuit? Discutez de tous les sujets liés à la santé et à l''alimentation ici.');
INSERT INTO `category` VALUES (3, 'Amour & Relations', 'De "juste des amis" à se marier. Si vous voulez exprimer vos frustrations ou demander l''avis d''autres personnes, n''hésitez pas à poster ici.');
INSERT INTO `category` VALUES (4, 'Mode & Style de Vie', 'Vous voulez marcher sur le podium avec fierté ou simplement frapper les centres commerciaux en sachant ce qui semble bien? De l''habillement à la vie à la maison et au développement personnel - la mode de causerie et le style de vie dans ce forum.');
INSERT INTO `category` VALUES (5, 'Autres', 'Autre catégorie du votre choix.');


CREATE TABLE `posts` (
  `id_p` int(11) PRIMARY KEY auto_increment,
  `author` varchar(20) NOT NULL,
  `category` int(5) NOT NULL,
  `title` varchar(65) NOT NULL,
  `text` longtext NOT NULL,
  `date_ls` datetime NOT NULL,
  `date` VARCHAR( 20 ) NOT NULL
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE  `posts` ADD FOREIGN KEY (`author`) REFERENCES  `members` (`username`) ON DELETE CASCADE;
ALTER TABLE  `posts` ADD FOREIGN KEY (`category`) REFERENCES  `category` (`id_cat`) ON DELETE CASCADE;


CREATE TABLE `comments` (
  `id_c` int(11) PRIMARY KEY auto_increment,
  `id_p` int(11) NOT NULL,
  `date_ls` datetime NOT NULL,
  `date` VARCHAR(20) NOT NULL,
  `author` varchar(20) NOT NULL,
  `text` LONGTEXT
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE  `comments` ADD FOREIGN KEY (`id_p`) REFERENCES  `posts` (`id_p`) ON DELETE CASCADE;
ALTER TABLE  `comments` ADD FOREIGN KEY (`author`) REFERENCES  `members` (`username`) ON DELETE CASCADE;


CREATE TABLE  `contact` (
 `id_cont` INT NOT NULL AUTO_INCREMENT ,
 `email` VARCHAR( 50 ) NOT NULL ,
 `name` VARCHAR( 20 ) NOT NULL ,
 `subject` VARCHAR( 65 ) NOT NULL ,
 `message` LONGTEXT NOT NULL ,
PRIMARY KEY (`id_cont`)
);
