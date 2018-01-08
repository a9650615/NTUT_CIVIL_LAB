-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-12-29 14:09:43
-- 伺服器版本: 10.1.28-MariaDB
-- PHP 版本： 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `images`
--

CREATE TABLE `images` (
  `id` int(20) NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `images`
--

INSERT INTO `images` (`id`, `image`, `image_text`) VALUES
(1, 'fast-forward-sketched-arrows.png', '      '),
(2, '擷取.PNG', '      1231312313'),
(3, '擷取.PNG', '      1231312313'),
(4, '擷取.PNG', ''),
(5, '擷取.PNG', '      132313');

-- --------------------------------------------------------

--
-- 資料表結構 `iso列表`
--

CREATE TABLE `iso列表` (
  `id` int(11) NOT NULL,
  `1` varchar(30) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `iso列表`
--

INSERT INTO `iso列表` (`id`, `1`) VALUES
(1, '1.基地放樣是否正確'),
(2, '2.導溝放樣是否正確'),
(3, '3.導溝模板施工寬度，深度是否正確'),
(4, '4.導溝鋼筋號數，綁紮是否正確'),
(5, '5.舖面高程是否同設計高程'),
(6, '6.舖面配筋是否正確'),
(7, '7.穩定液池及棄土坑容積是否足夠'),
(8, '8.穩定液池及棄土坑模版高程、配筋是否正確'),
(9, '9.鋼筋作業台配置位置是否不影響它項作業'),
(10, '10.鋼筋作業台，寬度及長度是否足夠'),
(11, '11.洗車台是否有設置'),
(12, '12.各項機械運作動線是否正常'),
(13, '13.外導牆高程是否比內導牆高10cm以上');

-- --------------------------------------------------------

--
-- 資料表結構 `品質改善(前)`
--

CREATE TABLE `品質改善(前)` (
  `編號` int(20) NOT NULL,
  `改善前` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `現況說明` text COLLATE utf8_unicode_ci NOT NULL,
  `改善建議` text COLLATE utf8_unicode_ci NOT NULL,
  `查驗日期` date NOT NULL,
  `改善期限` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `工程檢查表`
--

CREATE TABLE `工程檢查表` (
  `工程編號` int(20) NOT NULL,
  `連續壁工程檢查表` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `工程檢查表`
--

INSERT INTO `工程檢查表` (`工程編號`, `連續壁工程檢查表`) VALUES
(101, 1),
(101, 4),
(102, 2),
(103, 3),
(103, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `工程資料`
--

CREATE TABLE `工程資料` (
  `工程編號` int(20) NOT NULL,
  `工程名稱` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `施工所主管姓名` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `檢查人員姓名` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `承包商名稱` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `工程資料`
--

INSERT INTO `工程資料` (`工程編號`, `工程名稱`, `施工所主管姓名`, `檢查人員姓名`, `承包商名稱`) VALUES
(101, '北科土木館', '王小明', '陳小華', '大大工程'),
(102, '北科百年館', '林小白', '黃小齊', '小小工程'),
(103, '北科設計館', '李小刀', '徐阿財', '中忠工程'),
(104, '北科中正館', '王小明', '江小城', '迷你工程');

-- --------------------------------------------------------

--
-- 資料表結構 `承包商資料`
--

CREATE TABLE `承包商資料` (
  `承包商編號` int(20) NOT NULL,
  `承包商名稱` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `公司電話` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `公司信箱` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `負責人姓名` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `負責人電話` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `承包商資料`
--

INSERT INTO `承包商資料` (`承包商編號`, `承包商名稱`, `公司電話`, `公司信箱`, `負責人姓名`, `負責人電話`) VALUES
(1, '大大工程', '02-2345758', 'big@gmail.com', '林大大', '0973147258'),
(2, '中中工程', '03-1472589', 'small@gmail.com', '蔡小小', '0912456789'),
(3, '小小工程', '02-14745688', 'mid@gmail.com', '劉中中', '0978456789');

-- --------------------------------------------------------

--
-- 資料表結構 `施工所主管資料`
--

CREATE TABLE `施工所主管資料` (
  `員工編號` int(20) NOT NULL,
  `姓名` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `電話` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `信箱` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `施工所主管資料`
--

INSERT INTO `施工所主管資料` (`員工編號`, `姓名`, `電話`, `信箱`) VALUES
(10112845, '王小明', '0912378945', 'abc@gmail.com'),
(10112846, '林小白', '0914785236', 'zxc@gmail.com'),
(10112847, '李小刀', '0977789456', 'asd@gmail.com');

-- --------------------------------------------------------

--
-- 資料表結構 `檢查人員資料`
--

CREATE TABLE `檢查人員資料` (
  `員工編號` int(20) NOT NULL,
  `姓名` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `電話` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `信箱` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `檢查人員資料`
--

INSERT INTO `檢查人員資料` (`員工編號`, `姓名`, `電話`, `信箱`) VALUES
(10112848, '陳小華', '0996123456', 'qwe@gmail.com'),
(10112849, '黃小琪', '0974123456', 'wer@gmail.com'),
(10112850, '徐阿財', '0985123456', 'ert@gmail.com');

-- --------------------------------------------------------

--
-- 資料表結構 `連續壁工程檢查表（假設工程）`
--

CREATE TABLE `連續壁工程檢查表（假設工程）` (
  `工程編號` int(20) NOT NULL,
  `連續壁檢查表編號` int(20) NOT NULL,
  `樓層` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `樓區` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `基地放樣是否正確` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `導溝放樣是否正確` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `導溝模板施工寬度，深度是否正確` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `導溝鋼筋號數，綁紮是否正確` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `舖面高程是否同設計高程` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `舖面配筋是否正確` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `穩定液池及棄土坑容積是否足夠` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `穩定液池及棄土坑模版高程、配筋是否正確` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `鋼筋作業台配置位置是否不影響它項作業` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `鋼筋作業台，寬度及長度是否足夠` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `洗車台是否有設置` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `各項機械運作動線是否正常` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `外導牆高程是否比內導牆高10cm以上` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `連續壁工程檢查表（假設工程）`
--

INSERT INTO `連續壁工程檢查表（假設工程）` (`工程編號`, `連續壁檢查表編號`, `樓層`, `樓區`, `基地放樣是否正確`, `導溝放樣是否正確`, `導溝模板施工寬度，深度是否正確`, `導溝鋼筋號數，綁紮是否正確`, `舖面高程是否同設計高程`, `舖面配筋是否正確`, `穩定液池及棄土坑容積是否足夠`, `穩定液池及棄土坑模版高程、配筋是否正確`, `鋼筋作業台配置位置是否不影響它項作業`, `鋼筋作業台，寬度及長度是否足夠`, `洗車台是否有設置`, `各項機械運作動線是否正常`, `外導牆高程是否比內導牆高10cm以上`) VALUES
(101, 1, '1樓', 'A區', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是'),
(102, 2, '1樓', 'B區', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是'),
(103, 3, '1樓', 'D區', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是'),
(101, 4, '2樓', 'E區', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是'),
(103, 5, '2樓', 'B區', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是', '是');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `iso列表`
--
ALTER TABLE `iso列表`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `品質改善(前)`
--
ALTER TABLE `品質改善(前)`
  ADD PRIMARY KEY (`編號`);

--
-- 資料表索引 `工程檢查表`
--
ALTER TABLE `工程檢查表`
  ADD PRIMARY KEY (`連續壁工程檢查表`) USING BTREE,
  ADD KEY `工程編號` (`工程編號`) USING BTREE;

--
-- 資料表索引 `工程資料`
--
ALTER TABLE `工程資料`
  ADD PRIMARY KEY (`工程編號`),
  ADD KEY `施工所主管` (`施工所主管姓名`),
  ADD KEY `工程編號` (`工程編號`) USING BTREE,
  ADD KEY `工程名稱` (`工程名稱`),
  ADD KEY `檢查人員姓名` (`檢查人員姓名`),
  ADD KEY `承包商名稱` (`承包商名稱`);

--
-- 資料表索引 `承包商資料`
--
ALTER TABLE `承包商資料`
  ADD PRIMARY KEY (`承包商編號`),
  ADD KEY `承包商編號` (`承包商編號`),
  ADD KEY `公司電話` (`公司電話`),
  ADD KEY `公司信箱` (`公司信箱`),
  ADD KEY `負責人姓名` (`負責人姓名`),
  ADD KEY `負責人電話` (`負責人電話`),
  ADD KEY `承包商名稱` (`承包商名稱`) USING BTREE;

--
-- 資料表索引 `施工所主管資料`
--
ALTER TABLE `施工所主管資料`
  ADD PRIMARY KEY (`員工編號`),
  ADD KEY `員工編號` (`員工編號`),
  ADD KEY `姓名` (`姓名`),
  ADD KEY `電話` (`電話`),
  ADD KEY `信箱` (`信箱`);

--
-- 資料表索引 `檢查人員資料`
--
ALTER TABLE `檢查人員資料`
  ADD PRIMARY KEY (`員工編號`),
  ADD KEY `員工編號` (`員工編號`),
  ADD KEY `姓名` (`姓名`),
  ADD KEY `電話` (`電話`),
  ADD KEY `信箱` (`信箱`);

--
-- 資料表索引 `連續壁工程檢查表（假設工程）`
--
ALTER TABLE `連續壁工程檢查表（假設工程）`
  ADD UNIQUE KEY `連續壁檢查表編號_2` (`連續壁檢查表編號`),
  ADD KEY `連續壁檢查表編號` (`連續壁檢查表編號`),
  ADD KEY `工程編號` (`工程編號`) USING BTREE,
  ADD KEY `基地放樣是否正確` (`基地放樣是否正確`),
  ADD KEY `基地放樣是否正確_2` (`基地放樣是否正確`,`導溝放樣是否正確`,`導溝模板施工寬度，深度是否正確`,`導溝鋼筋號數，綁紮是否正確`,`舖面高程是否同設計高程`,`舖面配筋是否正確`,`穩定液池及棄土坑容積是否足夠`,`穩定液池及棄土坑模版高程、配筋是否正確`,`鋼筋作業台配置位置是否不影響它項作業`,`鋼筋作業台，寬度及長度是否足夠`,`洗車台是否有設置`,`各項機械運作動線是否正常`,`外導牆高程是否比內導牆高10cm以上`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `images`
--
ALTER TABLE `images`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表 AUTO_INCREMENT `iso列表`
--
ALTER TABLE `iso列表`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表 AUTO_INCREMENT `品質改善(前)`
--
ALTER TABLE `品質改善(前)`
  MODIFY `編號` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `工程檢查表`
--
ALTER TABLE `工程檢查表`
  MODIFY `工程編號` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- 使用資料表 AUTO_INCREMENT `工程資料`
--
ALTER TABLE `工程資料`
  MODIFY `工程編號` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- 使用資料表 AUTO_INCREMENT `連續壁工程檢查表（假設工程）`
--
ALTER TABLE `連續壁工程檢查表（假設工程）`
  MODIFY `連續壁檢查表編號` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `工程檢查表`
--
ALTER TABLE `工程檢查表`
  ADD CONSTRAINT `工程檢查表_ibfk_1` FOREIGN KEY (`工程編號`) REFERENCES `連續壁工程檢查表（假設工程）` (`工程編號`),
  ADD CONSTRAINT `工程檢查表_ibfk_2` FOREIGN KEY (`連續壁工程檢查表`) REFERENCES `連續壁工程檢查表（假設工程）` (`連續壁檢查表編號`);

--
-- 資料表的 Constraints `工程資料`
--
ALTER TABLE `工程資料`
  ADD CONSTRAINT `工程資料_ibfk_1` FOREIGN KEY (`施工所主管姓名`) REFERENCES `施工所主管資料` (`姓名`);

--
-- 資料表的 Constraints `施工所主管資料`
--
ALTER TABLE `施工所主管資料`
  ADD CONSTRAINT `施工所主管資料_ibfk_1` FOREIGN KEY (`姓名`) REFERENCES `工程資料` (`施工所主管姓名`);

--
-- 資料表的 Constraints `連續壁工程檢查表（假設工程）`
--
ALTER TABLE `連續壁工程檢查表（假設工程）`
  ADD CONSTRAINT `連續壁工程檢查表（假設工程）_ibfk_1` FOREIGN KEY (`工程編號`) REFERENCES `工程資料` (`工程編號`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
