-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-05-20 13:30:53
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electivesystem`
--

-- --------------------------------------------------------

--
-- 表的结构 `college`
--

CREATE TABLE `college` (
  `CollegeNo` char(10) NOT NULL,
  `CollegeName` char(20) NOT NULL,
  `Part` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `college`
--

INSERT INTO `college` (`CollegeNo`, `CollegeName`, `Part`) VALUES
('05', '文学院', '主校区'),
('04', '体育与健康学院', '主校区'),
('03', '教育科学学院', '主校区'),
('02', '政法学院、知识产权学院', '主校区'),
('01', '经济与管理学院', '主校区'),
('06', '外国语学院', '主校区'),
('07', '数学与统计学院', '主校区'),
('08', '生命科学学院', '主校区'),
('09', '机械与汽车工程学院', '主校区'),
('10', '电子与电气工程学院', '主校区'),
('11', '计算机科学与软件学院、大数据学院', '主校区'),
('12', '环境与化学工程学院', '主校区'),
('13', '食品与制药工程学院', '主校区'),
('14', '旅游与历史文化学院', '主校区'),
('15', '音乐学院', '主校区'),
('16', '美术学院', '主校区'),
('17', '马克思主义学院', '主校区'),
('18', '教师教育学院', '主校区'),
('19', '中德设计学院', '主校区');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE `course` (
  `CouNo` int(10) NOT NULL,
  `CouName` char(20) NOT NULL,
  `TeaNo` int(10) NOT NULL,
  `TeaName` char(10) NOT NULL,
  `ChooseNum` int(10) NOT NULL DEFAULT '0',
  `LimitNum` int(10) NOT NULL,
  `Credit` char(2) NOT NULL,
  `SchoolTime` char(10) NOT NULL,
  `Location` char(10) NOT NULL,
  `ClassHour` char(10) NOT NULL,
  `ExpHour` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`CouNo`, `CouName`, `TeaNo`, `TeaName`, `ChooseNum`, `LimitNum`, `Credit`, `SchoolTime`, `Location`, `ClassHour`, `ExpHour`) VALUES
(1, '哲学与人生', 1, 'teacher1', 3, 120, '2', '星期二晚,9-10节', '2-403', '32', '0'),
(2, '数学文化', 2, 'teacher2', 1, 1, '2', '星期二晚,9-10节', '2-405', '32', '0'),
(30, '团队建设', 3, 'teacher3', 1, 120, '2', '星期一晚，9-10节', '2-216', '32', '0'),
(31, '幸福心理学', 4, 'teacher4', 1, 1, '2', '星期二晚，9-10节', '2-201', '40', '0'),
(32, '宗教与文化', 5, 'teacher5', 0, 120, '2', '星期三晚，9-10节', '2-204', '32', '0'),
(33, '经济学智慧', 6, 'teacher6', 1, 10, '2', '星期四晚，9-10节', '2-402', '32', '0'),
(34, '生命伦理学', 7, 'teacher7', 0, 120, '2', '星期四晚，9-10节', '2-416', '32', '0'),
(35, '中国古代诗词赏析', 8, 'teacher8', 0, 120, '2', '星期二晚，9-10节', '3-301', '32', '0'),
(36, '现代西方文学赏析', 9, 'teacher9', 0, 120, '2', '星期二晚，9-10节', '3-308', '32', '0'),
(37, '通信技术与社会进步', 10, 'teacher10', 0, 120, '2', '星期一晚，9-10节', '2-515', '32', '0'),
(38, '人体与健康', 11, 'teacher11', 0, 120, '2', '星期一晚，9-10节', '2-516', '40', '0');

-- --------------------------------------------------------

--
-- 表的结构 `major`
--

CREATE TABLE `major` (
  `CollegeNo` int(10) NOT NULL,
  `MajorName` char(20) NOT NULL,
  `MajorNo` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `major`
--

INSERT INTO `major` (`CollegeNo`, `MajorName`, `MajorNo`) VALUES
(1, '国际经济与贸易', '001'),
(10, '通信工程', '002');

-- --------------------------------------------------------

--
-- 表的结构 `manager`
--

CREATE TABLE `manager` (
  `ManNo` int(10) NOT NULL,
  `ManName` char(20) NOT NULL,
  `Pwd` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `manager`
--

INSERT INTO `manager` (`ManNo`, `ManName`, `Pwd`) VALUES
(33, 'manager', '33');

-- --------------------------------------------------------

--
-- 表的结构 `stucou`
--

CREATE TABLE `stucou` (
  `CouNo` int(10) NOT NULL,
  `StuNo` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `stucou`
--

INSERT INTO `stucou` (`CouNo`, `StuNo`) VALUES
(1, 1),
(1, 2),
(1, 3),
(30, 2),
(31, 1),
(33, 2);

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE `student` (
  `StuNo` int(12) NOT NULL,
  `StuName` char(10) NOT NULL,
  `Pwd` char(15) NOT NULL,
  `CollegeNo` char(10) NOT NULL,
  `MajorName` char(20) NOT NULL,
  `Sex` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`StuNo`, `StuName`, `Pwd`, `CollegeNo`, `MajorName`, `Sex`) VALUES
(1, 'student1', '0001', '01', '国际经济与贸易', '女'),
(31, 'student31', '0031', '10', '通信工程', '男'),
(30, 'student30', '0030', '10', '通信工程', '男'),
(29, 'student29', '0029', '10', '通信工程', '男'),
(28, 'student28', '0028', '10', '通信工程', '男'),
(27, 'student27', '0027', '10', '通信工程', '男'),
(26, 'student26', '0026', '10', '通信工程', '男'),
(25, 'student25', '0025', '10', '通信工程', '男'),
(24, 'student24', '0024', '10', '通信工程', '男'),
(23, 'student23', '0023', '10', '通信工程', '男'),
(22, 'student22', '0022', '10', '通信工程', '男'),
(21, 'student21', '0021', '10', '通信工程', '男'),
(20, 'student20', '0020', '10', '通信工程', '男'),
(19, 'student19', '0019', '10', '通信工程', '男'),
(18, 'student18', '0018', '10', '通信工程', '男'),
(17, 'student17', '0017', '10', '通信工程', '男'),
(16, 'student16', '0016', '10', '通信工程', '男'),
(15, 'student15', '0015', '10', '通信工程', '男'),
(14, 'student14', '0014', '10', '通信工程', '男'),
(13, 'student13', '0013', '10', '通信工程', '男'),
(12, 'student12', '0012', '10', '通信工程', '男'),
(11, 'student11', '0011', '10', '通信工程', '男'),
(10, 'student10', '0010', '10', '通信工程', '男'),
(9, 'student9', '0009', '10', '通信工程', '男'),
(8, 'student8', '0008', '10', '通信工程', '男'),
(7, 'student7', '0007', '10', '通信工程', '男'),
(6, 'student6', '0006', '10', '通信工程', '男'),
(5, 'student5', '0005', '10', '通信工程', '男'),
(4, 'student4', '0004', '10', '通信工程', '男'),
(3, 'student3', '0003', '10', '通信工程', '男'),
(32, 'student32', '0032', '10', '通信工程', '男'),
(33, 'student33', '0033', '10', '通信工程', '女'),
(34, 'student34', '0034', '10', '通信工程', '男'),
(35, 'student35', '0035', '10', '通信工程', '女'),
(36, 'student36', '0036', '10', '通信工程', '男'),
(37, 'student37', '0037', '10', '通信工程', '女'),
(38, 'student38', '0038', '10', '通信工程', '男'),
(39, 'student39', '0039', '10', '通信工程', '女'),
(40, 'student40', '0040', '10', '通信工程', '男'),
(41, 'student41', '0041', '10', '通信工程', '女'),
(42, 'student42', '0042', '10', '通信工程', '男'),
(43, 'student43', '0043', '10', '通信工程', '女'),
(44, 'student44', '0044', '10', '通信工程', '男'),
(45, 'student45', '0045', '10', '通信工程', '女'),
(46, 'student46', '0046', '10', '通信工程', '男'),
(47, 'student47', '0047', '10', '通信工程', '女'),
(48, 'student48', '0048', '10', '通信工程', '男'),
(49, 'student49', '0049', '10', '通信工程', '女'),
(50, 'student50', '0050', '10', '通信工程', '男'),
(51, 'student51', '0051', '10', '通信工程', '女'),
(52, 'student52', '0052', '10', '通信工程', '男'),
(53, 'student53', '0053', '10', '通信工程', '女'),
(54, 'student54', '0054', '10', '通信工程', '男'),
(55, 'student55', '0055', '10', '通信工程', '女'),
(56, 'student56', '0056', '10', '通信工程', '男'),
(57, 'student57', '0057', '10', '通信工程', '女'),
(58, 'student58', '0058', '10', '通信工程', '男'),
(59, 'student59', '0059', '10', '通信工程', '女'),
(60, 'student60', '0060', '10', '通信工程', '男'),
(2, 'student2', '0002', '10', '通信工程', '女'),
(61, 'student61', '0061', '10', '通信工程', '男'),
(62, 'student62', '0062', '10', '通信工程', '女'),
(63, 'student63', '0063', '10', '通信工程', '男'),
(64, 'student64', '0064', '10', '通信工程', '女'),
(65, 'student65', '0065', '10', '通信工程', '男'),
(66, 'student66', '0066', '10', '通信工程', '女'),
(67, 'student67', '0067', '10', '通信工程', '男'),
(68, 'student68', '0068', '10', '通信工程', '女'),
(69, 'student69', '0069', '10', '通信工程', '男'),
(70, 'student70', '0070', '10', '通信工程', '女'),
(71, 'student71', '0071', '10', '通信工程', '男'),
(72, 'student72', '0072', '10', '通信工程', '女'),
(73, 'student73', '0073', '10', '通信工程', '男'),
(74, 'student74', '0074', '10', '通信工程', '女'),
(75, 'student75', '0075', '10', '通信工程', '男'),
(76, 'student76', '0076', '10', '通信工程', '女'),
(77, 'student77', '0077', '10', '通信工程', '男'),
(78, 'student78', '0078', '10', '通信工程', '女'),
(79, 'student79', '0079', '10', '通信工程', '男'),
(80, 'student80', '0080', '10', '通信工程', '女'),
(81, 'student81', '0081', '10', '通信工程', '男'),
(82, 'student82', '0082', '10', '通信工程', '女'),
(83, 'student83', '0083', '10', '通信工程', '男'),
(84, 'student84', '0084', '10', '通信工程', '女'),
(85, 'student85', '0085', '10', '通信工程', '男'),
(86, 'student86', '0086', '10', '通信工程', '女'),
(87, 'student87', '0087', '10', '通信工程', '男'),
(88, 'student88', '0088', '10', '通信工程', '女'),
(89, 'student89', '0089', '10', '通信工程', '男');

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE `teacher` (
  `TeaNo` int(10) NOT NULL,
  `TeaName` char(10) NOT NULL,
  `Pwd` char(15) NOT NULL,
  `CollegeNo` char(10) NOT NULL,
  `CollegeName` char(10) NOT NULL,
  `Introduction` varchar(200) DEFAULT '''''',
  `Sex` char(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`TeaNo`, `TeaName`, `Pwd`, `CollegeNo`, `CollegeName`, `Introduction`, `Sex`) VALUES
(1, 'teacher1', '1', '01', '国际贸易与经济学院', '我是teacher这个人很懒，什么都没有留下', '女'),
(2, 'teacher2', '2', '10', '电子与电气工程学院', '这个人很懒，什么都没有留下', '男'),
(3, 'teacher3', '3', '10', '电子与电气工程学院', '', '男'),
(4, 'teacher4', '4', '10', '电子与电气工程学院', '', '女'),
(5, 'teacher5', '5', '10', '电子与电气工程学院', '', '男'),
(6, 'teacher6', '6', '10', '电子与电气工程学院', '', '女'),
(7, 'teacher7', '7', '10', '电子与电气工程学院', '', '男'),
(8, 'teacher8', '8', '10', '电子与电气工程学院', '', '女'),
(9, 'teacher9', '9', '10', '电子与电气工程学院', '', '男'),
(10, 'teacher10', '10', '10', '电子与电气工程学院', '', '女'),
(11, 'teacher11', '11', '10', '电子与电气工程学院', '', '男'),
(12, 'teacher12', '12', '10', '电子与电气工程学院', '', '女'),
(13, 'teacher13', '13', '10', '电子与电气工程学院', '', '男'),
(14, 'teacher14', '14', '10', '电子与电气工程学院', '', '女'),
(15, 'teacher15', '15', '10', '电子与电气工程学院', '', '男'),
(16, 'teacher16', '16', '10', '电子与电气工程学院', '', '女'),
(17, 'teacher17', '17', '10', '电子与电气工程学院', '', '男'),
(18, 'teacher18', '18', '10', '电子与电气工程学院', '', '女'),
(19, 'teacher19', '19', '10', '电子与电气工程学院', '', '男'),
(20, 'teacher20', '20', '10', '电子与电气工程学院', '', '女'),
(21, 'teacher21', '21', '10', '电子与电气工程学院', '', '男'),
(22, 'teacher22', '22', '10', '电子与电气工程学院', '', '女'),
(23, 'teacher23', '23', '10', '电子与电气工程学院', '', '男'),
(24, 'teacher24', '24', '10', '电子与电气工程学院', '', '女'),
(25, 'teacher25', '25', '10', '电子与电气工程学院', '', '男'),
(26, 'teacher26', '26', '10', '电子与电气工程学院', '', '女'),
(27, 'teacher27', '27', '10', '电子与电气工程学院', '', '男'),
(28, 'teacher28', '28', '10', '电子与电气工程学院', '', '女'),
(29, 'teacher29', '29', '10', '电子与电气工程学院', '', '男'),
(30, 'teacher30', '30', '10', '电子与电气工程学院', '', '女'),
(31, 'teacher31', '31', '10', '电子与电气工程学院', '', '男'),
(32, 'teacher32', '32', '10', '电子与电气工程学院', '', '女'),
(33, 'teacher33', '33', '10', '电子与电气工程学院', '', '男'),
(34, 'teacher34', '34', '10', '电子与电气工程学院', '', '女'),
(35, 'teacher35', '35', '10', '电子与电气工程学院', '', '男'),
(36, 'teacher36', '36', '10', '电子与电气工程学院', '', '女'),
(37, 'teacher37', '37', '10', '电子与电气工程学院', '', '男'),
(38, 'teacher38', '38', '10', '电子与电气工程学院', '', '女'),
(39, 'teacher39', '39', '10', '电子与电气工程学院', '', '男'),
(40, 'teacher40', '40', '10', '电子与电气工程学院', '', '女'),
(41, 'teacher41', '41', '10', '电子与电气工程学院', '', '男'),
(42, 'teacher42', '42', '10', '电子与电气工程学院', '', '女'),
(43, 'teacher43', '43', '10', '电子与电气工程学院', '', '男'),
(44, 'teacher44', '44', '10', '电子与电气工程学院', '', '女');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`CollegeNo`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CouNo`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`CollegeNo`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`ManNo`);

--
-- Indexes for table `stucou`
--
ALTER TABLE `stucou`
  ADD PRIMARY KEY (`CouNo`,`StuNo`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StuNo`),
  ADD KEY `ClassNo` (`MajorName`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TeaNo`),
  ADD KEY `DepartNo` (`CollegeNo`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `course`
--
ALTER TABLE `course`
  MODIFY `CouNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
