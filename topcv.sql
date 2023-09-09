-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 09, 2023 lúc 05:30 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `topcv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminPass`, `adminUser`, `level`) VALUES
(1, 'Nam Nghiem', 'master@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'master', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_advertisement`
--

CREATE TABLE `tbl_advertisement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `adminId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_advertisement`
--

INSERT INTO `tbl_advertisement` (`id`, `title`, `description`, `image`, `adminId`) VALUES
(4, 'Shopping for Fpt Shop 1', 'Recruiter for all company 1', '23968a2b7f.png', 1),
(5, 'Mobiphone', 'All day all time', '3518b58d81.jpg', 1),
(6, 'Viettel', 'Java Developer', 'f958c1fb0f.jpg', 1),
(7, 'Shoppe', 'Sale and Marketting', '1461105d7b.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `bannerId` int(11) NOT NULL,
  `bannerImage` varchar(255) NOT NULL,
  `bannerDescription` text NOT NULL,
  `adminId` int(11) NOT NULL,
  `bannerTitle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_banner`
--

INSERT INTO `tbl_banner` (`bannerId`, `bannerImage`, `bannerDescription`, `adminId`, `bannerTitle`) VALUES
(1, '2b780a40bd.png', 'Crafting a compelling job description is essential to helping you attract the most qualified candidates for your job. With more than 25 million jobs listed on Indeed', 1, 'Find The Perfect Job That You Desrved'),
(3, '59fe877b70.jpg', 'It is a very effective solution to better understand yourself and others to build strong working relationships.', 1, 'Rocket Start - Express CV Writing 2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(2, 'Java Developer'),
(3, 'Photographer'),
(4, 'Tester'),
(5, 'Project Manager');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_company`
--

CREATE TABLE `tbl_company` (
  `companyId` int(11) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `companyPhone` varchar(10) NOT NULL,
  `companyEmail` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_company`
--

INSERT INTO `tbl_company` (`companyId`, `companyName`, `description`, `image`, `companyPhone`, `companyEmail`, `userId`) VALUES
(1, 'Mobiphone Company', 'Vì một tương lai phát triển của giới trẻ việt nam', '23968a2b7f.png', '0987654321', 'mobiphone@software.com', 4),
(2, 'Asus Company', 'Vì một tương lai phát triển của giới trẻ việt nam', '5ca5dbf503.jpg', '0987789987', 'asus.contact@gmail.com', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cv`
--

CREATE TABLE `tbl_cv` (
  `cvId` int(11) NOT NULL,
  `cvTitle` varchar(255) NOT NULL,
  `cvFile` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `isEnable` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cv`
--

INSERT INTO `tbl_cv` (`cvId`, `cvTitle`, `cvFile`, `userId`, `isEnable`) VALUES
(2, 'Java Senior', '997e6d46a3.pdf', 1, b'1'),
(3, 'Junior Java Developer', 'b00879615e.pdf', 1, b'0'),
(4, 'Java Internal', '550551f689.pdf', 5, b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_job`
--

CREATE TABLE `tbl_job` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type_of_cv` varchar(150) NOT NULL,
  `level` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `min_salary` decimal(10,0) NOT NULL,
  `max_salary` decimal(10,0) NOT NULL,
  `description` varchar(255) NOT NULL,
  `require_job` varchar(255) NOT NULL,
  `welfare` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `companyId` int(11) NOT NULL,
  `deadline` date NOT NULL,
  `status` bit(1) NOT NULL,
  `is_approve` bit(1) NOT NULL,
  `is_remove` bit(1) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_job`
--

INSERT INTO `tbl_job` (`id`, `title`, `type_of_cv`, `level`, `address`, `min_salary`, `max_salary`, `description`, `require_job`, `welfare`, `language`, `userId`, `categoryId`, `companyId`, `deadline`, `status`, `is_approve`, `is_remove`, `time`) VALUES
(1, 'Java Developer ', 'PDF', 'Junior', 'Quận 10, Hoàn Kiếm, Hà Nội', 10000, 1000000, 'Công việc ưu đãi', 'Công việc ưu đãi', 'Công việc ưu đãi', 'Tiếng Việt', 4, 2, 1, '2023-08-31', b'0', b'1', b'0', 'Full Time'),
(2, 'Junior Java Developer', 'PDF', 'Junior Java Developer', 'Yen Nghia - Ha Dong', 10000, 100000, 'Tạo database cho phần booking và api tư vấn nâng độ', '1 năm kinh nghiệm về java', 'Có lương đầy đủ 12 tháng', 'Tiếng Việt', 4, 3, 1, '2023-09-30', b'0', b'1', b'0', 'Full Time'),
(3, 'Junior Java Developer', 'PDF', 'Data Analyst', 'Yen Nghia - Ha Dong', 10000, 100000, 'Tạo database cho phần booking và api tư vấn nâng độ', '1 năm kinh nghiệm về java', 'Có lương đầy đủ 12 tháng', 'Tiếng Việt', 4, 3, 1, '2023-09-30', b'0', b'1', b'1', 'Full Time'),
(4, 'Sale Management', 'PDF', 'Junior', 'Yen Nghia - Ha Dong', 100000, 1000000, 'Tìm hiểu về các api investigate get car theo user và tư vấn nâng xe', '1 năm kinh nghiệm về java', 'Có lương đầy đủ 12 tháng', 'Tiếng Việt', 4, 2, 1, '2023-09-09', b'0', b'1', b'0', 'Full Time'),
(5, 'Project Managent - Mobiphone Company', 'PDF', 'Junior', 'Yen Nghia - Ha Dong', 1000, 100000, 'Tạo database cho phần booking và api tư vấn nâng độ', '1 năm kinh nghiệm về java', 'Có lương đầy đủ 12 tháng', 'Tiếng Việt', 4, 5, 1, '2023-09-09', b'0', b'1', b'0', 'Part Time'),
(6, 'Photographer Management', 'PDF', 'Junior', 'Ung Hoa - Ha Noi', 10000, 100000, 'Tiếp sửa conflict của các nhánh mới merge và sửa lỗi của các ticket', '1 năm kinh nghiệm về nhiếp ảnh, có thể dùng và sử dụng được mọi loại máy ảnh', 'Có lương đầy đủ 12 tháng và 1 tháng lương thưởng. Hỗ trợ phụ cấp', 'Tiếng Việt', 4, 3, 1, '2023-09-29', b'0', b'1', b'0', 'Full Time'),
(7, 'Photographer', 'PDF', 'Junior', 'Yen Nghia - Ha Dong', 1000, 1000000, 'Tạo database cho phần booking và api tư vấn nâng độ', '1 năm kinh nghiệm về nhiếp ảnh, có thể dùng và sử dụng được mọi loại máy ảnh', 'Có lương đầy đủ 12 tháng và 1 tháng lương thưởng. Hỗ trợ phụ cấp', 'Tiếng Việt', 4, 3, 1, '2023-09-21', b'0', b'1', b'1', 'Full Time');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_jobstores`
--

CREATE TABLE `tbl_jobstores` (
  `id` int(11) NOT NULL,
  `jobId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `is_followed` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_jobstores`
--

INSERT INTO `tbl_jobstores` (`id`, `jobId`, `userId`, `is_followed`) VALUES
(1, 6, 1, b'1'),
(3, 5, 1, b'1'),
(4, 4, 1, b'1'),
(6, 2, 1, b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_recruitment`
--

CREATE TABLE `tbl_recruitment` (
  `id` int(11) NOT NULL,
  `cvId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL,
  `createdAt` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_recruitment`
--

INSERT INTO `tbl_recruitment` (`id`, `cvId`, `jobId`, `createdAt`, `userId`) VALUES
(3, 2, 5, '2023-09-03', 1),
(4, 4, 5, '2023-09-05', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adminId` int(11) NOT NULL,
  `level` bit(1) NOT NULL,
  `is_locked` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `name`, `email`, `phone`, `address`, `position`, `provider`, `provider_id`, `imageUrl`, `password`, `adminId`, `level`, `is_locked`) VALUES
(1, 'Nam Nghiêm', 'gasky2k1@gmail.com', '0972265535', 'Yen Nghia', '', '', '', '9922601376.jpg', '25f9e794323b453885f5181f1b624d0b', 1, b'0', b'0'),
(3, 'Hồ Văn Ngọc', 'namsky2k1@gmail.com', '', '', '', '', '', '23968a2b7f.png', '25d55ad283aa400af464c76d713c07ad', 1, b'0', b'0'),
(4, 'Son Nguyen Dinh', 'sonsky2k1@gmail.com', '0972265535', 'Yen Nghia - Ha Dong', 'HR', '', '', '4578e32a17.jpg', '25f9e794323b453885f5181f1b624d0b', 1, b'1', b'0'),
(5, 'Nam Gà', 'namsky1826@gmail.com', '0397507826', 'Phùng Khoang, Trung Văn', '', '', '', '31cda79700.png', '25d55ad283aa400af464c76d713c07ad', 1, b'0', b'0'),
(6, 'Offical Anime', 'animeoffical2k1@gmail.com', '', '', '', '', '', 'https://lh3.googleusercontent.com/a/ACg8ocI1JXqIkv8deBBXSylElJi9jApgnWf6LEDsLsU79enFyg=s96-c', '', 0, b'0', b'0'),
(7, 'Nam Nghiêm', 'dinhnamsaker@gmail.com', '', '', '', '', '', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1808048596296570&height=200&ext=1696792523&hash=AeQxLP7B941T0q5ecDg', '', 0, b'0', b'0');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_advertisement`
--
ALTER TABLE `tbl_advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`bannerId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`companyId`);

--
-- Chỉ mục cho bảng `tbl_cv`
--
ALTER TABLE `tbl_cv`
  ADD PRIMARY KEY (`cvId`);

--
-- Chỉ mục cho bảng `tbl_job`
--
ALTER TABLE `tbl_job`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_jobstores`
--
ALTER TABLE `tbl_jobstores`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_recruitment`
--
ALTER TABLE `tbl_recruitment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_advertisement`
--
ALTER TABLE `tbl_advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `bannerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `companyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_cv`
--
ALTER TABLE `tbl_cv`
  MODIFY `cvId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_job`
--
ALTER TABLE `tbl_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_jobstores`
--
ALTER TABLE `tbl_jobstores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_recruitment`
--
ALTER TABLE `tbl_recruitment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
