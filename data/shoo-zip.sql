-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 22, 2022 lúc 08:34 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoo-zip`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`) VALUES
(1, 'nam', 'nam@gmail.com', 'nam53', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `type` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) UNSIGNED NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(15, 'Thực Phẩm Chức Năng'),
(16, 'Set MINI'),
(17, 'Ohui Age Recovery Chống Nhăn'),
(18, 'Ohui Day Shield Chống Nắng'),
(19, 'Ohui Extreme White Dưỡng Trắng'),
(20, 'Ohui Make Up Trang Điểm'),
(21, 'Dầu Gội Dầu Xả'),
(22, 'Sulwhasoo Chống Lão Hóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `repassword` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `fname`, `lname`, `account`, `password`, `repassword`, `email`, `address`, `phone`) VALUES
(4, 'Nguyễn ', 'Nam', 'namnguyen123', '51416118072e894072c6e79857b054a0', '51416118072e894072c6e79857b054a0', 'nam@gmail.com', 'Trường ĐHCN Thái Nguyên - Tp.Thái Nguyên - Thái Nguyên', '0332165110'),
(5, 'Nguyễn', 'Hùng', 'hung123', '51416118072e894072c6e79857b054a0', '51416118072e894072c6e79857b054a0', 'hung@gmail.com', 'Trường ĐHCN Thái Nguyên - Tp.Thái Nguyên - Thái Nguyên', '0123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `text_history` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `text_history`) VALUES
(11, 'Thực'),
(37, 'nước');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_historybuy`
--

CREATE TABLE `tbl_historybuy` (
  `idHistoryBuy` int(11) UNSIGNED NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `dateBuy` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_historybuy`
--

INSERT INTO `tbl_historybuy` (`idHistoryBuy`, `productId`, `customer_id`, `type`, `quantity`, `totalPrice`, `dateBuy`) VALUES
(19, 53, 5, 1, 3, 3888000, '2022-01-22 07:00:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `dayOrder` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `productId`, `customer_id`, `quantity`, `type`, `price`, `status`, `dayOrder`) VALUES
(67, 53, 5, 3, 1, 3888000, 2, '2022-01-22 07:00:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) UNSIGNED NOT NULL,
  `proImg` varchar(255) NOT NULL,
  `prodesc` text NOT NULL,
  `sale` int(11) NOT NULL,
  `priceNew` int(11) NOT NULL,
  `proS` int(255) NOT NULL,
  `proB` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `proImg`, `prodesc`, `sale`, `priceNew`, `proS`, `proB`) VALUES
(12, 'Thực phẩm chức năng SLIMMING CODE DIET ALL IN ONE CUT Cissus', 15, 'e5d54534c1.jpeg', 'Slimming Code Diet All In One Cut Cissus là thực phẩm bổ sung cung cấp chế độ ăn kiêng dễ dàng và an toàn bằng cách điều chỉnh hệ thống nội tiết tố bị mất căng do chế độ ăn kiêng thường xuyên hoặc ăn uống quá độ. Ngoài ra, sản phẩm còn chứa đựng hệ thống thành phần nổi bật chăm sóc các hoocmon béo phì.\r\n\r\nChiết xuất lá bằng lăng chăm sóc hoocmon Insullin – điều hóa đường huyết\r\nChiết xuất hạt xoài chăm sóc hoocmon Leptin – kiểm s oát sự thèm ăn\r\nL-Theamine chiết xuất từ lá trà xanh chăm sóc hoocmon Cortisol - xoa dịu và giải tỏa căng thẳng\r\n\r\nĐặc biệt sản phẩm còn chứa chiết xuất Cây chìa vôi bốn cạnh – nguyên liệu giảm cân được thừa nhận hiệu năng vượt trội, loại bỏ mỡ và tăng khả năng chăm sóc hoocmon gây thừa cân, béo phì.\r\n\r\nSlimming Code Diet All In One Cut Cissus sẽ mang lại cho bạn một liệu trình giảm cân khỏe mạnh và hạnh phúc cùng với các thành phần chiết xuất từ thiên nhiên và cách dùng đơn giản khi chỉ cần uống 1 viên / ngày giúp giảm cân và kiểm soát mỡ cơ thể cũng như duy trì một dáng người gọn gàng, thon thả.', 10, 3500000, 125, 34),
(13, 'Thực phẩm chức năng Super Omega 3 DHA 95', 15, '8f471d597c.jpeg', 'Super Omega 3 DHA 95 - thực phẩm vì sức khỏe!!!\r\n\r\nOmega-3 còn cần thiết cho hoạt động của não bộ. Một nghiên cứu tại Pháp cho thấy, bổ sung omega-3 giảm bớt 80% tổn thương các tế bào thần kinh do động kinh hay ngừng tim. Vì 60% khối lượng não được cấu tạo bằng lipid và hơn 70% lipid ở não là axít béo omega-3, do vậy omega-3 có vai trò quan trọng với não bộ. Nó có thể ngăn ngừa bệnh Alzheimer, kháng trầm cảm...\r\n\r\nSuper Omega 3 DHA 95 - thực phẩm bổ sung cao cấp chứa Omega(DHA và EDA) từ Na Uy, kết hợp cùng vitamin E giúp chăm sóc tuần hoàn máu và cải thiện sức khỏe não bộ. Sản phẩm phù hợp với mọi thành viên trong gia đình\r\n\r\nDung tích : 750mg x 45 viên x 2 hộp.\r\n\r\n', 12, 2800000, 79, 79),
(14, 'Thực phẩm chức năng Hồng sâm Jinhyosam Jin', 15, '4fa1cf4185.jpg', 'Jinhyosam Jin - Sản phẩm chăm sóc sức khỏe thượng hạng, hàm chứa bổ dược hàng đầu từ nhân sâm toàn thảo, hồng sâm lên men đến nguyên liệu hồi phục nguyên khí cho hoàng đế.\r\n\r\nThành phần : chính Hồng sâm và nhân sâm toàn thảo (thân, quả và lá) kết hợp phương pháp lên men độc quyền của LG tăng tỷ lệ hấp thụ trong cơ thể 37 lần giúp tăng cường sức đề kháng, chống oxy hóa, ngăn ngừa các dấu hiệu lão hóa, phòng chống ung thư và ngăn chặn sự phát triển tế bào ung thư, cải thiện trí nhớ,…\r\nNâng cao khả năng miễn dịch nhờ nấm linh chi sừng hươu và bái pháp đông y truyền thống\r\n   Nấm linh chi sừng hươu có thành phần chống ung thư beta glucan cao gấp 3 lần so với nấm linh chi thông thường giúp nân cao khả năng miễn dịch cho cơ thể\r\nKết hợp thêm bí pháp Đông y truyền thống bổ sung thêm Quỳnh Ngọc Cao (nhân sâm, mật ong, bạch phục linh, địa hoàng) và Cống thần đơn (lộc nhung lên men, trầm hương, sơn thù du, đương quy) nâng cao hiệu quả\r\n    Bổ sung bài thuốc Jinhyo Bổ Khí Phương:\r\nTăng cường bổ khí cho hồng sâm để cảm nhận hiệu quả hồng sâm nhanh chóng và hiệu quả\r\nTăng cường miễn dịch, kháng viêm và chống dị ứng, tăng hiệu quả chống Oxy hóa, kháng khuẩn\r\n  Sản phẩm hồng sâm dạng lỏng, cải thiện vị đắng mà vẫn giữ được hương vị độc đáo của hồng sâm\r\n\r\nDung tích : 60ml x 30 gói\r\n\r\nLưu ý: ohuivietnam.com  phân phối hàng chính hãng được nhập khẩu bởi LG Vina Cosmetic. Mọi sản phẩm hàng bán đều có tem bạc chống hàng giả và tem niêm phong của LG Vina Cosmetic.\r\nRiêng với hàng khuyến mại ( Not for sale) thì chỉ có tem niêm phong sản phẩm.\r\nCác sản phẩm phấn và son thì chỉ có tem bạc và không được niêm phong để khách hàng có thể kiểm tra và xem màu.', 5, 5500000, 104, 39),
(15, 'Bộ dưỡng Whoo Hwan Yu Hoàn lưu Cao mini 5 pcs trẻ hóa da 10 năm tuổi', 16, 'fb1c0a8818.jpg', 'Bộ sản phẩm dưỡng da phục hồi 5 món The History of Whoo thuộc dòng sản phẩm Hoàn lưu cao của thương hiệu mỹ phẩm đình đám Whoo. Được biết đến như một bí kíp phục hồi làn da lão hóa, các thành phần trong bộ sản phẩm giúp nuôi dưỡng, tái tạo làn da từ bên trong, trả lại cho da vẻ rạng rỡ, mịn màng, căng tràn sức sống\r\n\r\nBộ Hoàn Lưu Cao Whoo Hwan Yu gồm 5 món:\r\n\r\n1. Hwanyu Go Imperial Youth Cream (4ml) – kem dưỡng:Với hơn 70 thành phần Đông y quý hiếm có thể nhắc đến như sen tuyết và sâm núi được chắt lọc và bảo quản nghiêm ngặt cùng công nghệ sản xuất hiện đại, sản phẩm giúp xóa mờ các dấu vết thời gian trên làn da chị em.\r\n\r\n2. Hwanyu Imperial Youth Eye Cream (4ml) – kem dưỡng mắt: sen tuyết thu thập từ tháng 7,8 kết hợp với sâm núi 35 tuổi của tỉnh Gangwon và một số thành phần thảo dược khác sản xuất ra Hwanyu Dongan Go. Sản phẩm giúp làm mờ các vết nhăn trên vùng mắt, cải thiện sự trao đổi chất và giúp vùng mắt rạng rỡ hơn.\r\n\r\n3. Hwanyu Imperial Youth Essence (7ml) – tinh dầu: Tinh dầu được bổ sung thêm đơn thuốc bát trấn bổ tinh đơn phối hợp với các thành phần thảo dược khác, khi kết hợp sử dụng cùng Hwanyu Go sẽ tạo ra được sự cân bằng, giúp da được hấp thụ một cách tối đa các dưỡng chất có trong sản phẩm.\r\n\r\n4.Tinh chất vàng (7ml )  từ nhân sâm núi tự nhiên , giúp khơi nguồn năng lượng , đưa làn da trở về trang thái lý tưởng nhất , giúp giải quyết toàn bộ các vấn đề da.\r\n\r\n5. Tinh chất khởi đầu ( 15ml )  chứa hơn 70 thành phần đông y hoàn thiện nền tảng da khỏe mạnh đưa làn da về trạng thái lý tưởng để hấp thụ hiệu năng tuyệt vời của sản phẩm.  \r\n\r\nTặng thêm : Sample tẩy da chết ', 50, 2200000, 115, 201),
(16, 'Bộ Dưỡng Ẩm Chống Lão Hoá Whoo Gongjinhyang Soo Hydrating 5Pcs', 16, '3e0893685b.jpg', 'Bộ Dưỡng Ẩm Chống Lão Hoá Gongjinhyang Soo Hydrating 5Pcs\r\n\r\nBộ dưỡng da kết hợp giữa 2 dòng sản phẩm cao cấp của Whoo đó là Whoo hồng dưỡng ẩm, trắng da và Bichup chống lão hóa. Mang lại một trải nghiệm hoàn toàn mới mẻ.\r\n\r\nVới công thức bí truyền làm đẹp từ hoàng cung, sản phẩm Whoo hồng không chỉ bổ sung nước cho làn da khô mà còn giúp làm dịu da nhạy cảm đồng thời giúp cân bằng lượng dầu và nước trên da giúp kiểm soát tình trạng bóng nhờn của làn da dầu, mang đến cho bạn làn da tươi sáng, mịn màng, trẻ trung và trắng hồng rạng rỡ.\r\n\r\nBộ Sản Phẩm Bao Gồm:\r\n\r\n1 - Nước hoa hồng Whoo hồng (Whoo Hydrating Balancer) 20ml.\r\n\r\n2 - Sữa dưỡng ẩm Whoo hồng (Whoo Hydrating Emulsion) 20ml.\r\n\r\n3 - Tinh chất tái sinh chống lão hoá Whoo Bichup (First Care Moisture Anti-Aging Essence) 15ml.\r\n\r\n4 - Tinh chất tự nhuận chống lão hóa Whoo Bichup (Self-Generating Anti-Aging Essence) 8ml.\r\n\r\n5 - Kem dưỡng ẩm trắng da Whoo hồng (Whoo Hydrating Cream) 4ml.\r\n\r\n \r\n\r\n- Thu nhỏ lỗ chân lông.\r\n\r\n- Giúp da đều màu hơn và da sáng dần theo thời gian.\r\n\r\n- Giúp da mềm mại và mịn màng hơn, đồng thời hạn chế nếp nhăn và làm chậm quá trình lão hóa da do tuổi tác và những tác động xấu từ môi trường bên ngoài.\r\n\r\n- Giảm mụn và sự sưng tấy của mụn.', 10, 850000, 555, 101),
(17, 'Cặp nước hoa hồng sữa dưỡng Whoo Cheonyuldan 2pcs', 16, '21a115ccda.jpg', 'Whoo Cheonyuldan Ultimate Rejuvenating cải thiện đường nét gương mặt, khẳng định sự tuyệt đỉnh trong kỹ thuật bào chế của Whoo với các thành phần hiệu năng được dẫn truyền sâu trong da, tăng độ đàn hồi và tái tạo da, cho cảm nhận đường nét gương mặt thanh tú sáng mịn tươi trẻ chỉ sau 4 tuần sử dụng.\r\n\r\nVới bí pháp dưỡng nhan mới, với sức mạnh chống lão hóa toàn diện, cho làn da chạm đến trạng thái lý tưởng nhất: ánh da tươi sáng, nếp da ẩm mượt và đường nét gương mặt thanh tú, mang lại vẻ đẹp tái sinh da Vương hậu, bổ sung dưỡng chất Đông Y cao cấp đem lại cảm giác ẩm mịn thư thái, cải thiện tình trạng khô vàng sắc da, duy trì làn da ở trạng thái đẹp và khoẻ mạnh nhất.\r\n\r\nSet gồm : Nước hoa hồng Whoo 25ml \r\n\r\nSữa dưỡng Whoo 25ml ', 10, 450000, 211, 201),
(18, 'Dầu tẩy trang Whoo Vàng Cleanser Oil 50 ml', 16, '8171be5724.jpg', 'Whoo vàng dòng chuyên săn chắc da se khích lỗ chân lông. Dòng Whoo vàng sẽ là đơn thuốc giúp tìm lại vẻ đẹp cho làn da bạn. Giải quyết các vấn đề về lão hóa da do da khô, giúp da căng tràn nhựa sống.\r\n\r\nDầu tẩy trang Đông y Whoo Gongjinhyang Cleansing Oil  giúp làm sạch dịu nhẹ dễ dàng lấy đi mọi lớp make up, dầu dư, bụi bẩn tận sâu lỗ chân lông mà không gây khô da.\r\n\r\nCông dụng:\r\n+ với thành phần dầu có nguồn gốc tự nhiên không chỉ nhẹ nhàng lấy đi toàn bộ bụi bẩn-các lớp trang điểm mà cong chăm sóc làn da và lỗ chân lông hiệu quả\r\n+mang đến làn da sạch thoáng mềm mượt,không làm khô da.\r\n\r\nDung tích : 50ml\r\n\r\nHướng dẫn sử dụng :\r\n\r\n+ Để mặt hoàn toàn khô ráo. Lấy sản phẩm vừa đủ bằng cách ấn vòi xịt 2_3 lần. Thoa và massage nhẹ nhàng toàn mặt.\r\n\r\n+ Sau đó làm ướt tay bằng nước ấm và tiếp tục masage để tạo hiện tượng sữa hóa. Rửa lại với nước lạnh trước khi dùng sữa rửa mặt.', 20, 350000, 212, 105),
(19, 'Combo 2 Son môi cao cấp mini Ohui The First Geniture Lipstick', 16, '228038ac37.jpg', 'Son môi The First Geniture Lipstick Son môi cao cấp với khả năng dưỡng ẩm cao, cho đôi môi quyến rũ, căng bóng với nhiều màu sắc rực rỡ\r\n\r\nVới chiết xuất từ hoa mẫu đơn đặc trưng của dòng The First  Geniture không gây kích ứng, làm dịu và chăm sóc đôi môi cùng kĩ thuật Fitting Oil làm cho các hạt  màu được bao quanh bởi lớp dầu dưỡng giúp dàn trải hạt màu đều trên môi và bền màu lâu trôi.\r\n\r\nĐược chiết xuất từ hoa mẫu đơn. Có khả năng duy trì và bổ sung độ ẩm lên đến 6 giờ liên tục. Đồng thời, trẻ hóa và cải thiện làn da môi. Mang lại sự ẩm mìn, mềm mại cho làn da môi, giúp đôi môi căng tràn sức sống .\r\n\r\nDung tích sản phẩm : 1,3g ', 30, 400000, 412, 23),
(20, 'Tinh chất vàng Hoàn Lưu Cao Whoo Hwanyu Signature Ampoule 7ml', 16, '28a4557f5d.jpg', 'Tinh chất vàng Hoàn Lưu Cao Whoo Hwanyu Signature Ampoule 7ml  - Kiệt tác ôm trọn khả năng tăng cường sức sống từ Nhân sâm núi tự nhiên. Ampoule chứa đựng thành phần tinh túy nhất dành cho làn da bị lão hóa nghiêm trọng, giúp khơi nguồn năng lượng, đưa làn da trở về trạng thái lý tưởng nhất, giúp giải quyết toàn bộ các vấn đề về da: - Nhân sâm núi Đông Trùng hạ thảo giúp thúc đẩy sự hoạt động nguồn năng lượng yếu.\r\n\r\n- Lộc nhung Đông Trùng hạ thảo giúp nuôi dưỡng làn da.\r\n\r\n- Hà thủ ô Đông Trùng hạ thảo giúp cân bằng năng lượng.\r\n\r\n- Thiên sơn tuyết liên hoa giúp lấp đầy độ ẩm, sinh khí.\r\n\r\n- Cùng hơn 70 thành phần thiên nhiên khác giúp làm tăng Khí – Huyết và thúc đẩy năng lượng.\r\n\r\nDung tích sản phẩm : 7ml\r\n\r\nTặng kèm : Sample gói kỳ da chết whoo \r\n\r\nHướng dẫn sử dụng: Sau khi sử dụng nước cân bằng, lấy một lượng vừa đủ ra lòng bàn tay, hít thở để tận hưởng hương thơm nhẹ nhàng các thành phần thảo dược Đông y, thoa nhẹ nhàng lên mặt và cổ.', 44, 1000000, 251, 12),
(21, 'Set dưỡng da Chống lão hóa Ohui Age Recovery', 17, '9edb33be52.png', 'Set dưỡng da Chống lão hóa Ohui Age Recovery \r\n\r\nCông dụng :\r\n\r\nGiữ cho làn da trẻ trung và săn chắc hơn\r\n\r\nChống lão hoá, trị vết nhăn từ sâu bên trong\r\n\r\nThúc đẩy quá trình tái sinh làn da mới\r\n\r\nTăng đàn hồi cho da\r\n\r\nThu nhỏ lỗ chân lông\r\n\r\nDưỡng và tăng cường độ láng mịn trên da\r\n\r\nDưỡng da cho da ẩm mịn và mềm mại ngăn ngừa nếp nhăn\r\n\r\nCung cấp dưỡng chất ngăn ngừa lão hóa cho da\r\n\r\nCải thiện nếp nhăn và chống lão hóa\r\n\r\nBộ sản phẩm gồm:\r\n\r\nNước hoa hồng ( skin ) 150ml : với tp chiết xuất thiên nhiên kết hợp với kỹ thuật nghiên cứu hiện đại giúp khôi phục , trẻ hóa làn da , ngăn ngừa sự hình thành nếp nhăn.\r\n\r\nSữa dưỡng da chống nhăn ( lotion ) 140ml : cung cấp dưỡng chất cô đặc và độ ẩm cần thiết nhất cho da .\r\n\r\nKem dưỡng da 30ml: xóa mờ nếp nhăn\r\n\r\nKem mắt 20ml\r\n\r\nNước hoa hồng: 20ml\r\n\r\n Sữa dưỡng da: 20ml\r\n\r\nTinh chất 3ml\r\n\r\nBảng 5 màu', 30, 3300000, 321, 104),
(22, 'Set dưỡng da chống lão hóa O HUI Age Recovery Wrinkle Cut Serum', 17, '57e811a8d4.jpg', 'Ohui Age Recovery Là dòng sản phẩm chống nhăn, chống lão hóa OHUI được bổ sung baby collagen - loại collagen được tìm thấy trong da trẻ em, giúp tái sinh làn da, tăng độ đàn hồi và làm săn chắc da. Cho bạn làn da mềm mịn như trẻ thơ.\r\n\r\nCông dụng:\r\n\r\n- Cung cấp bổ sung lại lượng Baby Collagen đã bị mất đi, làm giảm sự xuất hiện các nếp nhăn và phục hồi độ đàn hồi cho da\r\n\r\n- Cung cấp độ ẩm cho da, giúp cho da khỏe mạnh, mềm mại, mịn màng và trẻ trung và săn chắc\r\n\r\nSản phẩm nhanh chóng bám chặt vào da khi thoa, giàu dưỡng chất nhưng cho cảm giác sử dụng nhẹ nhàng và không dính rít, vì vậy có thể sử dụng để ngăn ngừa lão hóa trong suốt bốn mùa.\r\n\r\nSet gồm : \r\n\r\n Serum cải thiện nếp nhăn  30ml\r\n\r\n Kem dưỡng da Ohui  35ml\r\n\r\n Nước hoa hồng Ohui  20ml\r\n\r\n Sữa dưỡng Ohui 20ml\r\n\r\nTinh chất Ohui  3ml', 10, 2300000, 115, 10),
(23, 'Set dưỡng da chống lão hóa O HUI Age Recovery Wrinkle Cut Serum', 17, '1a53a2d693.jpg', 'Ohui Age Recovery Là dòng sản phẩm chống nhăn, chống lão hóa OHUI được bổ sung baby collagen - loại collagen được tìm thấy trong da trẻ em, giúp tái sinh làn da, tăng độ đàn hồi và làm săn chắc da. Cho bạn làn da mềm mịn như trẻ thơ.\r\n\r\nCông dụng:\r\n\r\n- Cung cấp bổ sung lại lượng Baby Collagen đã bị mất đi, làm giảm sự xuất hiện các nếp nhăn và phục hồi độ đàn hồi cho da\r\n\r\n- Cung cấp độ ẩm cho da, giúp cho da khỏe mạnh, mềm mại, mịn màng và trẻ trung và săn chắc\r\n\r\nSản phẩm nhanh chóng bám chặt vào da khi thoa, giàu dưỡng chất nhưng cho cảm giác sử dụng nhẹ nhàng và không dính rít, vì vậy có thể sử dụng để ngăn ngừa lão hóa trong suốt bốn mùa.\r\n\r\nSet gồm : \r\n\r\n Serum cải thiện nếp nhăn  30ml\r\n\r\n Kem dưỡng da Ohui  35ml\r\n\r\n Nước hoa hồng Ohui  20ml\r\n\r\n Sữa dưỡng Ohui 20ml\r\n\r\nTinh chất Ohui  3ml', 10, 2300000, 115, 10),
(24, 'Set kem chống nắng Ohui Perfect Sun Black', 18, 'c5bd5cf443.png', 'Kem chống nắng Ohui Day Shield Perfect Sun Black SPF 50+/ PA+++ dành cho da dễ sạm đen.\r\n\r\nKem chống nắng với chỉ số chống tia UV cao, có khả năng giảm tác động xấu, ngăn chặn bụi bẩn từ môi trường; đồng thời là lớp trang điểm tự nhiên, chống thấm nước, hút bã nhờn cho da.\r\n\r\nKem có màu trắng, nhũ nhẹ. Khi tán lên da thì hơi ngã hồng, ẩm mịn. Nhanh chóng thấm vào các tế bào da, mang lại hiệu quả tuyệt vời có thể thay thế lớp kem lót trang điểm\r\n\r\n Công dụng : \r\n\r\nVới chỉ số chống nắng vượt trội SPF50+/PA+++,\r\n\r\nDuy trì độ ẩm, cân bằng lượng dầu trên da, giữ làn da khô thoáng, thoải mái.\r\n\r\nNgoài ra, có thể sử dụng kem chống nắng như kem lót trang điểm.\r\n\r\nSet bao gồm : \r\n\r\n- Chống nắng : 50ml\r\n\r\n- Nước hoa hồng 20ml\r\n\r\n- Sữa dưỡng 20ml \r\n\r\n- Sữa rửa mặt 40ml \r\n\r\nHướng dẫn sử dụng:  Lấy một lượng vừa đủ, thoa đều lên mặt. Đặc biệt là các vùng thường xuyên tiếp xúc với nắng như trán, mũi, gò má.Thoa trước khi ra nắng 20 phút để kem thấm vào da.\r\n\r\n* Nên sử dụng trước khi trang điểm và cuối ngày nên dùng sản phẩm tẩy trang để làm sạch lớp kem chống nắng.', 30, 1500000, 29, 201),
(25, 'Kem chống nắng Ohui Day Shield Ultra Sunblock UV Force', 18, '0d8aea32d9.jpg', 'Kem chống nắng Ohui Day Shield Ultra Sunblock UV Force\r\n\r\n– Với chỉ số chống nắng cao SPF 50+/PA++++ giúp ngăn chặn tia tử ngoại và các tia sáng có hại từ môi trường tác động lên da mà mắt thường không nhìn thấy được, đồng thời cải thiện nếp nhăn tối ưu nhất cho làn da của bạn.\r\n\r\n– Dưỡng trắng da, bên cạnh đó còn bổ sung lượng Vitamin D còn thiếu cho da, ngăn chặn quá trình lão hóa, cho da bạn cảm giác ẩm mịn, với độ hấp thụ tốt sản phẩm không gây trở ngại cho các bước trang điểm sau.\r\n\r\n– Khi tán lên da, lớp kem chống nắng thẩm thấu nhanh vào da rất nhẹ làm tone da sáng thêm như có 1 lớp lót bảo vệ da, không hề gây bí hay làm da căng dày khó chịu, thay vào đó là làm dịu da giúp ngăn chặn các tác hại từ môi trường lên da giúp da được bảo vệ một cách an toàn nhất.\r\n\r\n– Bạn có thể tha hồ bung lụa, dạo phố hay đi biển, dã ngoại…. mà không lo da bị bắt nắng hay sạm\r\n\r\nSet Ohui Day Shield Ultra Sunblock UV Force gồm:\r\n\r\n– 1 tuýp chống nắng full size 50ml \r\n\r\n– 1 nước hoa hồng 20ml\r\n\r\n– 1 sữa dưỡng 20ml\r\n\r\n– 1 sữa rửa mặt dạng gel 40ml', 30, 2000000, 201, 2010),
(26, 'Kem chống nắng Ohui Day Shield Perfect Sun Black SPF 50+/ PA+++', 18, 'c4a4e616d7.jpg', 'Kem chống nắng Ohui Day Shield Perfect Sun Black SPF 50+/ PA+++ dành cho da dễ sạm đen.\r\n\r\nKem chống nắng với chỉ số chống tia UV cao, có khả năng giảm tác động xấu, ngăn chặn bụi bẩn từ môi trường; đồng thời là lớp trang điểm tự nhiên, chống thấm nước, hút bã nhờn cho da.\r\n\r\nKem có màu trắng, nhũ nhẹ. Khi tán lên da thì hơi ngã hồng, ẩm mịn. Nhanh chóng thấm vào các tế bào da, mang lại hiệu quả tuyệt vời có thể thay thế lớp kem lót trang điểm\r\n\r\n Công dụng : \r\n\r\nVới chỉ số chống nắng vượt trội SPF50+/PA+++,\r\n\r\nDuy trì độ ẩm, cân bằng lượng dầu trên da, giữ làn da khô thoáng, thoải mái.\r\n\r\nNgoài ra, có thể sử dụng kem chống nắng như kem lót trang điểm.\r\n\r\nDung tích sản phẩm: 50ml \r\n\r\nHướng dẫn sử dụng:  Lấy một lượng vừa đủ, thoa đều lên mặt. Đặc biệt là các vùng thường xuyên tiếp xúc với nắng như trán, mũi, gò má.Thoa trước khi ra nắng 20 phút để kem thấm vào da.', 30, 950000, 56, 256),
(27, 'Sữa rửa mặt Whoo vàng mini 40 ml', 16, '259fd813d9.jpg', 'Sữa rửa mặt dưỡng ẩm Whoo Gong Jin Hyang Facial Foam Cleanser là dòng sữa rửa mặt tạo bọt Đông y có tác dụng chống lão hóa da với các thành phần chiết xuất từ thảo dược Hoàng cung được sản xuất dưới công nghệ hiện đại tại Hàn Quốc. Sản phẩm được thể hiện dưới dạng gel ẩm mịn, nhẹ nhàng lấy đi lớp sừng tụ lâu ngày trên da, giúp da dễ dàng hấp thụ các dưỡng chất cũng như giúp lớp trang điểm dễ bám vào da hơn.\r\n\r\nCông dụng:\r\n\r\n- Làm sạch da nhẹ nhàng.\r\n\r\n- Làm sạch lớp trang điểm và các cặn bẩn nằm sâu trong da. Do đó giúp hạn chế nguyên nhân gây ra mụn.\r\n\r\n- Bổ sung độ ẩm cho da.\r\n\r\nDung tích sản phẩm: 40ml\r\n\r\nHướng dẫn sử dụng: Làm ướt mặt, lấy một lượng vừa đủ ra tay và tạo bọt. Thoa đều lên mặt và massage nhẹ nhàng trong 15-30 giây. Sau đó, rửa sạch lại với nước. Sử dụng 2 lần/ngày vào mỗi buổi sáng và tối.', 20, 300000, 231, 441),
(28, 'Set dưỡng da tái sinh chống lão hóa Ohui The First Mini 7 pcs', 16, '92eb01ce67.jpg', 'Bộ dưỡng OHUI The First 7 pcs mini mới tái sinh da: \r\nThành phần chủ đạo của bộ sản phẩm The First là siêu dung dịch nuôi dưỡng tế bào gốc tái tổ hợp. Đây là tác nhân giúp da tự tạo ra 29 nhân tố tăng trưởng. Tăng gấp 1.3 lần số lượng tế bào gốc. Đồng thời với kỹ thuật Transkin tăng khả năng thẩm thấu vào da gấp 5 lần. Kết hợp với Hoa Mẫu Đơn Trắng làm\r\n\r\nCông dụng : \r\n\r\nDùng cho loại da\r\n\r\n– Da có nếp nhăn và bị chảy xệ\r\n\r\n– Da khô, sần sùi và kém đi độ mịn màng\r\n\r\n– Da sạm, không đều màu\r\n\r\n– Lỗ chân lông to và da mỏng dần\r\n\r\n– Da có dấu hiệu hình thành các vết nám và tàn nhang trên da\r\n\r\n-Làn da nhạy cảm hay bị dị ứng, mẩ đỏ, da vừa trải qua phi kim vô cùng yếu ớt\r\n\r\n  Bộ dưỡng gồm : \r\n_ Nước thần Ohui  Ohui The First Cell Source 22ml: Huyết thanh khởi nguồn là giải pháp tái tạo phục hồi làn da kỳ diệu \r\n– Nước hoa hồng tái sinh (soften toner) (20ml):  thúc đẩy quá trình trao đổi chất trong da, ổn định nguyên khí cho làn da mệt mỏ\r\n– Sữa dưỡng tái sinh (Emulsion) (20ml): hình thành lớp màng giữ ẩm cho da với cảm giác mềm mịn như tơ thật mát và cao cấp, duy trì độ ẩm mịn và mềm mại cho da.\r\n\r\n–Tinh chất siêu vi Ohui The First Geniture Sym-Micro Essence 5ml:\r\nCải thiện, duy trì trạng thái cân bằng của hệ vi sinh da đồng thời tăng cường đề kháng da , hỗ trợ quá trình tái tạo da mạnh mẽ.\r\n_ Tinh chất vàng Ohui The First Ampoule Advanced 5ml: Tinh chất vàng cung cấp dưỡng chất tối ưu cho làn da, đậm đặc gấp gần 10 lần, là sản phẩm tiêu biểu nhất của dòng Ohui The First,\r\n\r\n– Kem dưỡng tái sinh (Cream) (7ml):  tăng cường sinh mệnh cho làn da yếu – hạt nhân của quá trình tuần hoàn da. The First Cream với hàng triệu các phần tử nhỏ dưỡng chất giúp thúc đẩy quá trình tái tạo da.\r\n\r\n– Kem dưỡng chăm sóc da vùng mắt  Eye Cream (5ml): tăng thêm độ đàn hồi và sinh khí cho vùng mắt mệt mỏi. giúp quá trình trao đổi chất trong da diễn ra đều đặn, đem lại độ đàn hồi và sinh khí cho vùng quanh mắt ', 30, 1250000, 10, 100),
(29, 'Set dưỡng da Whoo Hwa Hyun tái sinh Mini 3SP', 16, 'a9b2647b56.jpg', 'Set dưỡng da Whoo tái sinh Hwa Hyun là dòng sản phẩm dưỡng và tái sinh da Đông y cao cấp với những thành phần đông dược và thảo mộc qúy hiếm giúp tái sinh tận sâu bên trong và tươi sáng bên ngoài cho làn da, mang lại làn da hồng hào, khỏe mạnh nhằm tái sinh 1 làn da mới, khắc phục tình trạng da sỉn màu không đều màu ,làm da sáng hơn, làm giảm mụn đầu đen, giảm thâm mụn.\r\n\r\nBộ Sản phẩm có tính năng phục hồi các tổn thương trên da rất tốt, giúp các vết thâm hay tổn thương do mụn nhanh chóng biến mất. Đồng thời, một số vị thuốc đông y có trong sản phẩm mang lại tính kháng viêm trên da hiệu quả, giúp ngăn ngừa và loại bỏ nhân mụn ẩn sâu trong lớp biểu bì.\r\n\r\nSet sản phẩm gồm : \r\n\r\n1. Chai Essence 8ml : Tinh chất dưỡng da giúp làm sáng và tăng cường sức sống cho làn da.\r\n\r\n2. Chai Serum Mắt 8ml: Tinh Chất dưỡng mắt với thành phần dưỡng chất đậm đặc cùng độ bám dính cao, mang lại hiệu quả dưỡng sáng, tăng cường độ đàn hồi, cải thiện và tăng cường sinh khí vùng da mắt.\r\n\r\n3. Hũ Kem Dưỡng 10ml: Kem dưỡng giúp tái sinh, dưỡng da mịn màng, trắng hồng tự nhiên, loại kem dưỡng cô đặc cực hiệu quả. Ngăn ngừa lão hoá cho làn da.\r\n\r\nTặng thêm : Sample tẩy da chết Ohui ', 30, 800000, 56, 401),
(30, 'Bộ Tinh Chất Dưỡng Trẻ Hóa Da Ohui The First Geniture Sym 3pcs', 16, 'c6fc6f1f4f.jpg', 'Tinh chất O HUI The First Geniture Sym-Micro Essence chống lão hóa \r\n\r\nDòng sản phẩm The First Geniture ngăn ngừa lão hóa cao cấp - khơi nguồn sức mạnh từ tận sâu bên trong làn da, thêm sinh khí cho làn da mệt mỏi, khôi phục lại vẻ đẹp của bạn.\r\n\r\nTinh chất O HUI The First Geniture Sym-Micro Essence với công nghệ độc quyền Gen-Biotics™ và các thành phần cốt lõi của dòng The First Geniture giúp duy trì cân  bằng trang thái hệ vi sinh da, tăng cường đề kháng cho các tế bào đang suy yếu , chăm sóc toàn diện làn da bị tổn thương và mang đến một làn da rạng rỡ và sáng khỏe . \r\n\r\nBộ Sản Phẩm Bao Gồm:\r\n1. Tinh chất dưỡng Ohui The First Geniture Sym – Micro Essence 5mlx2\r\n- Dưỡng chất tế bào mầm chứa 90,3% Cell Source TM, giúp da thẩm thấu tốt hơn các thành phần dưỡng chất do đó giúp phục hồi da tốt hơn.\r\n- Chiết xuất Royal Jelly giàu dưỡng chất cô đặc ở nồng độ cao được thêm vào thành phần dung dịch nuôi dưỡng tế bào mầm, chăm sóc cho nếp da bóng mượt, khỏe mạnh.\r\n- Ngoài ra, sản phẩm còn có thành phần tái sinh biểu bì và thân bì hoàn hảo, giúp tăng cường độ đàn hồi và săn chắc cho làn da đang lão hóa.\r\n\r\n\r\n2.Tinh Chất Vàng Ohui The First Cell Revolution Ampoule 10ml.\r\nTinh chất Vàng 24K Ohui The First Cell Revolution Ampoule là sản phẩm nổi tiếng của Ohui mang tính chất đột phá trong công nghệ làm đẹp.\r\nLà thần dược chữa trị nhiều vấn đề trên da như lỗ chân lông to, da nhạy cảm, ửng đỏ, da sạm màu và không đều màu, mụn đỏ sưng tấy, da bị suy giảm độ đàn hồi.', 60, 1000000, 111, 312),
(31, 'Bảng son 5 màu Su:m37 Losecsumma Elixir Golden Lipsticks Pallete', 16, '12131ce6de.jpg', 'Bảng màu môi Su:m37 LosecSumma Elixir Golden Lipsticks Pallete với chất kem mịn mượt giúp tô điểm đôi môi tươi tắn, lên màu chuẩn chỉ  với 1 lần chạm. Được làm từ các thành phần thảo dược lên men quý hiếm , sản phẩm chứa nhiều dưỡng chất làm mềm và chống nhăn môi. Đặc biệt son không chì, không chất tạo màu hóa học, không gây thâm và khô môi \r\n\r\nMàu sắc:\r\n\r\n- Màu 1: Red ( Đỏ)\r\n\r\n- Màu 2: Deep Red ( Đỏ sẫm )\r\n\r\n- Màu 3: Coral ( Hồng san hô )\r\n\r\n- Màu 4: Pink ( Hồng )\r\n\r\n- Màu 5:  Brick Orange ( Cam gạch) \r\n\r\nDung tích sản phẩm: 4g ', 10, 400000, 40, 56),
(32, 'Bộ sản phẩm dưỡng trắng da Ohui Extreme White Miniature Kit 3 sản phẩm', 16, 'a0b35b6b41.jpg', 'Set OHUI Extreme White 3 món là dòng sản phẩm dưỡng trắng da không gây kích ứng, giúp cải thiện làn da tối màu trở nên sáng trong.\r\n\r\nSet dưỡng trắng da 3 món Ohui Extreme White gồm:\r\n\r\n1. Extreme White Skin Solftener (20ml): Nước cân bằng chỉnh đốn lại kết cấu da, cho làn da sáng mịn trong suốt.\r\n\r\n2. Ohui Extreme White Serum (3ml): Tinh chất cô đặc, tan chảy và thẩm thấu sâu bên trong, cho làn da sáng trong rạng rỡ.\r\n\r\n3. Extreme White Emulsion (20ml): Sữa dưỡng da tăng cường độ ẩm giúp duy trì độ ẩm lâu dài cho làn da tươi sáng, mịn màng.', 10, 450000, 123, 562),
(33, 'Bộ sản phẩm dưỡng trắng da Ohui Extreme White Miniature Kit 5 sản phẩm', 16, 'cf243e673b.jpg', 'Ohui Extreme White Là dòng sản phẩm dưỡng trắng da không gây kích ứng, giúp cải thiện làn da tối màu trở nên sáng trong.\r\n \r\nSet dưỡng trắng da 5 món Ohui Extreme White mới gồm:\r\n \r\n1. Extreme White Foam (40ml): Sữa rửa mặt dạng bọt cho làn da sạch hết các lớp bụi bẩn và tươi mát.\r\n \r\n2. Extreme White Skin Solftener (20ml):Nước cân bằng chỉnh đốn lại kết cấu da, cho làn da sáng mịn trong suốt.\r\n \r\n3. Ohui Extreme White Serum (3ml):Tinh chất cô đặc, tan chảy và thẩm thấu sâu bên trong, cho làn da sáng trong rạng rỡ.\r\n \r\n4. Extreme White Emulsion (20ml):Sữa dưỡng da tăng cường độ ẩm giúp duy trì độ ẩm lâu dài cho làn da tươi sáng, mịn màng.\r\n \r\n5. Ohui Extreme White Cream (7ml):Kem dưỡng trắng cô đặc, dưỡng trắng sáng từ bên trong.\r\nTặng kèm : Sample gói chống nắng Ohui ', 10, 850000, 89, 265),
(34, 'Bộ dưỡng da Hoàn Lưu Cao Whoo Hwan Yu Mini set 3pcs - phục hồi trẻ hóa làn da', 16, '578c99acf0.jpg', 'Bộ sản phẩm dưỡng da phục hồi 3 món The History of Whoo thuộc dòng sản phẩm Hoàn lưu cao của thương hiệu mỹ phẩm đình đám Whoo. Được biết đến như một bí kíp phục hồi làn da lão hóa, các thành phần trong bộ sản phẩm giúp nuôi dưỡng, tái tạo làn da từ bên trong, trả lại cho da vẻ rạng rỡ, mịn màng, căng tràn sức sống\r\n\r\nBộ Hoàn Lưu Cao Whoo Hwan Yu gồm 3 món:\r\n\r\n1. Hwanyu Go Imperial Youth Cream (4ml) – kem dưỡng:Với hơn 70 thành phần Đông y quý hiếm có thể nhắc đến như sen tuyết và sâm núi được chắt lọc và bảo quản nghiêm ngặt cùng công nghệ sản xuất hiện đại, sản phẩm giúp xóa mờ các dấu vết thời gian trên làn da chị em.\r\n\r\n2. Hwanyu Imperial Youth Eye Cream (4ml) – kem dưỡng mắt: sen tuyết thu thập từ tháng 7,8 kết hợp với sâm núi 35 tuổi của tỉnh Gangwon và một số thành phần thảo dược khác sản xuất ra Hwanyu Dongan Go. Sản phẩm giúp làm mờ các vết nhăn trên vùng mắt, cải thiện sự trao đổi chất và giúp vùng mắt rạng rỡ hơn.\r\n\r\n3. Hwanyu Imperial Youth Essence (7ml) – tinh dầu: Tinh dầu được bổ sung thêm đơn thuốc bát trấn bổ tinh đơn phối hợp với các thành phần thảo dược khác, khi kết hợp sử dụng cùng Hwanyu Go sẽ tạo ra được sự cân bằng, giúp da được hấp thụ một cách tối đa các dưỡng chất có trong sản phẩm.', 60, 1000000, 451, 236),
(35, 'Bộ dưỡng tái sinh chống lão hóa Whoo Cheonyuldan Ultimate Regenerating Gift Set Mini 4pcs', 16, 'd41121b265.jpg', 'Cheonyuldan giúp dưỡng chống lão hoá , sáng da, giải quyết mọi vấn đề về da\r\n\r\nBộ dưỡng tái sinh chống lão hóa Whoo Cheonyuldan 4pcs bao gồm:\r\n\r\n1. Rejuvenating Balancer: Nước cân bằng dưỡng sáng da, giúp ngừa lão hóa, tăng độ đàn hồi và độ săn chắc cho da (25ml)\r\n\r\n2. Regenerating Essence: Tinh chất dưỡng da đậm đặc, dưỡng sáng, giúp ngăn ngừa lão hóa, tăng độ đàn hồi và độ săn chắc cho da (8ml)\r\n\r\n3. Rejuvenating Emulsion: Sữa dưỡng sáng da và cô đặc, giúp ngăn ngừa lão hóa, tăng độ đàn hồi và độ săn chắc cho da (25ml)\r\n\r\n4. Regenerating Cream: Kem dưỡng da cao cấp, dưỡng sáng, giúp ngăn ngừa lão hóa, tăng độ đàn hồi và độ săn chắc cho da (10ml)\r\n\r\nTặng thêm : Sample Tẩy da chết Whoo Soel ', 40, 1000000, 52, 245),
(36, 'Bộ sản phẩm cấp nước se khít lỗ chân lông Su:m37 Waterfull Special Gift Mini 5pcs', 16, '64ebf742f6.jpg', 'Bộ Su:m37 Water-full Special gift : bộ sản phẩm cấp ẩm cao cấp giúp bổ sung nước vào sâu trong da, giúp thư giãn làn da, cho da căng ẩm, mịn mượt.\r\n\r\nThành phần :\r\n\r\n- Thành phần Aquafirm™ độc quyền: lên men từ Trà tuyết đỏ (Rêu từ đỉnh Tây Tạng) và hỗn hợp 4 loại nấm quý. Aquafirm™ giúp kích thích sản sinh và nuôi dưỡng Aquaporin – Kênh dẫn nước qua màng tế bào.\r\n\r\n- Hỗn hợp lên men từ nhựa tre tươi và 3 loài hoa thần bí (Cỏ ba lá đỏ, hoa dâm bụt, hoa kim ngân) giúp cấp nước mạnh mẽ và kháng viêm, ngăn chặn các vấn đề về da.\r\n\r\n- Thành phần hoa sen tuyết hòa quyện trong kết cấu gel tươi mát giúp làm mát da tức thời, cho da thư giãn\r\n\r\nBộ sản phẩm su:m37 Water-full Special Gift gồm :\r\n\r\n1. Nước hoa hồng su:m37 Water-full Refreshing Toner 20ml : với khả năng thẩm thấu nhanh, tạo cảm giác tươi mát, sảng khoái ngay khi bôi lên da. Đồng thời sản phẩm giúp cân abwfng và bổ sung độ ẩm cho da rất ưu việt.\r\n\r\n2. Sữa dưỡng su:m37 Water-full Rebalancing Emulsion 20ml : dạng gel giúp mang lại một làn da căng ẩm, tạo cảm giác tươi mát như thể các hạt nước đang lan tỏa khắp trên da.\r\n\r\n3. Kem dưỡng su:m37 Water-full Water Gel Cream 10ml : giúp duy trì độ ẩm trên da, cho da ẩm mọng suốt ngày dài. Kết cấu dạng gel nhẹ da và mang lại cảm giác tươi mát, sảng khoải cho những làn da mệt mỏi, thiếu nước vì tác động của môi trường và ánh sáng mặt trời.\r\n\r\n4. Kem mắt su:m37 Water-full Timeless Water Gel Eye Lifting Essence 5ml: giúp cấp ẩm dồi dào, giúp cải thiện độ đàn hồi của vùng da này cũng như giữ cho vùng da mắt luôn ẩm mịn.\r\n\r\n5. Sữa rửa mặt su:m37 Skin Saver Pure Effect Cleansing Foam 40ml thể kem mềm mại với lượng bọt dày làm sạch mọi lớp trang điểm và bụi bẩn, mang đến một làn da mềm mịn. Đồng thời, sản phẩm mang đến cảm giác sảng khoái và duy trì sự ẩm mịn ngay cả sau khi rửa mặt.', 30, 500000, 35, 214),
(37, 'Bộ tái sinh da cao cấp Whoo Cheongidan Radiant Rejuvenating GWP Set 6pcs', 16, '0f47d96bd0.jpg', 'Bộ tái sinh da cap cấp Whoo Cheongidan Radiant 6pcs Gift Set 78ml có thành phần chiết xuất từ thành phần đông y và tổng hợp các bài thuốc hoàng cung quý hiếm, sẽ mang đến cho bạn làn da tươi trẻ và quyến rũ.\r\n\r\nBộ Tái Sinh Da Ca Cấp 6 Món WHOO sẽ là sự lựa chọn lý tưởng để bạn gái có làn da mịn màng, quyến rũ và luôn tươi trẻ.\r\n\r\nBộ sản phẩm bao gồm :\r\n\r\n1. Rejuvenating Balancer - Hoa hồng cô đặc giàu dưỡng chất cao cấp nhất (25ml)\r\n\r\n2. Regenerating Gold Concentrate - Tinh chất nhân sâm núi thiên nhiên (5ml)\r\n\r\n3. Regenerating Essence - Tinh dầu cao cấp giúp tái sinh và làm sáng da (8ml)\r\n\r\n4. Rejuvenating Emulsion - Sữa dưỡng da Hoàng cung sang trọng đem lại cảm nhận giàu dưỡng chất (25ml)\r\n\r\n5. Regenerating Eye Cream - cô đặc giúp tái sinh và đem lại độ đàn hồi cho vùng da mắt, chống lão hoá, đánh tan bọng mỡ mắt và làm sáng vùng da mắt (5ml)\r\n\r\n6. Regenerating Cream - Kem dưỡng tái sinh da cao cấp bổ sung dưỡng chất bên trong và giúp sáng trắng bên ngoài làn da (10ml)', 40, 1000000, 102, 247),
(39, 'Bộ dưỡng trắng da Ohui Extreme White 2pcs Special Set', 19, '2760aa27e5.jpg', 'Bộ dưỡng trắng da Ohui Extreme White 2pcs Special Set  là dòng sản phẩm làm trắng da không gây kích ứng, giúp cải thiện làn da tối màu trở nên sáng trong.\r\n\r\nThành phần chính:\r\n\r\n+ Snow Vitamin: thành phần dưỡng trắng da được chiết suất cô đặc giúp làm mờ nhanh vết sạm nám. Thành phần dưỡng trắng nâng cấp đột phá cho hiệu quả dưỡng trắng mạnh mẽ đồng thời tăng cường sức đề kháng cho da\r\n\r\n+ Chiết xuất hoa Giọt tuyết, hoa Thủy tiên và siêu Vitamin B đậm đặc như tinh thể tuyết, Phù hợp với mọi loại da, Đặc biệt có khả năng chăm sóc cho cả làn da mỏng manh nhạy cảm nhất sẽ đem đến hiệu quả làm dịu da tuyệt vời.\r\n\r\nBộ sản phẩm bao gồm:\r\n\r\n \r\n\r\n+ Nước hoa hồng 150ml\r\n\r\n+ Sữa dưỡng làm trắng da 130ml\r\n\r\n+  Kem dưỡng aqua 25ml\r\n\r\n+ sữa tắm 40ml \r\n\r\n+ gội 40ml\r\n\r\n+ Nước hoa hồng trắng da 20ml;\r\n\r\n+ Sữa dưỡng trắng da 20ml;\r\n\r\nTặng kèm :\r\n\r\nBộ dưỡng trắng da Ohui Mini 5pcs \r\n\r\nSample gói chống nắng Ohui ', 50, 2450000, 89, 235),
(40, 'Bộ dưỡng trắng da Ohui Extreme White 4pcs Special Set', 19, 'ce7625f1b0.jpg', 'Bộ dưỡng trắng da Ohui Extreme White 2pcs Special Set  là dòng sản phẩm làm trắng da không gây kích ứng, giúp cải thiện làn da tối màu trở nên sáng trong.\r\n\r\nThành phần chính:\r\n\r\n+ Snow Vitamin: thành phần dưỡng trắng da được chiết suất cô đặc giúp làm mờ nhanh vết sạm nám. Thành phần dưỡng trắng nâng cấp đột phá cho hiệu quả dưỡng trắng mạnh mẽ đồng thời tăng cường sức đề kháng cho da\r\n\r\n+ Chiết xuất hoa Giọt tuyết, hoa Thủy tiên và siêu Vitamin B đậm đặc như tinh thể tuyết, Phù hợp với mọi loại da, Đặc biệt có khả năng chăm sóc cho cả làn da mỏng manh nhạy cảm nhất sẽ đem đến hiệu quả làm dịu da tuyệt vời.\r\n\r\nBộ sản phẩm bao gồm:\r\n\r\n+ Nước hoa hồng 150ml\r\n\r\n+ Sữa dưỡng làm trắng da 130ml\r\n\r\n+ sữa tắm 40ml \r\n\r\n+ gội 40ml\r\n\r\n + Tinh chất trắng da 20ml\r\n\r\nKem dưỡng trắng da 20ml\r\n\r\nTẩy da chết ohui trắng da 60ml\r\n\r\nSữa rửa mặt căng bóng ohui prime 40ml\r\n\r\nTặng kèm :\r\n\r\nMặt dưỡng trắng da 02 miếng \r\n\r\nSample gói chống nắng Ohui ', 55, 3000000, 230, 314),
(41, 'Combo Nạ ngủ dưỡng trắng da Ohui Extreme White', 19, '266e252170.png', 'Mặt nạ ngủ Ohui Extreme White Sleeping Mask dưỡng trắng da\r\n\r\nLà dòng sản phẩm làm trắng da không gây kích ứng, giúp cải thiện làn da tối màu trở nên sáng trong.\r\n\r\nMặt nạ ngủ Ohui dưỡng trắng da ban đêm giúp làm đều màu da, đem lại làn da trắng sáng rạng rỡ. Sản phẩm còn tăng cường ẩm cho làn da khô, xuống sắc, trị nám và ngăn ngừa lão hóa. Tác dụng dưỡng trắng an toàn cho cả làn da nhạy cảm nhất.\r\n\r\nOhui Extreme White Sleeping Mask - mặt nạ ngủ sẽ tạo ra môi trường trọn vẹn giúp kem dưỡng kết hợp với những dưỡng chất có trong mặt nạ ngủ một cách hiệu quả nhất.\r\n\r\nSản phẩm với 2 thành phần chính là Snow VitaminTM  cô đặc và Chiết xuất hoa thủy tiên giúp làm mờ nhanh vết sạm nám, tăng cường khả năng hấp thu các thành phần dưỡng trắng trong sản phẩm vào da, đem đến hiệu quả làm dịu da tuyệt vời. \r\n\r\nDung tích sản phẩm:\r\n\r\n Sản phẩm gồm:\r\n\r\n- Nạ ngủ trắng da OHUI Extreme White Cream 100ml\r\n\r\nTặng kèm\r\n\r\n- Kem dưỡng trắng da OHUI Extreme White Cream 7ml\r\n\r\n- Sữa rửa mặt dưỡng trắng OHUI Extreme White Bright Foam 40ml\r\n\r\n- Nước Hoa Hồng Dưỡng Trắng Da OHUI Extreme White Skin Softener 20ml\r\n\r\n- Sữa dưỡng trắng da OHUI Extreme White Emulsion 20ml\r\n\r\nQùa tặng thêm : \r\n\r\nSản phẩm nước hoa hồng Ohui The First dùng thử 5ml x3\r\n\r\nGói chống nắng Ohui Sun Black ', 50, 1400000, 84, 236),
(42, 'Sữa dưỡng Ohui Extreme White Emulsion - dưỡng trắng duy trì độ ẩm cho da', 19, '3bdc58cf73.png', 'Sữa dưỡng trắng da Ohui Extreme White Emulsion \r\n\r\nSữa dưỡng trắng da Ohui Extreme White Emulsion là dòng sản phẩm làm trắng da không gây kích ứng, giúp cải thiện làn da tối màu trở nên sáng trong.\r\n\r\nSữa dưỡng trắng da Ohui với kết cấu mềm mại, hình thành lớp màng bảo vệ ẩm mượt và làm trắng tức thì ngay khi thoa, đem lại làn da ẩm mịn, sáng mịn. Sản phẩm còn giúp cân bằng dầu và nước trên da, dàn trải đều, mát mịn, nhẹ nhàng da.\r\n\r\nSản phẩm với 2 thành phần chính là Snow VitaminTM  cô đặc và Chiết xuất hoa thủy tiên giúp làm mờ nhanh vết sạm nám, tăng cường khả năng hấp thu các thành phần dưỡng trắng trong sản phẩm vào da, đem đến hiệu quả làm dịu da tuyệt vời. \r\n\r\nDung tích sản phẩm: 130ml\r\n\r\nHướng dẫn sử dụng:  Sau khi thoa tinh chất, lấy một lượng vừa đủ và thoa đều lên toàn bộ khuôn mặt rồi vỗ nhẹ để sản phẩm thẩm thấu vào trong da ', 50, 1100000, 122, 364),
(43, 'Set Ohui The First Geniture Ampoule Cover Cushion', 20, '4f2ac2aaaf.png', 'Phấn nền đa năng Ohui The First Geniture Ampoule Cover Cushion SPF50+/PA+++ chứa đầy đủ các thành phần của The First Ampoule. Giúp cải thiện nếp nhăn, dưỡng trắng chống nắng.\r\n\r\nPhấn nền OHUI The First Ampoule Cushion chứa vàng nguyên chất 24k với công nghệ tế bào mầm đẳng cấp thế giới mang lại cho bạn lớp nền đẹp, mượt mà đầy sinh khí. Ngoài ra sản phẩm còn dưỡng da và se khít lỗ chân lông, không sợ da bị tổn thương hay hại đến da. Cùng với độ chống nắng hoàn hảo SPF50+/ PA+++ bảo vệ làn da ở trạng thái an toàn nhất.\r\n\r\nSản phẩm với kết cấu mỏng nhẹ, không dính rít, cân bằng dầu cho da, giúp lấp đầy các nếp nhăn và lỗ chân lông to, mang lại sự trẻ trung cho làn da sự tỏa sáng rạng ngời.\r\n\r\nSản phẩm gồm : \r\n\r\nCushion 15g + 15g + 15g\r\n\r\nTặng chổi đánh ', 30, 2200000, 101, 265),
(44, 'Dầu xả đông y tạo độ bóng mượt tóc Whoo Spa Essence Rinse', 21, 'aba90664ca.jpeg', '– Với thiết kế tinh tế gọn gàng, dạng vòi xịt. Tiện lợi trong việc sử dụng dụng.\r\n\r\n– Được sản xuất bằng tinh chất thảo dược phương Đông. Như tế tấn, địa hoàng, hoàng liên quý hiếm… Và trên dây chuyền công nghệ hiện đại bậc nhất thế giới.\r\n\r\n– Tinh chất xả mang đến hiệu quả bổ huyết. Mang lại sự thoải mái, thư giãn\r\n\r\n– Khả năng đặc biệt duy trì màu cho tóc nhuộm mang đến một mái tóc khỏe mượt óng ả.\r\n\r\n– Giảm thiểu việc rụng tóc do sử dụng hóa chất. Nuôi dưỡng và ngăn ngừa rụng tóc cho tóc bồng bềnh như suối.\r\n\r\n– Ứng dụng phương pháp trị liệu Đông y. Loại bỏ độc tố và mùi hôi trên da đầu. Giúp lưu giữu được mùi hương nhẹ nhàng sang trọng nhưng bền bỉ trên mái tóc.\r\n\r\n– Sản phẩm cao cấp hoàng cung Đông y. Không chỉ là sản phẩm dưỡng tóc thông thường. Mà còn trị liệu lâu dài và phục hồi hư tổn cho tóc từ gốc đến ngọn.', 60, 300000, 211, 265),
(45, 'Set 10 gói Sample dầu gội đông y Whoo Spa Essence Shampoo và 10 gói Sample Dầu xả đông y Whoo Spa Essence Rinse', 21, 'b6aa30628c.jpg', 'Dầu gội  và dầu xả tinh chất Đông y. Với thành phần hoàng liên giàu dưỡng chất giúp da đầu khỏe mạnh. Whoo Spa Essence Shampoo và Whoo Spa Essence Rinse\r\n\r\nDầu gội đậm đặc dưỡng chất dạng tinh chất ứng dụng phương pháp Spa Đông y. Chứa đựng phương pháp chăm sóc tóc bí truyền của Từ Hy Thái Hậu.\r\n\r\nVới nhiều Thành phần Đông y quý hiếm. Mang đến hiệu quả chăm sóc da đầu ngăn rụng tóc. Bên cạnh đó còn có hiệu quả làm mát và loại bỏ hỏa khí không cần thiết. Cân bằng độ pH duy trì tình trạng tóc khỏe tự nhiên. Cho mái tóc luôn phảnh phất mùi hương nhẹ nhàng, sang trọng.', 56, 133000, 211, 521),
(46, 'Phấn nước Ohui Ultimate Cover Cushion Satin Finish', 20, '85d836f04e.jpg', 'Phấn nước Cushion Ohui Utimate Cove Satin Finish với khả năng che phủ khuyết điểm tốt , ráo thoáng bên ngoài ẩm bên trong mang lại làn da mịn màng và trong suốt tự satin . \r\n\r\nSet sản phẩm gồm : Cushion 1 lõi chính tặng 1 lõi phụ \r\n\r\nBông trang điểm \r\n\r\nSữa rửa mặt\r\n\r\nCảm nhận sản phẩm:\r\n\r\nRáo mịn nhưng duy trì độ ẩm\r\n\r\nBền màu suốt 24h, không trôi khi đeo khẩu trang\r\n\r\nBông phấn dễ thao tác, kể cả vùng khóe mũi, khóe mắt\r\n\r\nChe được vết thâm, mụn và vùng da không đều màu', 26, 1260000, 34, 235),
(47, 'Phấn nước Ohui The First Geniture Ampoule SPF50+/PA+++ Cushion 2021', 20, 'c162c04585.jpeg', 'Phấn nước tinh chất vàng 24k OHUI The First Geniture Ampoule Cover Cushion SPF50+ PA+++. Phấn nước đa năng, chứa đầy đủ các thành phần của tinh chất vàng 24k The First Ampoule, giúp cải thiện nếp nhăn, tái tạo da, dưỡng trắng.\r\n\r\nCushion the first thì các chị da hỗn hợp, thường đến khô dùng không có đối thủ, siêu mướt mịn, che khuyết điểm tương đối khá mà cực kỳ tự nhiên. Phấn nước OHUI The First Ampoule Cushion với công nghệ tế bào mầm đẳng cấp thế giới mang lại cho bạn lớp nền đẹp, mượt mà đầy sinh khí. Sản phẩm này được Đánh giá cao vì ngoài tác dụng trang điểm còn duỡng da và se khít lỗ chân lông, không sợ da bị tổn thương hay hại đến da. Phấn kết cấu mỏng nhẹ, không dính rít, cân bằng dầu cho da, giúp lấp đầy các nếp nhăn và lỗ chân lông to, mang lại sự trẻ trung cho làn da và sự tỏa sáng rạng ngời Dưỡng trắng da, cải thiện nếp nhăn, cùng với chỉ số chống nắng hoàn hảo SPF50+/ PA+++ bảo vệ làn da ở trạng thái an toàn nhất.', 50, 2400000, 40, 265),
(48, 'Phấn nước bản giới hạn OHUI Ultimate Cover Cushion Set 45g', 20, 'a65aa6dee2.jpg', 'Bộ phấn nước dưỡng ẩm phiên bản giới hạn OHUI Ultimate Ultimate Cover Cushion Special Edition Set 45g\r\n\r\nBộ sản phẩm gồm: - Phấn nước dưỡng ẩm phiên bản giới hạn OHUI Ultimate Ultimate Cover Cushion 15g - 2x lõi refill 15g\r\n\r\nmàu: 01 da sáng (Milk Beige)\r\n\r\nPhấn nước trang điểm đem đến một làn da rạng rỡ sáng bóng như chính làn da của bạn nhờ cung cấp độ ẩm vượt trội và độ che phủ mạnh mẽ hoàn hảo. Với chỉ số chống nắng SPF50+/ PA+++ giúp làn da có thể tránh được những tác động từ ánh nắng mặt trời suốt nhiều giờ liền. Bảo vệ làn da khỏi tác động của tia tử ngoại, đồng thời có khả năng dưỡng trắng và cải thiện nếp nhăn. Sản phẩm thích hợp với mọi loại da, đặc biệt cho da khô đến da thường nhờ công thức tăng cường độ ẩm khiến lớp nền mịn mượt. Với chất kem mỏng mịn, tạo hiệu ứng cho lớp nền căng mọng tự nhiên sản phẩm sẽ mang đến cho bạn một làn da ẩm mịn, căng sáng.\r\n\r\nvà Hiệu nănĐặc điểmg: - Vừa trang điểm, vừa dưỡng da mỗi ngày.\r\n\r\n- Bảo vệ làn da dưới tác hại của ánh nắng mặt trời nhờ chỉ số chống nắng SPF 50+/PA+++.\r\n\r\n- Giúp che mờ khuyết điểm như mụn, thâm… một cách hiệu quả.\r\n\r\n- Bổ sung thành phần dưỡng chất giúp tái tạo và cải thiện hiệu quả sắc tố da.\r\n\r\n- Cung cấp và duy trì độ ẩm tối ưu, giúp da luôn mềm mại, mịn màng.\r\n\r\n- Kiểm soát lượng dầu trên da, giúp tăng sự đàn hồi, săn chắc cho làn da và không gây bít lỗ chân lông.\r\n\r\nHướng dẫn sử dụng: Dùng bông phấn vỗ nhẹ đều trên toàn khuôn mặt, đặc biệt là vùng chữ T, chú ý tránh miết bông phấn để tạo độ mịn và bám phấn hơn.', 40, 1340000, 102, 234),
(49, 'Bộ Dưỡng Nhân Sâm SULWHASOO Concentrated Ginseng Anti-aging Daily Routine 7pcs Trị Nhăn Chống Lão Hoá', 22, 'b96261e4b8.jpg', '– Khi da mất đi độ đàn hồi, nếp nhăn trên bề mặt xuất hiện nhanh chóng và lan truyền sâu và rộng hơn. Sulwhasoo kiểm soát vấn đề này với các sản phẩm chống lão hóa dòng Concentrated Ginseng Renewing.\r\n\r\n– Da mất độ đàn hồi là sự khởi phát của nếp nhăn sâu và lan rộng Đàn hồi của da giúp ngăn ngừa nếp nhăn sâu và tăng độ săn chắc cho da. Nhưng do tuổi tác và stress, da của chúng ta bắt đầu lỏng lẻo và không thể ngăn chặn sự xuất hiện của các nếp nhăn. Nó cũng mất độ săn chắc, vào thời điểm khi khả năng đàn hồi bị phá vỡ thì vấn đề lão hóa phức tạp hơn bắt đầu xuất hiện xung quanh da.\r\n\r\n– Đây là lúc bạn cần chăm sóc da giúp chống lão hóa không chỉ giải quyết các nếp nhăn mà còn giúp làn da của bạn trở nên khỏe mạnh hơn do đó có thể chống lại sự lây lan của các nếp nhăn. Concentrated Ginseng Renewing Set làm giảm các nếp nhăn bằng cách tăng cường độ đàn hồi của làn da.', 20, 3100000, 30, 120),
(50, 'Kem Chống Lão Hóa Sulwhasoo Concentrated Ginseng Renewing Cream EX Light', 22, '3a4a9e1edc.jpg', 'Khôi phục và gìn giữ làn da thanh xuân với chiết xuất từ nhân sâm\r\nKem chống lão hóa từ nhân sâm cô đặc giúp chăm sóc những dấu hiệu lão hóa, tái sinh làn da từ bên trong. (Kết cấu mỏng nhẹ)\r\n\r\nThành tựu của 50 năm nghiên cứu nhân sâm cho làn da thanh xuân không tỳ vết\r\nSulwhasoo đã tìm thấy hợp chất chống lão hóa Compound K và Ginsenoside Re, có trong rễ và hoa sâm. Công thức độc đáo từ nhân sâm giúp xóa mờ các dấu hiệu lão hóa, cho làn da thanh xuân rạng rỡ.\r\nTrải nghiệm cảm giác nhẹ nhàng và thư thái\r\nKết cấu kem mỏng nhẹ hơn phiên bản truyền thống EX, nhanh chóng thấm sâu, tạo lớp dưỡng lụa là trên da. Thư giãn với hương thơm tươi mát nhẹ nhàng từ lá và hoa sâm.', 50, 3900000, 66, 263),
(51, 'Sét Dưỡng Nhân Sâm Sulwhasoo Giúp Cung Cấp Dưỡng Chất , Căng Hồng , Láng Mịn Giảm Nhăn , Chống Chảy Xệ', 22, '29fb59b875.jpg', 'Set dưỡng nhân sâm sulwhasoo giúp cung cấp dưỡng chất cho làm da căng hồng, sáng mịn giảm nhăn, chống chảy sệ.\r\nKết cấu dưỡng chất mỏng nhẹ với thành tựu 50 năm nghiên cứu nhân sâm cho pàn da tuổi thanh xuân không tỳ vết.\r\nHợp chất chống lão hoá compound k và gingenoside có trong rễ, hoa sâm. Công thức độc đáo từ nhân sâm giúp xoá mờ các dấu hiệu lão hoá, cho làn da thanh xuân rạng rỡ.\r\nSet Gồm:\r\n1. Nước hoa hồng 125ml+15ml\r\n2. Sữa dưỡng 125ml+15ml\r\n3. Tinh dầu nhân sâm 5ml\r\n4. Xà bông rửa mặt 50g\r\n5. Kem dưỡng nhân sâm 5ml', 30, 2700000, 20, 235),
(52, 'Toner Chống Lão Hóa Sulwhasoo Concentrated Ginseng Renewing Water', 22, 'd1e3360c23.jpg', 'Toner chống lão hóa giàu hàm lượng Steamed Ginseng Water Concentrate™\r\nquý giá cung cấp độ ẩm cho làn da khô ráp, bước khởi đầu tinh tế cho quy trình dưỡng da tiếp theo\r\nSteamed Ginseng Water Concentrate™ được tinh chế từ sự chắt lọc các dưỡng chất phong phú và độ ẩm dồi dào trong nhân sâm\r\nNước nhân sâm, thành phần cung cấp độ ẩm và độ săn chắc cho làn da, được cô đặc vào Steamed Ginseng Water Concentrate™. Với công nghệ tiên tiến và sự nghiên cứu chuyên sâu, Sulwhasoo đã thành công chuyển giao tinh hoa Steamed Ginseng Water Concentrate™ vào sản phẩm Concentrated Ginseng Renewing Water.\r\nChăm sóc da căn bản để có làn da săn chắc – ẩm mượt – đầy sức sống\r\nSteamed Ginseng Water Concentrate™ giúp cho làn da săn chắc trông thấy bằng cách cung cấp một lượng lớn độ ẩm cho làn da khô.\r\nNước cân bằng dạng gel cho cảm giác đàn hồi và giàu ẩm\r\nKết cấu mềm mại và trơn mượt như dầu, Concentrated Ginseng Renewing Water giúp làn da đủ ẩm và đàn hồi. Dùng đầu ngón tay để có thể cảm nhận được kết cấu đàn hồi của nước cân bằng.', 30, 1200000, 234, 124),
(53, 'Set Kem Nền OHUI Ultimate Cover Longwear Foundation 2pcs', 20, '4ea013a32b.jpeg', 'Set Kem Nền OHUI Ultimate Cover Longwear Foundation 2pcs dạng lỏng cho lớp nền mỏng nhẹ và độ che phủ hoàn hảo mang lại lớp trang diểm tự nhiên và tinh tiế , thổi bừng sức sống cho làn da . \r\nChe Các Khuyết Điểm Trên Da, Bền Màu, Không Trôi, Giúp Làm Da Trắng Sáng Và Căng Mịn, có chỉ Số Chống Nắng cao nhất hiện nay ?????/??+++ SPF50/PA+++\r\n\r\n– Khi sử dụng sẽ có cảm giác nhẹ nhàng không hề làm cho da bạn bị bí bích hay dính rít.\r\n– Phù hợp Với Mọi Loại Da.\r\n??? gồm :\r\n– 1 lọ Kem Nên 50ml\r\n??̣̆??\r\n– 1 tuýp Kem Lót ngọc trai bắt sáng khuôn mặt 10ml\r\n– 2 bông mút tán kem nền siêu xịn xò.', 30, 1440000, 29, 114);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_prorp`
--

CREATE TABLE `tbl_prorp` (
  `idProRp` int(11) NOT NULL,
  `productId` int(11) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_prorp`
--

INSERT INTO `tbl_prorp` (`idProRp`, `productId`, `time`, `quantity`, `price`) VALUES
(14, 53, '2022-01-22 07:00:13', 3, 3888000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `sliderId` int(11) NOT NULL,
  `sliderName` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`sliderId`, `sliderName`, `slider_image`, `type`) VALUES
(2, 's1', '80f20583a9.jpg', 1),
(4, 's3', '8dd827c126.jpg', 1),
(5, 's4', '8f6211fe81.jpg', 1),
(6, 's5', 'af758cab8a.jpg', 1),
(8, 'namnam', 'cf4262f6d1.jpg', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `productId` (`productId`,`sId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_historybuy`
--
ALTER TABLE `tbl_historybuy`
  ADD PRIMARY KEY (`idHistoryBuy`),
  ADD KEY `productId` (`productId`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `catId` (`catId`);

--
-- Chỉ mục cho bảng `tbl_prorp`
--
ALTER TABLE `tbl_prorp`
  ADD PRIMARY KEY (`idProRp`),
  ADD KEY `productId` (`productId`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`sliderId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `tbl_historybuy`
--
ALTER TABLE `tbl_historybuy`
  MODIFY `idHistoryBuy` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `tbl_prorp`
--
ALTER TABLE `tbl_prorp`
  MODIFY `idProRp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_historybuy`
--
ALTER TABLE `tbl_historybuy`
  ADD CONSTRAINT `tbl_historybuy_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_historybuy_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_prorp`
--
ALTER TABLE `tbl_prorp`
  ADD CONSTRAINT `tbl_prorp_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
