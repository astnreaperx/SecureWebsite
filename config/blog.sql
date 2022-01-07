/* SQL Manager Lite for MySQL                              5.8.0.53936 */
/* ------------------------------------------------------------------- */
/* Host     : 192.168.56.103                                           */
/* Port     : 3306                                                     */
/* Database : blog                                                     */


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8mb4' */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `blog`
    CHARACTER SET 'utf8mb4'
    COLLATE 'utf8mb4_general_ci';

USE `blog`;

/* Structure for the `members` table : */

CREATE TABLE `members` (
  `id` INTEGER(4) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `password` VARCHAR(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `salt` VARCHAR(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` VARCHAR(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_login` DATETIME DEFAULT current_timestamp(),
  `failed_login` INTEGER(11) DEFAULT 0,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=31 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci'
;

/* Structure for the `phprbac_permissions` table : */

CREATE TABLE `phprbac_permissions` (
  `ID` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Lft` INTEGER(11) NOT NULL,
  `Rght` INTEGER(11) NOT NULL,
  `Title` CHAR(64) COLLATE utf8_bin NOT NULL,
  `Description` TEXT COLLATE utf8_bin NOT NULL,
  PRIMARY KEY USING BTREE (`ID`),
  KEY `Title` USING BTREE (`Title`),
  KEY `Lft` USING BTREE (`Lft`),
  KEY `Rght` USING BTREE (`Rght`)
) ENGINE=InnoDB
AUTO_INCREMENT=5 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_bin'
;

/* Structure for the `phprbac_rolepermissions` table : */

CREATE TABLE `phprbac_rolepermissions` (
  `RoleID` INTEGER(11) NOT NULL,
  `PermissionID` INTEGER(11) NOT NULL,
  `AssignmentDate` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`RoleID`, `PermissionID`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_bin'
;

/* Structure for the `phprbac_roles` table : */

CREATE TABLE `phprbac_roles` (
  `ID` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Lft` INTEGER(11) NOT NULL,
  `Rght` INTEGER(11) NOT NULL,
  `Title` VARCHAR(128) COLLATE utf8_bin NOT NULL,
  `Description` TEXT COLLATE utf8_bin NOT NULL,
  PRIMARY KEY USING BTREE (`ID`),
  KEY `Title` USING BTREE (`Title`),
  KEY `Lft` USING BTREE (`Lft`),
  KEY `Rght` USING BTREE (`Rght`)
) ENGINE=InnoDB
AUTO_INCREMENT=5 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_bin'
;

/* Structure for the `phprbac_userroles` table : */

CREATE TABLE `phprbac_userroles` (
  `UserID` INTEGER(11) NOT NULL,
  `RoleID` INTEGER(11) NOT NULL,
  `AssignmentDate` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`UserID`, `RoleID`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_bin'
;

/* Structure for the `posts` table : */

CREATE TABLE `posts` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL,
  `content` TEXT COLLATE latin1_swedish_ci NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=7 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Data for the `members` table  (LIMIT 0,500) */

INSERT INTO `members` (`id`, `username`, `password`, `salt`, `email`, `last_login`, `failed_login`) VALUES
  (15,'sjay','2a972a641d18b51585683ce856e341b90c959fd36ab5535c8fa1a3cb16273ea27259a98780f8ee09b4ae8de18e7071024d2fa2789ef6ffb2fb23001f7ae3f00c','5f7225ace8d13',NULL,'2020-12-14 11:54:12',0),
  (18,'aslota','6a4c77eaa6f2968677284c9151e68703eb851bcd58c897658a95829a0c31ea2bc57fb706ba3c94050db2179a0904473973afa12f42034bf83df788cd15132cf4','5fbbfa8a85313',NULL,'2020-12-14 11:37:18',0),
  (21,'user','e707efa1a95ef57f2ae3cc1190ede282606448166d6e1ae3ecfd7afa9185b17dbac8781fbc4fa14847efe6ff94c128dc74e6cd596a1ecbdf3f79d323690612e3','5fc85b70a7d15','user@user.user','2020-12-02 21:28:57',0),
  (23,'admin','a70e47d8beb8393040b8bee49c20e21b22f2a165eef528849c4a73ef7c34239a3fd16c75cf8da1196a5bf4a93680a98ad7f390318bf942d0d60a0736402ce810','5fcd411fc8a75','admin@i.t','2020-12-14 12:24:58',1),
  (27,'test','3f96a42df92d9b4642fc4b527d3595e3abb01ddb847346c7dda08ed7d137550d7ff46968376658dc76419960ec68a5d7fd07573177914cd422f9df39f04a6675','5fd789afc1373','test@test.test','2020-12-14 11:26:26',0),
  (28,'rbacAdmin','794271230ea0885e25de6af5f4777c327c3af56f1fee918768386254a521da96c24686797f86a3f13d205909a7eec51f92e86a07392176cdb7ef6d9f631adbae','5fd78e7b49465','rbac@admin.test','2020-12-14 10:37:15',0),
  (30,'asdf','41c114b3e07f97f65ff471f3e0108711f4a840e0b748dbeed9d9ce577b8c0757f5397041a895a4d2c193a5f7ae1dd8a87d0c02db514d38ee99269925520b347b','5fd7a0d780db5','asdf@as.df','2020-12-14 11:29:03',0);
COMMIT;

/* Data for the `phprbac_permissions` table  (LIMIT 0,500) */

INSERT INTO `phprbac_permissions` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
  (1,0,7,'root','root'),
  (2,1,2,'admin','Administer Site'),
  (3,3,4,'admin','Administer Site'),
  (4,5,6,'admin','Administer Site');
COMMIT;

/* Data for the `phprbac_rolepermissions` table  (LIMIT 0,500) */

INSERT INTO `phprbac_rolepermissions` (`RoleID`, `PermissionID`, `AssignmentDate`) VALUES
  (1,1,1606157117),
  (2,2,1606417681);
COMMIT;

/* Data for the `phprbac_roles` table  (LIMIT 0,500) */

INSERT INTO `phprbac_roles` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
  (1,0,7,'root','root'),
  (2,1,2,'admin','Administrator'),
  (3,3,4,'admin','Administrator'),
  (4,5,6,'admin','Administrator');
COMMIT;

/* Data for the `phprbac_userroles` table  (LIMIT 0,500) */

INSERT INTO `phprbac_userroles` (`UserID`, `RoleID`, `AssignmentDate`) VALUES
  (1,1,1606157117),
  (23,2,1607287191),
  (28,2,1607962395);
COMMIT;

/* Data for the `posts` table  (LIMIT 0,500) */

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
  (1,'Luctus Metus Libero','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.\r\n\r\nSed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.','2013-05-08 15:50:00','2013-05-08 18:57:22'),
  (2,'Consectetuer Adipiscing','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere.','2013-05-08 18:12:25','2013-05-08 18:58:11'),
  (4,'New Post','This is some content.','2013-05-08 19:01:07','2013-05-08 19:01:07'),
  (6,'DVWA Injection ','http://192.168.56.103/dvwa/vulnerabilities/fi/?page=/etc/passwd','2020-11-23 12:22:44','2020-11-23 12:22:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
