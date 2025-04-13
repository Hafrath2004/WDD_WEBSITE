-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 12:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nextgen`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_lkr` int(11) DEFAULT NULL,
  `discounted_price_lkr` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `name`, `description`, `price_lkr`, `discounted_price_lkr`, `image_url`) VALUES
(1, 'Safety Goggles', 'Protective eyewear for work.', 120, 100, 'https://i5.walmartimages.com/asr/5a01be7a-31f8-4dbc-8d4d-774f64988f2c.c8a93843aee15ac817b5f2596afc2219.jpeg?odnHeight=768&odnWidth=768&odnBg=FFFFFF'),
(2, 'Dust Mask', 'Reusable anti-dust breathing mask.', 60, 50, 'https://www.msschippers.co.uk/products/images/20/2009611/Main%20product%20shot_N0010BBMM02_X_X_2009611_750x750_1594978119047.jpg'),
(3, 'Tool Belt', 'Waist tool belt with pockets.', 350, 320, 'https://m.media-amazon.com/images/I/51eD5hoXvkL._AC_UF894,1000_QL80_.jpg'),
(4, 'Work Gloves', 'Rubber grip gloves.', 150, 135, 'https://www.safetygloves.co.uk/user/products/large/BLACKROCK-PRO-HD-GRIP-WORK-GLOVES-54316-pj-01.jpg'),
(5, 'Ear Muffs', 'Noise reduction ear protection.', 300, 270, 'https://industrysupplyinc.com/cdn/shop/products/7160-73-Earmuff-Face-Shield-Combo1.jpg?v=1604603437'),
(6, 'Toolbox', 'Plastic toolbox with compartments.', 600, 550, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTozJo3Q0SZ_SJ74LVyfI4G_lt76h4VY-XvKA&s'),
(7, 'Battery Pack', 'Rechargeable power tool battery.', 900, 850, 'https://wedabimahardware.lk/storage/product_photos/202401/wedabimahardware.lk_4000mah-li-battery-1_1705319738.jpg'),
(8, 'Sanding Discs', 'Pack of 10 sanding discs.', 250, 220, 'https://southmainhardware.com/cdn/shop/files/5-inch-8-hole-sanding-discs-mixed-grit-50-pack-627761.jpg?v=1694017522&width=533'),
(9, 'Drill Bits Set', 'Set of 20 steel drill bits.', 450, 420, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBIGiyS1n93IY5oradN8cvoEFGJEePktxC6w&s'),
(10, 'Tool Organizer', 'Wall-mounted tool rack.', 750, 690, 'https://i5.walmartimages.com/asr/5e08e616-61e0-493f-ba8c-32ed78beb9fe.d57c9f1c97385da51fb1c74107e149be.jpeg?odnHeight=768&odnWidth=768&odnBg=FFFFFF');

-- --------------------------------------------------------

--
-- Table structure for table `garden_tools`
--

CREATE TABLE `garden_tools` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_lkr` int(11) DEFAULT NULL,
  `discounted_price_lkr` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garden_tools`
--

INSERT INTO `garden_tools` (`id`, `name`, `description`, `price_lkr`, `discounted_price_lkr`, `image_url`) VALUES
(1, 'Hand Trowel', 'Small tool for digging and planting.', 90, 80, 'https://organicbazar.net/cdn/shop/products/Hand-Trowel-Big-for-Digging-and-Gardening-1.png?v=1694167721'),
(2, 'Garden Fork', 'Tool for loosening soil.', 200, 180, 'https://cdn11.bigcommerce.com/s-rxoyo1n4a1/products/345/images/15059/burgon-and-ball-budding-gardener-childrens-hand-fork__77272.1654751794.500.500.jpg?c=2'),
(3, 'Watering Can', 'Plastic 5-liter watering can.', 180, 150, 'https://img.joomcdn.net/b5b2205b2f6ad2db536db67da27d69d0b598cc7f_original.jpeg'),
(4, 'Pruning Shears', 'For cutting branches and stems.', 220, 200, 'https://shop.goldpeaktools.com.ph/cdn/shop/files/Untitled-4_625407a9-0011-49b0-a964-7107a40c4314.jpg?v=1733384182'),
(5, 'Garden Rake', 'Leaf and soil rake.', 250, 230, 'https://media.takealot.com/covers_tsins/51124063/51124063_1-pdpxl.jpg'),
(6, 'Hose Pipe (15m)', 'Flexible garden hose with spray gun.', 850, 790, 'https://res.cloudinary.com/rsc/image/upload/b_rgb:FFFFFF,c_pad,dpr_1.0,f_auto,q_auto,w_700/c_pad,w_700/R2020990-01'),
(7, 'Garden Gloves', 'Protective gloves for gardening.', 80, 70, 'https://img.freepik.com/premium-photo/close-up-view-pair-gardening-gloves-isolated-white-background_69593-3926.jpg'),
(8, 'Weeder Tool', 'Tool to remove weeds easily.', 120, 110, 'https://m.media-amazon.com/images/I/513qcOtzZVL.jpg'),
(9, 'Sprinkler', 'Rotating garden sprinkler.', 320, 290, 'https://5.imimg.com/data5/SELLER/Default/2022/9/JC/JK/OJ/27934457/hd-fire-upright-sprinkler-500x500.jpeg'),
(10, 'Wheelbarrow', 'Heavy-duty garden wheelbarrow.', 2700, 2500, 'https://ik.imagekit.io/fepy/cdn/catalog/product/h/a/hammerline_wheel_barrow.png');

-- --------------------------------------------------------

--
-- Table structure for table `hand_tools`
--

CREATE TABLE `hand_tools` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_lkr` int(11) DEFAULT NULL,
  `discounted_price_lkr` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hand_tools`
--

INSERT INTO `hand_tools` (`id`, `name`, `description`, `price_lkr`, `discounted_price_lkr`, `image_url`) VALUES
(1, 'Claw Hammer', 'Steel hammer for carpentry work.', 250, 230, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLXGJiw13yB52oNRt06leCva3hLlY_uv5YHw&s'),
(2, 'Adjustable Wrench', 'Chrome-plated adjustable wrench.', 300, 270, 'https://i.ebayimg.com/images/g/628AAOSwUzZm~hru/s-l1200.jpg'),
(3, 'Screwdriver Set', '6-piece mixed screwdriver kit.', 400, 360, 'https://m.media-amazon.com/images/I/71OongQcf9L.jpg'),
(4, 'Insulated Pliers', 'Electric-safe pliers for wiring.', 180, 150, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ85QuMweC_Py2bMe_YUFmP6nC9bO6_p48K3A&s'),
(5, 'Utility Knife', 'Multi-purpose snap blade cutter.', 100, 90, 'https://watermark.lovepik.com/photo/20211130/large/lovepik-utility-knife-picture_501238018.jpg'),
(6, 'Measuring Tape (3m)', 'Retractable measuring tape.', 120, 110, 'https://s.alicdn.com/@sc04/kf/Hee35995c6e074ced8fb9f0903542b42b9.png_720x720q50.png'),
(7, 'Spirit Level', '12-inch accurate level tool.', 200, 180, 'https://alliancehardware.com.au/wp-content/uploads/2023/09/426TOR9.png'),
(8, 'Hand Saw', 'Saw for wood cutting.', 300, 270, 'https://cdn.shopify.com/s/files/1/0558/4591/2763/files/HacksawSet-12_HandSawand10_MiniHacksawforMetal_500x.jpg?v=1686289991'),
(9, 'Allen Key Set', 'Hex key set in different sizes.', 150, 130, 'https://albawarditools.com/wp-content/uploads/2023/08/SAT_ST09105ASJ_IMG_MAIN.jpg'),
(10, 'Wire Stripper', 'Tool for cutting and stripping wires.', 140, 125, 'https://kitronik.co.uk/cdn/shop/files/2617_large_automatic_wire_strippers.jpg?v=1695395335');

-- --------------------------------------------------------

--
-- Table structure for table `power_tools`
--

CREATE TABLE `power_tools` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_lkr` int(11) DEFAULT NULL,
  `discounted_price_lkr` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `power_tools`
--

INSERT INTO `power_tools` (`id`, `name`, `description`, `price_lkr`, `discounted_price_lkr`, `image_url`) VALUES
(1, 'Cordless Drill', 'Compact 18V cordless drill with battery.', 2800, 2500, 'https://m.media-amazon.com/images/I/81tUH7nFwjL._AC_SL1500_.jpg'),
(2, 'Angle Grinder', '4-inch angle grinder for cutting and grinding.', 2200, 1990, 'https://www.madar.com/media/catalog/product/d/0/d0bcd118-affd-443c-b89c-24a47a1d2567_1_.jpg'),
(3, 'Jigsaw', 'Electric jigsaw for precision wood cutting.', 1900, 1750, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR20WjUpttfApKDZy5ISnORElv4ysWc0d-7lQ&s'),
(4, 'Impact Driver', 'High torque impact driver with LED light.', 3500, 3200, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjeOgUFZ-KxDpd9P-28QuOdRPJPfQuZCpwug&s'),
(5, 'Rotary Hammer', '800W rotary hammer drill for concrete.', 4200, 3990, 'https://3.imimg.com/data3/HV/QH/MY-3278060/rotary-hammer-500x500.jpg'),
(6, 'Heat Gun', 'Temperature adjustable electric heat gun.', 1100, 950, 'https://image.made-in-china.com/2f0j00JUYchNQtOToq/Qr-85b2-Qili-Factory-Wholesale-Price-Hot-Air-Gun-for-Heatsink-Hardware-Tool-Power-Tools-Air-Heat-Gun.webp'),
(7, 'Electric Screwdriver', 'Rechargeable mini electric screwdriver.', 950, 870, 'https://www.myb2b.com.my/wp-content/uploads/2024/05/22022023_1066876Imagex1.jpg'),
(8, 'Bench Grinder', 'Heavy-duty bench grinder for sharpening.', 3100, 2890, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNdNZuZrlqIsxqIaqsOea5GRtC0ZUW3iVdtg&s'),
(9, 'Electric Sander', 'Orbital sander for smooth finishing.', 1800, 1600, 'https://www.excelhw.com.sg/cdn/shop/files/DWE6423-XD1.jpg?v=1716283122'),
(10, 'Tile Cutter', 'Power tile cutter with precision blade.', 2600, 2350, 'https://veligaa.com/Home/Image/13263');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `description`, `price`, `discount_price`, `image_url`) VALUES
(1, 'Hammer', 'Claw hammer for carpentry and general use.', 1500.00, 199.00, 'https://vertexpowertools.com/cdn/shop/products/a43ecf3719e04be75c73c526a6752e0a.png?v=1671630809'),
(2, 'Screwdriver Set', '6-piece screwdriver set, flat and Phillips.', 2000.00, 320.00, 'https://motorheadtools.com/cdn/shop/products/TS99934U_200110_9_1024x1024.jpg?v=1615921819'),
(3, 'Wrench (Adjustable)', 'Steel adjustable spanner, rust-resistant.', 350.00, 290.00, 'https://www.bds-machines.in/wp-content/uploads/2022/04/Adjust-quick-wrench-spanner.jpg'),
(4, 'Pliers', 'Insulated pliers for electric and mechanical work.', 180.00, 150.00, 'https://redsflyfishing.com/cdn/shop/files/Screenshot_2024-03-05_104009-removebg.png?v=1709664296'),
(5, 'Drill Machine', 'Electric drill, 500W, for home use.', 2000.00, 1750.00, 'https://4.imimg.com/data4/FM/VV/MY-2268579/drilling-machine-500x500.jpg'),
(6, 'Measuring Tape (5m)', 'Durable tape with lock function and easy-read marks.', 150.00, 120.00, 'https://www.aldahome.com/media/catalog/product/s/t/stanley-measure-tape-5m.jpg'),
(7, 'Hand Saw', 'Sharp-toothed hand saw for wood cutting.', 300.00, 240.00, 'https://dimoretail.lk/wp-content/uploads/2024/05/stanley-jetcut-hand-saw-fine-finish-500mm.jpg'),
(8, 'Spirit Level', '12-inch level for accurate alignment and levelling.', 200.00, 160.00, 'https://kakilai.sg/cdn/shop/products/35111_800x.png?v=1616929243'),
(9, 'Paint Brush (4 inch)', 'Soft bristle brush for wall painting.', 80.00, 65.00, 'https://images.othoba.com/images/thumbs/0488668_painting-brush-4-inch.jpeg'),
(10, 'Paint Roller', 'Roller with ergonomic handle for smooth paint finish.', 180.00, 140.00, 'https://atlas-content-cdn.pixelsquid.com/stock-images/paint-roller-with-Va7Mdy4-600.jpg'),
(11, 'PVC Pipe (1 inch, 6 ft)', 'Lightweight pipe for domestic water supply.', 120.00, 95.00, 'https://5.imimg.com/data5/SELLER/Default/2024/9/447575602/VY/PW/VH/229278918/rigid-pvc-pipes-500x500.jpeg'),
(12, 'Teflon Tape', 'Used for sealing pipe threads, leak-proof.', 30.00, 20.00, 'https://m.media-amazon.com/images/I/61BWZNDv41S._AC_UF1000,1000_QL80_.jpg'),
(13, 'Nails (1 kg pack)', 'Iron nails for wood and wall fixing.', 100.00, 85.00, 'https://tiimg.tistatic.com/fp/1/007/928/pack-of-1-kilogram-8-gauge-thickness-and-3-inch-length-iron-nails-295.jpg'),
(14, 'Screws (100 pcs)', 'Steel screws, assorted sizes for household use.', 90.00, 70.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9nNDkUDCbZtU7xiPn287Rzjph8oFb9cEE4Q&s'),
(15, 'Bolt & Nut Set', 'Set of 50 assorted bolts and nuts.', 120.00, 95.00, 'https://t3.ftcdn.net/jpg/04/95/30/34/360_F_495303436_Fb5qgIfkd8vZGDVxGzSFwTc9R5597KGi.jpg'),
(16, 'Hacksaw', 'Small hacksaw for cutting metal pipes.', 350.00, 280.00, 'https://tistools.co.nz/cdn/shop/files/SAAA3013.jpg?v=1738724348'),
(17, 'Pipe Wrench', 'Heavy-duty pipe wrench for plumbing.', 450.00, 380.00, 'https://mcprod.aashiyana.tatasteel.com/media/catalog/product/p/r/product_1369_1538649229_3.jpg?optimize=high&bg-color=255,255,255&fit=bounds&height=&width='),
(18, 'Extension Cord (5m)', 'Multi-socket extension with surge protector.', 600.00, 490.00, 'https://skyraystore.lk/wp-content/uploads/2023/06/Power-Extension-Cord-with-Universal-Sockets-Sri-Lanka-Power-Strip-Skyray-Electronics-And-Gadgets-Sri-Lanka-3m-10m-5m-10.jpg'),
(19, 'Electrical Wire (1 sq mm, 90m)', 'High-quality copper wire for wiring.', 1200.00, 999.00, 'https://services.ibo.com/media/v1/products/images/9f84f281-c7f7-4a4d-8172-524cf3e91e83/finolex-gold-1-sq-mm-red-90-m-fr-pvc-insulated-wire-1.jpeg?c_type=C3'),
(20, 'Wall Plug (50 pcs)', 'Plastic plugs for fixing screws into walls.', 50.00, 35.00, 'https://static.tudo.lk/uploads/2023/01-06/wall-plug-no-10-box-50pcs-10mm-16742046017854800.webp');

-- --------------------------------------------------------

--
-- Table structure for table `specials`
--

CREATE TABLE `specials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_lkr` int(11) DEFAULT NULL,
  `discounted_price_lkr` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specials`
--

INSERT INTO `specials` (`id`, `name`, `description`, `price_lkr`, `discounted_price_lkr`, `image_url`) VALUES
(1, 'Cordless Drill', 'Compact 18V cordless drill with battery.', 2800, 2500, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHlZuUvG-dL6-WdMgFTqx8WXexNu86n-LXFg&s'),
(2, 'Screwdriver Set', '6-piece mixed screwdriver kit.', 400, 360, 'https://i.ebayimg.com/images/g/Q2AAAOSw-~NhOJ5A/s-l400.jpg'),
(3, 'Electric Sander', 'Orbital sander for smooth finishing.', 1800, 1600, 'https://static.milwaukeetool.eu/remote.axd/milwaukee-media-images.s3.amazonaws.com/hi/M18_FROS125-502X--Hero_1.jpg?v=EE644DDC1A42F502DACACDA20510A637'),
(4, 'Work Gloves', 'Rubber grip gloves.', 150, 135, 'https://media.istockphoto.com/id/874114444/photo/leather-work-glove.jpg?s=612x612&w=0&k=20&c=ILN72rOcjMyJ4hqotixzLyhgPE2oOA64N2EBcCNghiE='),
(5, 'Rotary Hammer', '800W rotary hammer drill for concrete.', 4200, 3990, 'https://images.thdstatic.com/productImages/34ddfefa-4ea8-42af-b087-118879f087e1/svn/dewalt-rotary-hammers-dch133b-64_600.jpg'),
(6, 'Garden Gloves', 'Protective gloves for gardening.', 80, 70, 'https://media.istockphoto.com/id/176790311/photo/garden-gloves-green.jpg?s=612x612&w=0&k=20&c=aXxF-qPn8uD_WWjheUnfYFahiyjS8i-XbNs7WUNRAO4='),
(7, 'Dust Mask', 'Reusable anti-dust breathing mask.', 60, 50, 'https://t4.ftcdn.net/jpg/02/43/44/43/360_F_243444325_QEKwhFVsKffVjRr7dCEedYF9NbjX6DhM.jpg'),
(8, 'Electric Screwdriver', 'Rechargeable mini electric screwdriver.', 950, 870, 'https://www.zdnet.com/a/img/resize/29e7580eb45c10a56e0da6aee6aaec3ebe141d87/2025/02/24/ba9fa0ee-36ae-483b-937c-c1bb0e86ec83/durofort-8v.jpg?auto=webp&fit=crop&height=900&width=1200'),
(9, 'Tool Belt', 'Waist tool belt with pockets.', 350, 320, 'https://thumbs.dreamstime.com/b/tool-belt-tools-variety-white-background-58205431.jpg'),
(10, 'Hose Pipe (15m)', 'Flexible garden hose with spray gun.', 850, 790, 'https://www.cljonesltd.co.uk/images/thumbs/0003957_625.jpeg'),
(11, 'Angle Grinder', '4-inch angle grinder for cutting and grinding.', 2200, 1990, 'https://t4.ftcdn.net/jpg/02/89/73/65/360_F_289736578_nvcFTFJPCNMpJkRhOm8qWn8I53zvZv5C.jpg'),
(12, 'Claw Hammer', 'Steel hammer for carpentry work.', 250, 230, 'https://tolsen.com.ph/cdn/shop/products/25185-2.jpg?v=1740799068'),
(13, 'Heat Gun', 'Temperature adjustable electric heat gun.', 1100, 950, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxk3Qm-awOvhBlb3m2YnvprKjCgjnxgpzCDQ&s'),
(14, 'Tool Organizer', 'Wall-mounted tool rack.', 750, 690, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaZcsV1x-VynBh2VvuMTTlDMS4K5nOLZSCcw&s'),
(15, 'Pruning Shears', 'For cutting branches and stems.', 220, 200, 'https://m.media-amazon.com/images/I/71k49rVnr5L.jpg'),
(16, 'Tile Cutter', 'Power tile cutter with precision blade.', 2600, 2350, 'https://services.ibo.com/media/v1/products/images/e0e8df1c-b56d-45f2-a668-a8f338370aac/stanley-stsp125in-1320-w-125-mm-tile-cutter-1.jpeg?c_type=C4'),
(17, 'Toolbox', 'Plastic toolbox with compartments.', 600, 550, 'https://static-content.cromwell.co.uk/images/427_427/g/jeeps/593/ken5932790k.2.jpg'),
(18, 'Weeder Tool', 'Tool to remove weeds easily.', 120, 110, 'https://m.media-amazon.com/images/I/61Ut8Trz18L.jpg'),
(19, 'Drill Bits Set', 'Set of 20 steel drill bits.', 450, 420, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYwfR83bqA2x8e9qDRhZpQHE4q3dMpEMrFZQ&s'),
(20, 'Spirit Level', '12-inch accurate level tool.', 200, 180, 'https://www.liontoolsmart.com/cdn/shop/products/jon-bhandari-spirit-level-magnetic-red-colour-hd-12inch-s-040.jpg?v=1610357987');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(2, 'test@gmail.com', 'test@gmail.com', 'Test User', '123456', '123 Test St, Test City', '2025-04-13 03:25:07', '2025-04-13 03:31:40'),
(3, 'tesst@gmail.com', 'tesst@gmail.com', 'Admin User', '54321', '456 Admin Rd, Admin City', '2025-04-13 03:25:07', '2025-04-13 03:32:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `garden_tools`
--
ALTER TABLE `garden_tools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hand_tools`
--
ALTER TABLE `hand_tools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `power_tools`
--
ALTER TABLE `power_tools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specials`
--
ALTER TABLE `specials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `garden_tools`
--
ALTER TABLE `garden_tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hand_tools`
--
ALTER TABLE `hand_tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `power_tools`
--
ALTER TABLE `power_tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `specials`
--
ALTER TABLE `specials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
