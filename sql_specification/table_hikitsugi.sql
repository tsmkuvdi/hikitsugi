-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2019 年 7 月 08 日 06:31
-- サーバのバージョン： 10.3.15-MariaDB
-- PHP のバージョン: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hikitsugi_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `table_hikitsugi`
--

CREATE TABLE `table_hikitsugi` (
  `id_hikitsugi` int(250) UNSIGNED NOT NULL,
  `hizuke` date NOT NULL,
  `naiyou` varchar(500) NOT NULL,
  `tantou` varchar(20) NOT NULL,
  `category` tinyint(1) UNSIGNED NOT NULL,
  `shinkou` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `table_hikitsugi`
--
ALTER TABLE `table_hikitsugi`
  ADD PRIMARY KEY (`id_hikitsugi`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `table_hikitsugi`
--
ALTER TABLE `table_hikitsugi`
  MODIFY `id_hikitsugi` int(250) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
