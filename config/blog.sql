-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 04:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_permissions`
--

CREATE TABLE `blog_permissions` (
  `ID` int(11) NOT NULL,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` char(64) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blog_permissions`
--

INSERT INTO `blog_permissions` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
(1, 0, 3, 'root', 'root'),
(2, 1, 2, 'admin', 'Administer Site');

-- --------------------------------------------------------

--
-- Table structure for table `blog_rolepermissions`
--

CREATE TABLE `blog_rolepermissions` (
  `RoleID` int(11) NOT NULL,
  `PermissionID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blog_rolepermissions`
--

INSERT INTO `blog_rolepermissions` (`RoleID`, `PermissionID`, `AssignmentDate`) VALUES
(1, 1, 1642043473),
(2, 2, 1642043705);

-- --------------------------------------------------------

--
-- Table structure for table `blog_roles`
--

CREATE TABLE `blog_roles` (
  `ID` int(11) NOT NULL,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` varchar(128) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blog_roles`
--

INSERT INTO `blog_roles` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
(1, 0, 3, 'root', 'root'),
(2, 1, 2, 'admin', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `blog_userroles`
--

CREATE TABLE `blog_userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blog_userroles`
--

INSERT INTO `blog_userroles` (`UserID`, `RoleID`, `AssignmentDate`) VALUES
(1, 1, 1642043473),
(18, 2, 1642043705);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(4) NOT NULL,
  `username` varchar(200) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `salt` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `last_login` datetime DEFAULT current_timestamp(),
  `failed_login` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `salt`, `email`, `last_login`, `failed_login`) VALUES
(15, 'sjay', '2a972a641d18b51585683ce856e341b90c959fd36ab5535c8fa1a3cb16273ea27259a98780f8ee09b4ae8de18e7071024d2fa2789ef6ffb2fb23001f7ae3f00c', '5f7225ace8d13', NULL, '2020-12-14 11:54:12', 0),
(18, 'aslota', '6a4c77eaa6f2968677284c9151e68703eb851bcd58c897658a95829a0c31ea2bc57fb706ba3c94050db2179a0904473973afa12f42034bf83df788cd15132cf4', '5fbbfa8a85313', NULL, '2022-01-12 21:08:09', 0),
(21, 'user', 'e707efa1a95ef57f2ae3cc1190ede282606448166d6e1ae3ecfd7afa9185b17dbac8781fbc4fa14847efe6ff94c128dc74e6cd596a1ecbdf3f79d323690612e3', '5fc85b70a7d15', 'user@user.user', '2020-12-02 21:28:57', 0),
(23, 'admin', 'a70e47d8beb8393040b8bee49c20e21b22f2a165eef528849c4a73ef7c34239a3fd16c75cf8da1196a5bf4a93680a98ad7f390318bf942d0d60a0736402ce810', '5fcd411fc8a75', 'admin@i.t', '2020-12-14 12:24:58', 1),
(27, 'test', '3f96a42df92d9b4642fc4b527d3595e3abb01ddb847346c7dda08ed7d137550d7ff46968376658dc76419960ec68a5d7fd07573177914cd422f9df39f04a6675', '5fd789afc1373', 'test@test.test', '2020-12-14 11:26:26', 0),
(28, 'rbacAdmin', '794271230ea0885e25de6af5f4777c327c3af56f1fee918768386254a521da96c24686797f86a3f13d205909a7eec51f92e86a07392176cdb7ef6d9f631adbae', '5fd78e7b49465', 'rbac@admin.test', '2020-12-14 10:37:15', 0),
(30, 'asdf', '41c114b3e07f97f65ff471f3e0108711f4a840e0b748dbeed9d9ce577b8c0757f5397041a895a4d2c193a5f7ae1dd8a87d0c02db514d38ee99269925520b347b', '5fd7a0d780db5', 'asdf@as.df', '2020-12-14 11:29:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Luctus Metus Libero', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.\r\n\r\nSed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.', '2013-05-08 20:50:00', '2013-05-08 23:57:22'),
(2, 'Consectetuer Adipiscing', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere.', '2013-05-08 23:12:25', '2013-05-08 23:58:11'),
(4, 'New Post', 'This is some content.', '2013-05-09 00:01:07', '2013-05-09 00:01:07'),
(6, 'DVWA Injection ', 'http://192.168.56.103/dvwa/vulnerabilities/fi/?page=/etc/passwd', '2020-11-23 18:22:44', '2020-11-23 18:22:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_permissions`
--
ALTER TABLE `blog_permissions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Title` (`Title`),
  ADD KEY `Lft` (`Lft`),
  ADD KEY `Rght` (`Rght`);

--
-- Indexes for table `blog_rolepermissions`
--
ALTER TABLE `blog_rolepermissions`
  ADD PRIMARY KEY (`RoleID`,`PermissionID`);

--
-- Indexes for table `blog_roles`
--
ALTER TABLE `blog_roles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Title` (`Title`),
  ADD KEY `Lft` (`Lft`),
  ADD KEY `Rght` (`Rght`);

--
-- Indexes for table `blog_userroles`
--
ALTER TABLE `blog_userroles`
  ADD PRIMARY KEY (`UserID`,`RoleID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_permissions`
--
ALTER TABLE `blog_permissions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_roles`
--
ALTER TABLE `blog_roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
