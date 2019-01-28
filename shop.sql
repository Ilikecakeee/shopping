-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-06-30 04:05:30
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `dadingdan`
--

CREATE TABLE `dadingdan` (
  `id` varchar(50) NOT NULL,
  `fahuozhuangtai` tinyint(4) NOT NULL,
  `shouhuozhuangtai` tinyint(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dadingdan`
--

INSERT INTO `dadingdan` (`id`, `fahuozhuangtai`, `shouhuozhuangtai`, `username`, `time`) VALUES
('1Th8aOdAWu', 1, 1, 'pupu', '2018-06-20 05:39:00'),
('89gMDpLSxO', 1, 1, 'hehe', '2018-06-25 01:01:24'),
('915hsRTSoP', 1, 0, 'hehe', '2018-06-29 13:54:42'),
('eLHTdbyqrj', 0, 0, 'pupu', '2018-06-25 07:35:48'),
('gt83YGmNRc', 0, 0, 'hehe', '2018-06-25 03:22:34'),
('ICHlrM79LA', 1, 1, 'hehe', '2018-06-20 05:37:54'),
('IKWqFsYHui', 0, 0, 'hehe', '2018-06-22 03:27:40'),
('yDSUFvqkCr', 1, 1, 'pupu', '2018-06-21 04:53:17');

-- --------------------------------------------------------

--
-- 表的结构 `dingdan`
--

CREATE TABLE `dingdan` (
  `id` int(20) NOT NULL COMMENT 'AUTO_INCREMENT',
  `username` varchar(20) NOT NULL,
  `shangpinid` int(20) NOT NULL,
  `shuliang` int(20) NOT NULL,
  `pinglun` tinyint(4) NOT NULL,
  `dingdanhao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dingdan`
--

INSERT INTO `dingdan` (`id`, `username`, `shangpinid`, `shuliang`, `pinglun`, `dingdanhao`) VALUES
(11, 'hehe', 1, 2, 1, 'ICHlrM79LA'),
(12, 'hehe', 2, 1, 1, 'ICHlrM79LA'),
(13, 'pupu', 1, 1, 1, '1Th8aOdAWu'),
(14, 'pupu', 4, 1, 1, '1Th8aOdAWu'),
(15, 'pupu', 3, 1, 1, 'yDSUFvqkCr'),
(19, 'hehe', 6, 2, 0, 'IKWqFsYHui'),
(20, 'hehe', 8, 1, 0, 'IKWqFsYHui'),
(21, 'hehe', 6, 1, 0, '89gMDpLSxO'),
(22, 'hehe', 5, 1, 0, '89gMDpLSxO'),
(23, 'hehe', 4, 1, 0, 'gt83YGmNRc'),
(24, 'pupu', 6, 1, 0, 'eLHTdbyqrj'),
(25, 'pupu', 9, 2, 0, 'eLHTdbyqrj'),
(26, 'hehe', 1, 2, 0, '915hsRTSoP'),
(27, 'hehe', 6, 1, 0, '915hsRTSoP');

-- --------------------------------------------------------

--
-- 表的结构 `fenlei`
--

CREATE TABLE `fenlei` (
  `id` int(20) NOT NULL COMMENT 'AUTO_INCREMENT',
  `mingcheng` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `fenlei`
--

INSERT INTO `fenlei` (`id`, `mingcheng`) VALUES
(1, '奶油蛋糕'),
(2, '巧克力蛋糕'),
(3, '芝士蛋糕'),
(4, '慕斯蛋糕'),
(5, '水果蛋糕');

-- --------------------------------------------------------

--
-- 表的结构 `gouwuche`
--

CREATE TABLE `gouwuche` (
  `id` int(20) NOT NULL COMMENT 'AUTO_INCREMENT',
  `username` varchar(20) NOT NULL,
  `shangpinid` int(20) NOT NULL,
  `shuliang` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gouwuche`
--

INSERT INTO `gouwuche` (`id`, `username`, `shangpinid`, `shuliang`) VALUES
(5, 'pupu', 1, 2),
(6, 'pupu', 6, 1),
(9, 'hehe', 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `guanggao`
--

CREATE TABLE `guanggao` (
  `id` int(20) NOT NULL COMMENT 'AUTO_INCREMENT',
  `img` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `guanggao`
--

INSERT INTO `guanggao` (`id`, `img`, `url`) VALUES
(1, '20180622012222163.jpg', 'http://localhost/mmm/shangpinxiangqing.php?id=4'),
(2, '20180622020027277.jpg', 'http://localhost/mmm/shangpinxiangqing.php?id=3'),
(3, '20180622022519601.jpg', ''),
(4, '20180622022533516.jpg', ''),
(5, '20180622022559821.jpg', '');

-- --------------------------------------------------------

--
-- 表的结构 `pinglun`
--

CREATE TABLE `pinglun` (
  `id` int(20) NOT NULL COMMENT 'AUTO_INCREMENT',
  `shangpinid` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `neirong` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pinglun`
--

INSERT INTO `pinglun` (`id`, `shangpinid`, `username`, `time`, `neirong`) VALUES
(1, 1, 'hehe', '2018-06-20 08:00:42', '我饿死了'),
(2, 1, 'pupu', '2018-06-21 06:22:39', '好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃好吃'),
(3, 4, 'pupu', '2018-06-21 06:27:26', '呃呃呃鹅鹅鹅鹅鹅鹅饿鹅鹅鹅饿'),
(4, 4, 'pupu', '2018-06-21 06:34:48', '啊啊啊啊啊啊啊啊啊啊啊啊啊啊'),
(5, 2, 'hehe', '2018-06-21 06:42:53', '啊啊啊啊啊啊啊啊啊啊'),
(6, 3, 'pupu', '2018-06-25 07:43:35', '和哈哈哈哈哈哈哈哈哈');

-- --------------------------------------------------------

--
-- 表的结构 `shangpin`
--

CREATE TABLE `shangpin` (
  `id` int(20) NOT NULL COMMENT 'AUTO_INCREMENT',
  `mingcheng` varchar(20) NOT NULL,
  `jieshao` varchar(200) NOT NULL,
  `xiaoliang` int(20) NOT NULL,
  `jiage` float NOT NULL,
  `image` varchar(200) NOT NULL,
  `jieshaoimg` varchar(200) NOT NULL,
  `fenleiid` int(20) NOT NULL,
  `kucun` int(20) NOT NULL,
  `fashouzhuangtai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shangpin`
--

INSERT INTO `shangpin` (`id`, `mingcheng`, `jieshao`, `xiaoliang`, `jiage`, `image`, `jieshaoimg`, `fenleiid`, `kucun`, `fashouzhuangtai`) VALUES
(1, '朗姆芝士', 'Rum Cheese Cake', 7, 198, '20180611004544131.jpg+20180611004544750.jpg+20180611004544751.jpg', '20180611004544948.jpg+20180611004544776.jpg+20180611004544462.jpg', 1, 36, 1),
(2, '黑白巧克力慕斯', 'Black And White Chocolate Mousse', 1, 198, '20180611092142912.jpg+20180611092142524.jpg', '20180611092142533.jpg+20180611092142467.jpg+20180611092142243.jpg', 2, 10, 1),
(3, '凍慕斯與焗芝士', 'Cool&Hot', 1, 198, '20180611114506827.jpg+20180611114506520.jpg+20180611114506186.jpg', '20180611114506302.jpg+20180611114506670.jpg+20180611114506412.jpg+20180611114506115.jpg', 3, 30, 1),
(4, '百利甜情人', 'Bailey\'s Love Triangle', 2, 198, '20180611114822840.jpg', '20180611114822794.jpg+20180611114822547.jpg+20180611114822905.jpg', 1, 19, 1),
(5, '摩卡', '鲜奶乳脂奶油巧克力摩卡生日蛋糕', 1, 268, '20180613082107573.jpg+20180613082106215.jpg', '20180613082107154.jpg+20180613082107864.jpg+20180613082107522.jpg+20180613082107574.jpg', 4, 9, 1),
(6, '彼尔德黑白巧克力慕斯', '', 5, 198, '20180621055013433.jpg+20180621055013276.jpg', '20180621055013671.jpg+20180621055013141.jpg+20180621055013428.jpg+20180621055013674.jpg+20180621055013415.jpg', 2, 5, 1),
(8, '奶油蛋糕', '甄选进口稀奶油', 1, 150, '20180622030429619.jpg', '20180622030429110.jpg+20180622030429720.jpg', 1, 9, 1),
(9, '桃仁水果蛋糕', '', 2, 159, '20180622030616751.jpg+20180622030616340.jpg', '20180622030616562.jpg+20180622030616601.jpg+20180622030616285.jpg', 5, 8, 1);

-- --------------------------------------------------------

--
-- 表的结构 `shoucangjia`
--

CREATE TABLE `shoucangjia` (
  `id` int(20) NOT NULL COMMENT 'AUTO_INCREMENT',
  `shangpinid` int(20) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shoucangjia`
--

INSERT INTO `shoucangjia` (`id`, `shangpinid`, `username`) VALUES
(2, 1, 'hehe'),
(3, 2, 'hehe'),
(4, 3, 'hehe'),
(6, 1, 'pupu'),
(7, 6, 'pupu');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `touxiang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `touxiang`) VALUES
('hehe', '123456', 'hehe@haha.com', '20180612074201469.jpg'),
('pupu', '123456', 'pupu@haha.com', '20180621031400575.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dadingdan`
--
ALTER TABLE `dadingdan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dingdan`
--
ALTER TABLE `dingdan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fenlei`
--
ALTER TABLE `fenlei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gouwuche`
--
ALTER TABLE `gouwuche`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `shangpinid` (`shangpinid`);

--
-- Indexes for table `guanggao`
--
ALTER TABLE `guanggao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinglun`
--
ALTER TABLE `pinglun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shangpin`
--
ALTER TABLE `shangpin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fenleiid` (`fenleiid`);

--
-- Indexes for table `shoucangjia`
--
ALTER TABLE `shoucangjia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `dingdan`
--
ALTER TABLE `dingdan`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=28;
--
-- 使用表AUTO_INCREMENT `fenlei`
--
ALTER TABLE `fenlei`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `gouwuche`
--
ALTER TABLE `gouwuche`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `guanggao`
--
ALTER TABLE `guanggao`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `pinglun`
--
ALTER TABLE `pinglun`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `shangpin`
--
ALTER TABLE `shangpin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `shoucangjia`
--
ALTER TABLE `shoucangjia`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=8;
--
-- 限制导出的表
--

--
-- 限制表 `gouwuche`
--
ALTER TABLE `gouwuche`
  ADD CONSTRAINT `gouwuche_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `gouwuche_ibfk_2` FOREIGN KEY (`shangpinid`) REFERENCES `shangpin` (`id`);

--
-- 限制表 `shangpin`
--
ALTER TABLE `shangpin`
  ADD CONSTRAINT `shangpin_ibfk_1` FOREIGN KEY (`fenleiid`) REFERENCES `fenlei` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
