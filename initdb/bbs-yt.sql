-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2026-02-25 12:27:07
-- サーバのバージョン： 8.4.7
-- PHP のバージョン: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bbs-yt`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `bbs-table`
--

CREATE TABLE `bbs-table` (
  `id` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `postDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `bbs-table`
--

INSERT INTO `bbs-table` (`id`, `username`, `comment`, `postDate`) VALUES
(15, 'aa', 'aaaaaa', '2025-11-16 19:24:08'),
(16, 'あああ', 'あああああああああああああ', '2025-11-16 19:24:12'),
(17, 'あああ', 'あああああああああああああ', '2025-11-16 19:25:34'),
(18, 'あああ', 'あああああああああああああ', '2025-11-16 19:39:57'),
(19, 'aaa', 'っっっb', '2025-11-16 19:40:02');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bbs-table`
--
ALTER TABLE `bbs-table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bbs-table`
--
ALTER TABLE `bbs-table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
